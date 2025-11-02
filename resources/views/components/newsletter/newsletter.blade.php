<section id="newsletter" class="w-full py-8">
    <div class="w-full lg:max-w-xl max-lg:mx-auto" data-aos="fade-up" data-aos-duration="1600">
        <div class="mb-4">
            <h3 class="text-xl font-semibold text-white mb-2">Berlangganan Newsletter</h3>
            <p class="text-gray-300 text-sm">Dapatkan update terbaru tentang produk dan promo eksklusif!</p>
        </div>
        
        <form id="newsletter-form" class="w-full">
            @csrf
            <div class="bg-white dark:bg-[#131010]/30 backdrop-blur flex items-center rounded-2xl border border-white overflow-hidden">
                <input 
                    id="newsletter-email" 
                    name="email" 
                    type="email"
                    class="w-full px-6 py-2 lg:py-4 rounded-l-2xl text-black dark:text-white bg-transparent focus:border-none focus:outline-0 placeholder-gray-500"
                    placeholder="Masukkan email Anda" 
                    required 
                    autocomplete="email"
                />

                <button 
                    type="submit"
                    id="newsletter-submit"
                    class="bg-[#543A14] dark:bg-[#131010] text-white px-4 lg:px-8 py-2 max-sm:pt-3 lg:py-4 rounded-r-2xl w-fit flex items-center gap-2 font-semibold hover:scale-110 duration-150 transition-all hover:cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100"
                >
                    <span id="newsletter-submit-text" class="hidden lg:block">Berlangganan</span>
                    <span id="newsletter-submit-text-mobile" class="lg:hidden">Langganan</span>
                    <svg id="newsletter-icon" width="22" height="25" viewBox="0 0 22 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.7417 2.49836C22.278 1.01505 20.8406 -0.422341 19.3573 0.115128L1.22861 6.6715C-0.259668 7.21021 -0.439651 9.24092 0.929464 10.0341L6.71624 13.3843L11.8836 8.21687C12.1177 7.99077 12.4313 7.86566 12.7567 7.86848C13.0822 7.87131 13.3935 8.00185 13.6237 8.23199C13.8538 8.46214 13.9843 8.77346 13.9872 9.09892C13.99 9.42437 13.8649 9.73792 13.6388 9.97203L8.47139 15.1394L11.8228 20.9262C12.6147 22.2953 14.6454 22.1141 15.1841 20.6271L21.7417 2.49836Z" fill="currentColor" />
                    </svg>
                    <svg id="newsletter-loading" class="hidden animate-spin" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle class="opacity-25" cx="10" cy="10" r="8" stroke="currentColor" stroke-width="2"></circle>
                        <path class="opacity-75" fill="currentColor" d="M10 2C5.58 2 2 5.58 2 10c0 1.1.22 2.14.62 3.1L1 19l5.9-1.62C7.86 17.78 8.9 18 10 18c4.42 0 8-3.58 8-8s-3.58-8-8-8z"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Message Display -->
            <div id="newsletter-message" class="hidden mt-3 px-4 py-2 rounded-lg text-sm"></div>
        </form>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('newsletter-form');
    const emailInput = document.getElementById('newsletter-email');
    const submitButton = document.getElementById('newsletter-submit');
    const submitText = document.getElementById('newsletter-submit-text');
    const submitTextMobile = document.getElementById('newsletter-submit-text-mobile');
    const newsletterIcon = document.getElementById('newsletter-icon');
    const loadingIcon = document.getElementById('newsletter-loading');
    const messageDiv = document.getElementById('newsletter-message');

    function showMessage(message, isSuccess = false) {
        messageDiv.textContent = message;
        messageDiv.className = isSuccess 
            ? 'mt-3 px-4 py-2 rounded-lg text-sm bg-green-500/20 text-green-300 border border-green-500/30' 
            : 'mt-3 px-4 py-2 rounded-lg text-sm bg-red-500/20 text-red-300 border border-red-500/30';
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
            submitTextMobile.classList.add('hidden');
            newsletterIcon.classList.add('hidden');
            loadingIcon.classList.remove('hidden');
        } else {
            submitButton.disabled = false;
            submitText.classList.remove('hidden');
            submitTextMobile.classList.remove('hidden');
            newsletterIcon.classList.remove('hidden');
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

