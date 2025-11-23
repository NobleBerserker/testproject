<!doctype html>
<html lang="en">
<head>    
    <meta charset="utf-8" />    
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />    
    @vite('resources/css/app.css')  
</head> 
<body class="bg-gray-100 min-h-screen">
	<nav class="bg-white shadow p-4 flex justify-end">
		@auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-cyan-500 hover:bg-cyan-600 text-white px-4 py-2 rounded ">
                    Logout
                </button>
            </form>
        @endauth
	</nav>
	<main>
    	@yield('content')
	</main>
</body>

