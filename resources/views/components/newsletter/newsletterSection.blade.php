<section id="newsletter-section" class="w-full py-16 lg:py-24 bg-gradient-to-br from-[#543A14] via-[#6B4A1F] to-[#543A14] dark:from-[#131010] dark:via-[#1a1a1a] dark:to-[#131010] relative z-0 overflow-hidden max-sm:mt-10">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10 dark:opacity-5 z-0">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"1\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    <div class="container mx-auto px-6 lg:px-12 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Icon -->
            <div class="mb-6" data-aos="fade-up" data-aos-duration="800">
                <div class="inline-flex items-center justify-center w-20 h-20 lg:w-24 lg:h-24 bg-white/10 dark:bg-white/5 rounded-full backdrop-blur-sm border border-white/20">
                    <svg class="w-10 h-10 lg:w-12 lg:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>

            <!-- Heading -->
            <h2 class="text-3xl lg:text-5xl font-bold text-white mb-4" data-aos="fade-up" data-aos-duration="1000">
                Dapatkan Update & Promo Eksklusif
            </h2>
            <p class="text-lg lg:text-xl text-white/90 dark:text-white/80 mb-8 max-w-2xl mx-auto" data-aos="fade-up" data-aos-duration="1200">
                Berlangganan newsletter kami dan dapatkan informasi terbaru tentang produk, tips, dan penawaran spesial yang tidak akan Anda lewatkan!
            </p>

            <!-- Newsletter Form -->
            <div class="max-w-2xl mx-auto" data-aos="fade-up" data-aos-duration="1400">
                <form id="newsletter-form-section" class="w-full">
                    @csrf
                    <div class="flex flex-col sm:flex-row gap-4 items-stretch sm:items-center">
                        <div class="flex-1">
                            <input 
                                id="newsletter-email-section" 
                                name="email" 
                                type="email"
                                class="w-full px-6 py-4 lg:py-5 rounded-xl lg:rounded-2xl text-[#131010] dark:text-white bg-white dark:bg-white/10 backdrop-blur-sm border-2 border-white/30 focus:border-[#F0BB78] dark:focus:border-[#F0BB78] focus:outline-none transition-all duration-300 placeholder-gray-500 dark:placeholder-gray-400 text-base lg:text-lg font-medium shadow-lg"
                                placeholder="Masukkan email Anda di sini" 
                                required 
                                autocomplete="email"
                            />
                        </div>

                        <button 
                            type="submit"
                            id="newsletter-submit-section"
                            class="group relative px-8 lg:px-12 py-4 lg:py-5 bg-[#F0BB78] dark:bg-[#F0BB78] text-[#131010] rounded-xl lg:rounded-2xl font-bold text-base lg:text-lg hover:bg-[#e0a868] dark:hover:bg-[#e0a868] transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100 flex items-center justify-center gap-3 min-w-[160px] lg:min-w-[200px]"
                        >
                            <span id="newsletter-submit-text-section" class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                                Berlangganan
                            </span>
                            <svg id="newsletter-loading-section" class="hidden animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </div>
                </form>

                <!-- Message Display -->
                <div id="newsletter-message-section" class="hidden mt-6 px-6 py-4 rounded-xl text-base font-medium text-center backdrop-blur-sm border-2"></div>

                <!-- Trust Indicators -->
                <div class="mt-8 flex flex-wrap items-center justify-center gap-6 text-white/70 dark:text-white/60 text-sm" data-aos="fade-up" data-aos-duration="1600">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Tidak Ada Spam</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Data Aman</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <span>Bisa Unsubscribe Kapan Saja</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('newsletter-form-section');
    const emailInput = document.getElementById('newsletter-email-section');
    const submitButton = document.getElementById('newsletter-submit-section');
    const submitText = document.getElementById('newsletter-submit-text-section');
    const loadingIcon = document.getElementById('newsletter-loading-section');
    const messageDiv = document.getElementById('newsletter-message-section');

    function showMessage(message, isSuccess = false) {
        messageDiv.textContent = message;
        if (isSuccess) {
            messageDiv.className = 'mt-6 px-6 py-4 rounded-xl text-base font-medium text-center backdrop-blur-sm border-2 bg-green-500/20 text-green-100 border-green-500/40 shadow-lg';
        } else {
            messageDiv.className = 'mt-6 px-6 py-4 rounded-xl text-base font-medium text-center backdrop-blur-sm border-2 bg-red-500/20 text-red-100 border-red-500/40 shadow-lg';
        }
        messageDiv.classList.remove('hidden');
        
        // Auto hide after 5 seconds
        setTimeout(() => {
            messageDiv.classList.add('hidden');
        }, 5000);
    }

    function setLoading(loading) {
        if (loading) {
            submitButton.disabled = true;
            submitText.classList.add('hidden');
            loadingIcon.classList.remove('hidden');
        } else {
            submitButton.disabled = false;
            submitText.classList.remove('hidden');
            loadingIcon.classList.add('hidden');
        }
    }

    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        const email = emailInput.value.trim();
        
        if (!email) {
            showMessage('Email wajib diisi.', false);
            return;
        }

        // Basic email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            showMessage('Format email tidak valid.', false);
            return;
        }

        setLoading(true);
        messageDiv.classList.add('hidden');

        try {
            const response = await fetch('{{ route("newsletter.subscribe") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]')?.value || 
                                   document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                },
                body: JSON.stringify({ email: email })
            });

            const data = await response.json();

            if (data.success) {
                showMessage(data.message, true);
                emailInput.value = '';
            } else {
                showMessage(data.message || 'Terjadi kesalahan. Silakan coba lagi.', false);
            }
        } catch (error) {
            showMessage('Terjadi kesalahan. Silakan coba lagi nanti.', false);
        } finally {
            setLoading(false);
        }
    });
});
</script>

