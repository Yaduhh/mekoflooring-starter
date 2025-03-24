@extends('layouts.floorView')

@section('title', 'Floor View - MekoFlooring')

@section('content')
    <section class="h-screen w-full flex items-center justify-center overflow-hidden relative z-0">
        <div class="w-full h-screen absolute -z-10 top-0 left-0">
            <img src="{{ asset('assets/img/bg-flooringview.jpg') }}" alt="logo" class="w-full h-full object-cover"/>
        </div>

        <div class="flex flex-col justify-center items-center w-full gap-2">
            <div class="w-[20%]">
                <img src="{{ asset('assets/img/flooringView.png') }}" alt="logo" class="w-full h-auto"/>
            </div>

            <a href="{{route('floor.show')}}" class="bg-white/30 backdrop-blur px-6 py-1.5 rounded-xl hover:scale-110 duration-200 transition-all font-semibold text-white">
                Try Now
            </a>
        </div>
    </section>
@endsection
