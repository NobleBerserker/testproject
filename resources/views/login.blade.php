<!doctype html>
<html>  
<head>    
    <meta charset="utf-8" />    
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />    
    @vite('resources/css/app.css')  
</head>  
    <body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white border border-black rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h2>

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-700">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    required 
                    class="w-full px-4 py-2 border bg-white rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500"
                    placeholder="you@example.com"
                >
            </div>

            <div>
                <label class="block text-gray-700">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    required 
                    class="w-full px-4 py-2 border bg-white rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500"
                    placeholder="Enter your password"
                >
            </div>

            <button 
                type="submit"
                class="w-full bg-cyan-500 hover:bg-cyan-600 text-white py-2 px-4 rounded-lg font-semibold transition-colors"
            >
                Login
            </button>
        </form>

    </div>
</body>
</html>