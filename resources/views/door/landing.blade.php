<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Door 3D Viewer - Meko Door</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body class="overflow-x-hidden">
    <section class="h-screen w-full flex items-center justify-center overflow-hidden relative z-0">
        <div class="w-full h-screen absolute -z-10 top-0 left-0">
            <img src="{{ asset('assets/img/bg-flooringview.jpg') }}"
                 alt="Door Viewer Background"
                 class="w-full h-full object-cover"/>
        </div>

        <div class="flex flex-col justify-center items-center w-full gap-2">
            <div class="w-[70%] lg:w-[20%]">
                <img src="{{ asset('assets/img/flooringView.png') }}"
                     alt="Door 3D Viewer"
                     class="w-full h-auto"/>
            </div>
            <a href="{{ route('doors.index') }}"
               class="bg-white/30 backdrop-blur px-6 py-1.5 rounded-xl hover:scale-110 duration-200 transition-all font-semibold text-white">
                Try Now
            </a>
        </div>
    </section>
</body>
</html>
