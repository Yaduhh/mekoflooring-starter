<section id="subscription" class="w-full mb-10">
    <div class="w-full mx-auto lg:xl:max-w-6xl 2xl:max-w-7xl max-lg:px-6 bg-[#543A14] dark:bg-[#131010] py-12 lg:py-12 rounded-3xl">
        <div class="text-center mb-8" data-aos="fade-up" data-aos-duration="500">
            <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">
                Dapatkan Promo Eksklusif untuk Anda
            </h2>
            <p class="text-white/90 text-lg max-w-2xl mx-auto">
                Berlangganan newsletter kami untuk mendapatkan informasi terbaru tentang produk, promosi, dan tips
                perawatan lantai SPC.
            </p>
        </div>

        <div class="max-w-xl mx-auto" data-aos="fade-up" data-aos-duration="700">
            @if (session('subscription_success'))
                <div class="mb-6 p-4 bg-green-500/20 border border-green-500 rounded-lg text-white">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <p>{{ session('subscription_success') }}</p>
                    </div>
                </div>
            @endif

            @if (session('subscription_error'))
                <div class="mb-6 p-4 bg-red-500/20 border border-red-500 rounded-lg text-white">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                        <p>{{ session('subscription_error') }}</p>
                    </div>
                </div>
            @endif

            <form action="{{ route('subscription.store') }}" method="POST" class="relative">
                @csrf
                <div
                    class="bg-white/10 dark:bg-white/5 backdrop-blur-md rounded-full p-2 flex items-center gap-2 border border-white/20">
                    <input type="email" name="email" id="subscription-email"
                        value="{{ old('email') }}"
                        placeholder="Masukkan email Anda"
                        required
                        class="w-full px-6 py-3 lg:py-4 bg-transparent text-white placeholder:text-white/70 rounded-l-full focus:outline-none focus:ring-2 focus:ring-[#F0BB78]">
                    <button type="submit"
                        class="bg-[#F0BB78] hover:bg-[#F0BB78]/90 text-[#543A14] dark:text-[#131010] font-semibold px-6 lg:px-8 py-3 lg:py-4 rounded-r-full transition-all duration-200 hover:scale-105 flex items-center gap-2 whitespace-nowrap">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                        </svg>
                        <span>Berlangganan</span>
                    </button>
                </div>
                @error('email')
                    <p class="mt-2 text-red-400 text-sm">{{ $message }}</p>
                @enderror
            </form>

            <p class="text-white/70 text-sm text-center mt-4">
                Kami menghargai privasi Anda. Email Anda tidak akan dibagikan ke pihak lain.
            </p>
        </div>
    </div>
</section>

