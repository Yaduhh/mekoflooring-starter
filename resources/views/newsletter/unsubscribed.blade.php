<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Berhenti Berlangganan - Mega Door</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite('resources/css/app.css')
</head>

<body class="bg-[#FDFDFC] dark:bg-[#131010] text-[#131010] dark:text-white flex items-center min-h-screen flex-col relative z-0">
    <div class="w-full min-h-screen flex items-center justify-center px-6">
        <div class="w-full max-w-md bg-white dark:bg-[#131010] rounded-2xl shadow-lg p-8 text-center">
            <div class="mb-6">
                <svg class="mx-auto w-16 h-16 text-[#543A14] dark:text-[#F0BB78]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>
            
            <h1 class="text-2xl font-semibold mb-4 text-[#131010] dark:text-white">
                {{ $message }}
            </h1>
            
            <p class="text-gray-600 dark:text-gray-400 mb-8">
                Terima kasih telah menggunakan layanan newsletter kami.
            </p>
            
            <a href="{{ route('home') }}" 
               class="inline-block bg-[#543A14] dark:bg-[#F0BB78] text-white dark:text-[#131010] px-6 py-3 rounded-lg font-semibold hover:scale-105 duration-150 transition-all">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</body>

</html>

