<!doctype html>
<html lang="en">
<head>    
    <meta charset="utf-8" />    
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />    
    @vite('resources/css/app.css')  
</head> 
<body class="bg-gray-100 min-h-screen">
	<nav class="bg-white shadow p-4 flex justify-end items-center">
		<form action="{{ route('getPosts') }}" method="GET">
		    @csrf
		    <button type="submit" class="px-4 py-2 bg-cyan-500 text-white rounded hover:bg-cyan-600">
		        Update Posts
		    </button>
		</form>
		@auth
            <form method="POST" action="{{ route('logout') }}" class="ml-2">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded ">
                    Logout
                </button>
            </form>
        @endauth
	</nav>
	<main>
    	@yield('content')
	</main>
</body>

