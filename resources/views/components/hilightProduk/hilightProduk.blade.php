<section id="hilight" class="w-full min-h-screen relative overflow-hidden z-0 flex flex-col justify-center bg-[#FFF0DC] max-sm:pt-10 2xl:py-20">
    <div class="w-full mx-auto lg:xl:max-w-6xl 2xl:max-w-7xl grid grid-cols-12">
        <div class="max-sm:hidden col-span-4 2xl:col-span-5"></div>
        <div class="col-span-12 lg:col-span-8 2xl:col-span-7 lg:pl-10 max-sm:px-6">
            <div class="mb-4">
                <img src="{{ asset('assets/img/logoWithoutText.png') }}" alt="logo" class="w-auto h-auto" />
            </div>

            <div class="">
                <p class="bg-[#131010] w-fit text-white text-lg font-semibold px-6 py-2 rounded-r-full">{{ __('WPC DOOR BOARD') }}</p>

                <table class="table-auto w-full mt-4 overflow-auto">
                    <thead>
                        <tr class="bg-[#131010] text-white">
                            <th class="px-4 py-2 text-left">Dimension</th>
                            <th class="px-4 py-2 text-left">CM</th>
                            <th class="px-4 py-2 text-left"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-300">
                            <td class="px-4 py-2 font-semibold">TALL</td>
                            <td class="px-4 py-2">190/200/210</td>
                            <td class="px-4 py-2">210/220/240</td>
                        </tr>
                        <tr class="border-b border-gray-300">
                            <td class="px-4 py-2 font-semibold">WIDE</td>
                            <td class="px-4 py-2">60</td>
                            <td class="px-4 py-2">3/8</td>
                        </tr>
                        <tr class="border-b border-gray-300">
                            <td class="px-4 py-2 font-semibold">THICKNESS</td>
                            <td class="px-4 py-2">72/82/83/94</td>
                            <td class="px-4 py-2">3.8/5/7</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-12">
                <p class="bg-[#131010] w-fit text-white text-lg font-semibold px-6 py-2 rounded-r-full">{{ __('WPC DOOR FRAME') }}</p>

                <div class="overflow-auto">
                    <table class="table-auto w-full mt-4">
                        <thead>
                            <tr class="bg-[#131010] text-white">
                                <th class="px-4 py-2 text-left">CM</th>
                                <th class="px-4 py-2 text-left">MKK-A</th>
                                <th class="px-4 py-2 text-left">MKK-B</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-300">
                                <td class="px-4 py-2 font-semibold">TALL</td>
                                <td class="px-4 py-2">230/250/310/350</td>
                                <td class="px-4 py-2">230/250/310/350</td>
                            </tr>
                            <tr class="border-b border-gray-300">
                                <td class="px-4 py-2 font-semibold">WIDE</td>
                                <td class="px-4 py-2">Custom</td>
                                <td class="px-4 py-2">9</td>
                            </tr>
                            <tr class="border-b border-gray-300">
                                <td class="px-4 py-2 font-semibold">THICKNESS</td>
                                <td class="px-4 py-2">9.5</td>
                                <td class="px-4 py-2">3</td>
                            </tr>
                            <tr class="border-b border-gray-300">
                                <td class="px-4 py-2 font-semibold">SCREW</td>
                                <td class="px-4 py-2">Not Visible</td>
                                <td class="px-4 py-2">Not Visible</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="mt-12">
                <p class="w-fit text-[#131010] text-xl font-semibold mb-2">{{ __('Feature & Benefit') }}</p>

                <div class="space-x-8 lg:space-x-6 space-y-2 max-sm:pr-28">
                    <span class="inline-flex items-center rounded-full bg-[#543A14] px-4 py-1 text-xs font-medium text-white ring-1 ring-gray-500/10 ring-inset">{{ __('Eco Friendly') }}</span>
                    <span class="inline-flex items-center rounded-full bg-[#543A14] px-4 py-1 text-xs font-medium text-white ring-1 ring-gray-500/10 ring-inset">{{ __('Durable & Long Lasting') }}</span>
                    <span class="inline-flex items-center rounded-full bg-[#543A14] px-4 py-1 text-xs font-medium text-white ring-1 ring-gray-500/10 ring-inset">{{ __('All Weather Resistant') }}</span>
                    <span class="inline-flex items-center rounded-full bg-[#543A14] px-4 py-1 text-xs font-medium text-white ring-1 ring-gray-500/10 ring-inset">{{ __('Fire Retardant') }}</span>
                    <span class="inline-flex items-center rounded-full bg-[#543A14] px-4 py-1 text-xs font-medium text-white ring-1 ring-gray-500/10 ring-inset">{{ __('Anti Termite & Insect') }}</span>
                    <span class="inline-flex items-center rounded-full bg-[#543A14] px-4 py-1 text-xs font-medium text-white ring-1 ring-gray-500/10 ring-inset">{{ __('Easy Installaion') }}</span>
                </div>
            </div>

            <div class="py-10"></div>
        </div>
    </div>

    <div class="absolute bottom-0 -z-10 w-full max-sm:-scale-x-100">
        <img src="{{ asset('assets/img/mockup-pintuspc.png') }}" alt="logo" class="w-full h-auto" />
    </div>
</section>
