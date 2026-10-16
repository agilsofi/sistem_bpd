<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem BPD</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-semibold text-gray-900">Sistem Informasi BPD</h1>
                    <p class="text-sm text-gray-600 mt-2">SMK Pembangunan Jaya – YAKAPI</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <p class="text-sm text-red-800">{{ $errors->first() }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                        <input 
                            type="text" 
                            name="username" 
                            id="username" 
                            value="{{ old('username') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required
                            autofocus
                        >
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required
                        >
                    </div>

                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                        </label>
                    </div>

                    <button 
                        type="submit" 
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors"
                    >
                        Masuk
                    </button>
                </form>
            </div>

            <p class="text-center text-sm text-gray-600 mt-6">
                &copy; 2026 SMK Pembangunan Jaya – YAKAPI
            </p>
        </div>
    </div>
</body>
</html>
