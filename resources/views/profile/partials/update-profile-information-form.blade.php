<section class="mb-8">
    <header class="mb-4">
        <h2 class="text-2xl font-bold text-gray-900 mb-1">Profile Information</h2>
        <p class="text-gray-600">Update your account's profile information and email address.</p>
    </header>
    @if (session('status') === 'profile-updated')
        <div class="mb-4 text-green-700 bg-green-100 border border-green-300 rounded-lg px-4 py-2 text-center">
            Saved.
        </div>
    @endif
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" class="input-field w-full px-4 py-3 rounded-xl border-0 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none">
            @error('name')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username" class="input-field w-full px-4 py-3 rounded-xl border-0 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none">
            @error('email')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-gray-800">
                        Your email address is unverified.
                        <button form="send-verification" class="underline text-indigo-600 hover:text-indigo-800 font-medium">Click here to re-send the verification email.</button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">A new verification link has been sent to your email address.</p>
                    @endif
                </div>
            @endif
        </div>
        <div class="flex items-center gap-4">
            <button type="submit" class="btn-primary px-6 py-2 rounded-xl text-white font-semibold">Save</button>
        </div>
    </form>
</section>
