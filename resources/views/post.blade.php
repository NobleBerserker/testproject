@extends('layouts.header')
@section('content')
<div class="max-w-4xl mx-auto mt-20">
    <div id="chart"></div>
</div>
<a href="{{ url('/') }}" class="p-2 ml-20 bg-blue-500 text-white rounded hover:bg-blue-600 inline-flex items-center">
    <!-- Heroicons left arrow -->
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
      <path fill-rule="evenodd" d="M12.293 16.293a1 1 0 010 1.414l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L8.414 10l5.293 5.293a1 1 0 010 1.414z" clip-rule="evenodd" />
    </svg>
</a>

<script>
    window.likes = @json($likes);
    window.comments = @json($comments);
    window.shares = @json($shares);
    window.dates = @json($dates);
</script>
@endsection