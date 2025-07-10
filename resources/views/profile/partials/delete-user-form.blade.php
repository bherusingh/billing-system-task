<section class="mb-8">
    <header class="mb-4">
        <h2 class="text-2xl font-bold text-gray-900 mb-1">Delete Account</h2>
        <p class="text-gray-600">Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>
    </header>
    @if($errors->userDeletion->any())
        <div class="mb-4 text-red-700 bg-red-100 border border-red-300 rounded-lg px-4 py-2 text-center">
            {{ $errors->userDeletion->first() }}
        </div>
    @endif
    <button type="button" onclick="openDeleteAccountModal()" class="px-6 py-2 rounded-xl bg-red-600 text-white font-semibold hover:bg-red-700 transition">Delete Account</button>
    <!-- Modal -->
    <div id="delete-account-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
        <div class="bg-white rounded-2xl shadow-xl p-8 max-w-sm w-full text-center">
            <h2 class="text-xl font-bold mb-4 text-gray-900">Are you sure you want to delete your account?</h2>
            <p class="mb-6 text-gray-600">Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.</p>
            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-4">
                @csrf
                @method('delete')
                <input type="password" name="password" placeholder="Password" class="input-field w-full px-4 py-3 rounded-xl border-0 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none" required>
                <div class="flex justify-center gap-4 mt-4">
                    <button type="button" onclick="closeDeleteAccountModal()" class="px-6 py-2 rounded-lg bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300">Cancel</button>
                    <button type="submit" class="px-6 py-2 rounded-lg bg-red-600 text-white font-semibold hover:bg-red-700">Delete Account</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function openDeleteAccountModal() {
            document.getElementById('delete-account-modal').classList.remove('hidden');
        }
        function closeDeleteAccountModal() {
            document.getElementById('delete-account-modal').classList.add('hidden');
        }
    </script>
</section>
