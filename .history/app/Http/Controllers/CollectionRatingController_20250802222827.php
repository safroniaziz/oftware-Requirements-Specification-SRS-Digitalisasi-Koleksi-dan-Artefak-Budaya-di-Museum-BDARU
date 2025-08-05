<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\CollectionRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class CollectionRatingController extends Controller
{
    public function store(Request $request, $slug)
    {
        $collection = Collection::where('slug', $slug)->whereNull('deleted_at')->firstOrFail();

        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        // Check if user already rated this collection
        $existingRating = null;

        if (Auth::check()) {
            // Logged in user
            $existingRating = CollectionRating::where('collection_id', $collection->id)
                ->where('user_id', Auth::id())
                ->first();
        } else {
            // Guest user - check by IP
            $existingRating = CollectionRating::where('collection_id', $collection->id)
                ->where('visitor_ip', $request->ip())
                ->first();
        }

        if ($existingRating) {
            throw ValidationException::withMessages([
                'rating' => 'Anda sudah memberikan rating untuk koleksi ini.'
            ]);
        }

        // Create new rating
        $rating = new CollectionRating([
            'collection_id' => $collection->id,
            'user_id' => Auth::id(),
            'visitor_ip' => Auth::check() ? null : $request->ip(),
            'visitor_session' => Auth::check() ? null : $request->session()->getId(),
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => true, // Auto-approve for now
        ]);

        $rating->save();

        return response()->json([
            'success' => true,
            'message' => 'Rating berhasil ditambahkan!',
            'average_rating' => $collection->fresh()->average_rating,
            'rating_count' => $collection->fresh()->rating_count,
            'rating' => [
                'id' => $rating->id,
                'rating' => $rating->rating,
                'comment' => $rating->comment,
                'created_at' => $rating->created_at->format('Y-m-d H:i:s'),
                'user' => $rating->user ? [
                    'name' => $rating->user->name
                ] : null
            ]
        ]);
    }

    public function update(Request $request, $slug, CollectionRating $rating)
    {
        $collection = Collection::where('slug', $slug)->whereNull('deleted_at')->firstOrFail();

        // Check if user owns this rating
        if (Auth::check() && $rating->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        if (!Auth::check() && $rating->visitor_ip !== $request->ip()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        $rating->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Rating berhasil diperbarui!',
            'average_rating' => $collection->fresh()->average_rating,
            'rating_count' => $collection->fresh()->rating_count,
        ]);
    }

    public function destroy($slug, CollectionRating $rating)
    {
        $collection = Collection::where('slug', $slug)->whereNull('deleted_at')->firstOrFail();

        // Check if user owns this rating
        if (Auth::check() && $rating->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        if (!Auth::check() && $rating->visitor_ip !== request()->ip()) {
            abort(403, 'Unauthorized');
        }

        $rating->delete();

        return response()->json([
            'success' => true,
            'message' => 'Rating berhasil dihapus!',
            'average_rating' => $collection->fresh()->average_rating,
            'rating_count' => $collection->fresh()->rating_count,
        ]);
    }
}
