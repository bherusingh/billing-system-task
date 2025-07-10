<section class="mb-8">
    <header class="mb-4">
        <h2 class="text-2xl font-bold text-gray-900 mb-1">Update Password</h2>
        <p class="text-gray-600">Ensure your account is using a long, random password to stay secure.</p>
    </header>
    @if (session('status') === 'password-updated')
        <div class="mb-4 text-green-700 bg-green-100 border border-green-300 rounded-lg px-4 py-2 text-center">
            Password updated successfully.
        </div>
    @endif
    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')
        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password" class="input-field w-full px-4 py-3 rounded-xl border-0 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none">
            @if($errors->updatePassword->get('current_password'))
                <div class="text-red-600 text-sm mt-1">{{ $errors->updatePassword->first('current_password') }}</div>
            @endif
        </div>
        <div>
            <label for="update_password_password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password" class="input-field w-full px-4 py-3 rounded-xl border-0 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none">
            @if($errors->updatePassword->get('password'))
                <div class="text-red-600 text-sm mt-1">{{ $errors->updatePassword->first('password') }}</div>
            @endif
        </div>
        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" class="input-field w-full px-4 py-3 rounded-xl border-0 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none">
            @if($errors->updatePassword->get('password_confirmation'))
                <div class="text-red-600 text-sm mt-1">{{ $errors->updatePassword->first('password_confirmation') }}</div>
            @endif
        </div>
        <div class="flex items-center gap-4">
            <button type="submit" class="btn-primary px-6 py-2 rounded-xl text-white font-semibold">Save</button>
        </div>
    </form>
</section>
