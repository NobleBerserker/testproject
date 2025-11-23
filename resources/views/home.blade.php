@extends('layouts.header')

@section('content')
    <div class="max-w-3xl mx-auto mt-6">
        @if(session('success'))
            <div id="flash-message" class="absolute top-20 left-1/2 transform -translate-x-1/2 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-lg z-50 transition-opacity duration-1000" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div id="flash-message" class="absolute top-20 left-1/2 transform -translate-x-1/2 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-lg z-50 transition-opacity duration-1000" role="alert">
                {{ session('error') }}
            </div>
        @endif
    </div>
    <div class="flex mt-20 items-center justify-center px-10">
        <div>
            <h1 class="text-4xl font-bold text-cyan-500 text-center mb-5">
            Posts
            </h1>
            @include('partials.posts', ['posts' => $posts])
        </div>
    </div>
    <script>
        //Fade out script
        document.addEventListener('DOMContentLoaded', () => {
            const flash = document.getElementById('flash-message');
            if (flash) {
                setTimeout(() => {
                    flash.classList.add('opacity-0'); 
                }, 5000); 
                setTimeout(() => {
                    flash.remove(); 
                }, 5500); 
            }
        });
    </script>

@endsection