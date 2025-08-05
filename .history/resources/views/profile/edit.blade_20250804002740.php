@extends('layouts.dashboard.dashboard')

@section('title', 'Profil Saya')
@section('content')
<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card mb-5">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Informasi Profil</h3>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
            <div class="card mb-5">
                <div class="card-header bg-info text-white">
                    <h3 class="mb-0">Ubah Password</h3>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
            <div class="card mb-5">
                <div class="card-header bg-danger text-white">
                    <h3 class="mb-0">Hapus Akun</h3>
                </div>
                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
