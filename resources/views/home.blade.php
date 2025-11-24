@extends('layouts.header')

@section('content')

    <div class="flex flex-col mt-20 items-center justify-center px-10">
        <div class="flex justify-between items-center mb-5 gap-10">
            <h1 class="text-4xl font-bold text-cyan-500 text-center mb-5">
            Posts
            </h1>            
        </div>
        <div class="flex justify-center">
            @include('partials.posts', ['posts' => $posts])
        </div>
    </div>

@endsection