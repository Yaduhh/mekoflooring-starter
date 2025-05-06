<section id="home" class="w-full flex items-center justify-center h-screen relative z-0 overflow-hidden">
    <div class="absolute top-0 -z-10 w-auto h-screen left-0 dark:hidden" data-aos="fade-up" data-aos-duration="500">
        <img src="{{ asset('assets/img/backgroundHome.jpg') }}" alt="logo"
            class="w-auto h-full max-lg:object-cover lg:min-h-screen" />
    </div>
    <div class="absolute top-0 -z-10 w-auto h-screen left-0 hidden dark:block" data-aos="fade-up" data-aos-duration="500">
        <img src="{{ asset('assets/img/backgroundHomeDark.jpg') }}" alt="logo"
            class="w-auto h-full max-lg:object-cover lg:min-h-screen" />
    </div>
    <div
        class="w-full mx-auto xl:xl:max-w-6xl 2xl:max-w-7xl flex flex-col justify-center gap-10 max-lg:text-center max-sm:pt-10">
        <div>
            <h1 class="text-4xl font-bold text-white" data-aos="fade-up" data-aos-duration="1000">MEKO FLOORING</h1>
            <p class="font-medium text-white text-lg" data-aos="fade-up" data-aos-duration="1200">One - Stop solution
                for SPC Flooring</p>
        </div>

        <div class="w-full max-lg:px-6 lg:w-[50%] max-lg:mx-auto text-justify" data-aos="fade-up"
            data-aos-duration="1500">
            <p class="text-white">
                Meko Flooring hadir sebagai solusi untuk lantai berkualitas tinggi, tahan lama, dan ramah lingkungan.
                Dengan teknologi SPC terbaru dari Jerman, desain yang memukau, dan kinerja yang luar biasa.
            </p>
        </div>

        <!-- Form input untuk menghubungi via WhatsApp -->
        <div class="w-full max-lg:px-6 lg:w-[50%] max-lg:mx-auto" data-aos="fade-up" data-aos-duration="1600">
            <form id="whatsapp-form" action="https://wa.me/628119112416" method="get" target="_blank">
                <div class="bg-white/70 dark:bg-[#131010]/30 backdrop-blur flex items-center p-2 rounded-full">
                    <input id="whatsapp-message" name="text" class="w-full px-6 py-2 lg:py-4 rounded-l-full"
                        placeholder="Mau nanya apa nih?" required />
                    <button type="submit"
                        class="bg-[#543A14] dark:bg-[#131010] px-4 lg:px-8 py-2 max-sm:pt-3 lg:py-4 rounded-r-full w-fit text-white flex items-center gap-2 font-semibold hover:scale-110 duration-150 transition-all hover:cursor-pointer">
                        <svg width="22" height="25" viewBox="0 0 22 25" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M21.7417 2.49836C22.278 1.01505 20.8406 -0.422341 19.3573 0.115128L1.22861 6.6715C-0.259668 7.21021 -0.439651 9.24092 0.929464 10.0341L6.71624 13.3843L11.8836 8.21687C12.1177 7.99077 12.4313 7.86566 12.7567 7.86848C13.0822 7.87131 13.3935 8.00185 13.6237 8.23199C13.8538 8.46214 13.9843 8.77346 13.9872 9.09892C13.99 9.42437 13.8649 9.73792 13.6388 9.97203L8.47139 15.1394L11.8228 20.9262C12.6147 22.2953 14.6454 22.1141 15.1841 20.6271L21.7417 2.49836Z"
                                fill="currentColor" />
                        </svg>
                        <span class="hidden lg:block">Kirim</span>
                    </button>
                </div>
            </form>
        </div>

        <a href="https://megakomposit.com" target="_blank"
            class="text-white flex items-end gap-2 absolute bottom-10 lg:bottom-20 max-sm:left-6">
            <div class="w-12 lg:w-16">
                <img src="{{ asset('assets/img/logomki.png') }}" alt="logo"
                    class="w-full h-auto max-lg:object-cover" />
            </div>
            <p class="font-light max-sm:text-sm max-sm:text-left">Part Of Mega<br />Komposit Indonesia</p>
    </div>
    </div>
</section>
