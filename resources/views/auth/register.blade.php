<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - fauziDev</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gradient-to-br from-slate-900 to-slate-800 min-h-screen flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <!-- Logo -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-gradient-to-br from-primary to-accent rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-code text-white text-2xl"></i>
                </div>
                <h1 class="text-3xl font-bold">fauziDev</h1>
                <p class="text-slate-600 mt-2">Buat akun baru</p>
            </div>

            @if ($errors->any())
            <div class="mb-6 p-4 bg-danger/10 text-danger rounded-lg border border-danger/20 text-sm">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <label class="block text-slate-700 font-semibold mb-1 text-sm">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="w-full px-3 py-2 border-2 border-slate-300 rounded-lg focus:outline-none focus:border-primary transition text-sm @error('name') border-danger @enderror">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-slate-700 font-semibold mb-1 text-sm">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-3 py-2 border-2 border-slate-300 rounded-lg focus:outline-none focus:border-primary transition text-sm @error('email') border-danger @enderror">
                </div>

                <!-- Company Name -->
                <div>
                    <label class="block text-slate-700 font-semibold mb-1 text-sm">Nama Perusahaan (Opsional)</label>
                    <input type="text" name="company_name" value="{{ old('company_name') }}"
                        class="w-full px-3 py-2 border-2 border-slate-300 rounded-lg focus:outline-none focus:border-primary transition text-sm">
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-slate-700 font-semibold mb-1 text-sm">Telepon (Opsional)</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}"
                        class="w-full px-3 py-2 border-2 border-slate-300 rounded-lg focus:outline-none focus:border-primary transition text-sm">
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-slate-700 font-semibold mb-1 text-sm">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-3 py-2 border-2 border-slate-300 rounded-lg focus:outline-none focus:border-primary transition text-sm @error('password') border-danger @enderror">
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-slate-700 font-semibold mb-1 text-sm">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full px-3 py-2 border-2 border-slate-300 rounded-lg focus:outline-none focus:border-primary transition text-sm">
                </div>

                <!-- Register Button -->
                <button type="submit" class="w-full py-2 bg-primary text-white font-bold rounded-lg hover:shadow-lg transition-all text-sm mt-6">
                    Daftar
                </button>
            </form>

            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-slate-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-slate-500">atau</span>
                </div>
            </div>

            <!-- Login Link -->
            <p class="text-center text-slate-600 text-sm">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-semibold text-primary hover:underline">Masuk di sini</a>
            </p>
        </div>

        <!-- Back Home -->
        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-white hover:underline text-sm">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Beranda
            </a>
        </div>
    </div>
</body>
</html>
