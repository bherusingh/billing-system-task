@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <div class="glass-morphism rounded-3xl p-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Profile Settings</h1>
        {{-- Update Profile Information --}}
        <div class="mb-10">
            @include('profile.partials.update-profile-information-form')
        </div>
        {{-- Update Password --}}
        <div class="mb-10">
            @include('profile.partials.update-password-form')
        </div>
        {{-- Delete Account --}}
        <div>
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection
