<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminPengelolaAgendaController extends Controller
{
    public function index()
    {
        $events = Event::whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('management.events.index', compact('events'));
    }

    public function create()
    {
        return view('management.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'start_time' => 'required|string|max:255',
            'end_time' => 'nullable|string|max:255',
            'location' => 'required|string|max:255',
            'status' => 'required|in:upcoming,ongoing,completed,cancelled',
            'type' => 'required|in:exhibition,workshop,seminar,performance,other',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'capacity' => 'nullable|integer|min:1',
            'price' => 'nullable|numeric|min:0',
            'organizer' => 'nullable|string|max:255',
            'additional_info' => 'nullable|string',
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events/images', 'public');
        }

        Event::create($data);

        return redirect()->route('events-management.index')->with('success', 'Agenda berhasil ditambahkan');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);

        return view('management.events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'start_time' => 'required|string|max:255',
            'end_time' => 'nullable|string|max:255',
            'location' => 'required|string|max:255',
            'status' => 'required|in:upcoming,ongoing,completed,cancelled',
            'type' => 'required|in:exhibition,workshop,seminar,performance,other',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'capacity' => 'nullable|integer|min:1',
            'price' => 'nullable|numeric|min:0',
            'organizer' => 'nullable|string|max:255',
            'additional_info' => 'nullable|string',
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Old image remains in storage (not deleted)
            $data['image_path'] = $request->file('image')->store('events/images', 'public');
        }

        $event->update($data);

        return redirect()->route('events-management.index')->with('success', 'Agenda berhasil diperbarui');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        // Soft delete the event (file remains in storage)
        $event->delete();

        return redirect()->route('events-management.index')->with('success', 'Agenda berhasil dihapus');
    }
}
