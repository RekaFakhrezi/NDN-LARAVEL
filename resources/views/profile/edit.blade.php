<x-app-layout>
    <div class="min-h-screen bg-[#fafafa] py-10 md:py-12 font-sans">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 space-y-8">

            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-2">
                <div>
                    <h2 class="text-2xl md:text-3xl font-serif font-bold text-gray-900">Pengaturan Akun</h2>
                    <p class="text-sm text-gray-500 mt-1">Kelola data diri, alamat email, dan kata sandi Anda di sini.
                    </p>
                </div>
                <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('home') }}"
                    class="text-sm font-bold text-[#bd2828] hover:underline flex items-center gap-1 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>

            <div class="p-6 sm:p-8 bg-white border border-gray-200 shadow-sm rounded-xl">
                <div class="max-w-xl">
                    <h3
                        class="text-lg font-bold text-gray-900 border-b border-gray-100 pb-3 mb-5 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Informasi Profil
                    </h3>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-6 sm:p-8 bg-white border border-gray-200 shadow-sm rounded-xl">
                <div class="max-w-xl">
                    <h3
                        class="text-lg font-bold text-gray-900 border-b border-gray-100 pb-3 mb-5 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                        Perbarui Kata Sandi
                    </h3>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-6 sm:p-8 bg-white border border-red-200 shadow-sm rounded-xl">
                <div class="max-w-xl">
                    <h3
                        class="text-lg font-bold text-red-600 border-b border-red-100 pb-3 mb-5 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                        Zona Berbahaya
                    </h3>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>