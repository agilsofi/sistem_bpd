<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem BPD</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Google (Inter) agar lebih modern -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4 sm:p-8">

    <!-- Card Utama (Split Screen) -->
    <div class="w-full max-w-5xl bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row">
        
        <!-- SISI KIRI: Panel Biru (Branding & Ilustrasi) -->
        <div class="w-full md:w-1/2 bg-gradient-to-br from-blue-700 to-blue-900 p-10 flex flex-col justify-between text-white relative">
            <!-- Dekorasi Latar Belakang -->
            <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <circle cx="80" cy="20" r="40" fill="white" />
                    <circle cx="20" cy="80" r="30" fill="white" />
                </svg>
            </div>

            <!-- Konten Atas -->
            <div class="relative z-10">
                <!-- Logo Sekolah -->
                <img class="h-28 w-auto object-contain mb-6 bg-white p-2 rounded-full shadow-lg border-4 border-white/20" src="{{ asset('images/logo-sekolah.png') }}" alt="Logo SMK Pembangunan Jaya">
                
                <h1 class="text-3xl font-bold mb-2">Sistem Informasi BPD</h1>
                <p class="text-blue-200 text-lg">SMK Pembangunan Jaya – YAKAPI</p>
            </div>

            <!-- Konten Bawah -->
            <div class="relative z-10 mt-10 md:mt-0">
                <p class="text-blue-100 italic leading-relaxed text-sm">
                    "Menjadi SMK terbaik yang menghasilkan peserta didik berkarakter, unggul, dan berjiwa wirausaha."
                </p>
                <div class="mt-4 flex items-center text-xs text-blue-300">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    Sistem Terintegrasi & Aman
                </div>
            </div>
        </div>

        <!-- SISI KANAN: Form Login -->
        <div class="w-full md:w-1/2 p-8 sm:p-12 flex flex-col justify-center bg-white">
            
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Selamat Datang</h2>
                <p class="text-gray-500 text-sm mt-2">Silakan masuk menggunakan akun Anda.</p>
            </div>

            <!-- Pesan Error -->
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg flex items-start shadow-sm">
                    <svg class="w-5 h-5 text-red-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-sm text-red-700">{{ $errors->first() }}</p>
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Username -->
                <div>
                    <label for="username" class="block text-sm font-semibold text-gray-700 mb-1.5">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <input 
                            type="text" 
                            name="username" 
                            id="username" 
                            value="{{ old('username') }}"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all bg-gray-50 focus:bg-white"
                            placeholder="Masukkan username"
                            required
                            autofocus
                        >
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all bg-gray-50 focus:bg-white"
                            placeholder="Masukkan password"
                            required
                        >
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 cursor-pointer">
                        <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                    </label>
                </div>

                <!-- Tombol Submit -->
                <button 
                    type="submit" 
                    class="w-full bg-blue-600 text-white font-semibold py-3 px-4 rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/50 transition-all duration-200 shadow-lg shadow-blue-500/30 transform hover:-translate-y-0.5"
                >
                    Masuk ke Sistem
                </button>
            </form>

            <!-- Footer Copyright -->
            <div class="mt-10 text-center text-xs text-gray-400">
                &copy; {{ date('Y') }} SMK Pembangunan Jaya. All rights reserved.
            </div>
        </div>
    </div>

</body>
</html>