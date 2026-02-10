<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'fauziDev - Solusi Pengembangan Web Profesional')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-white text-slate-900">
    <!-- Navbar -->
    <nav class="fixed top-0 w-full z-50 bg-white/95 backdrop-blur-md border-b border-slate-200/30 shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-2 group">
                    <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center text-white font-bold text-lg">
                        <i class="fas fa-code"></i>
                    </div>
                    <span class="text-2xl font-bold text-primary">
                        fauziDev
                    </span>
                </a>

                <!-- Menu -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg text-slate-600 hover:text-primary font-semibold transition-all hover:bg-primary/5">
                        <i class="fas fa-home mr-2"></i>Beranda
                    </a>
                    <a href="{{ route('services') }}" class="px-4 py-2 rounded-lg text-slate-600 hover:text-primary font-semibold transition-all hover:bg-primary/5">
                        <i class="fas fa-briefcase mr-2"></i>Layanan
                    </a>
                    <a href="{{ route('portfolio') }}" class="px-4 py-2 rounded-lg text-slate-600 hover:text-primary font-semibold transition-all hover:bg-primary/5">
                        <i class="fas fa-palette mr-2"></i>Portfolio
                    </a>
                    <a href="{{ route('contact') }}" class="px-4 py-2 rounded-lg text-slate-600 hover:text-primary font-semibold transition-all hover:bg-primary/5">
                        <i class="fas fa-envelope mr-2"></i>Kontak
                    </a>
                </div>

                <!-- Auth & Contact -->
                <div class="hidden md:flex items-center space-x-3">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-slate-100 text-primary rounded-lg font-semibold hover:bg-slate-200 transition">
                                <i class="fas fa-cog mr-2"></i>Admin
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-slate-100 text-primary rounded-lg font-semibold hover:bg-slate-200 transition">
                                <i class="fas fa-user mr-2"></i>Dashboard
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 text-slate-600 hover:text-danger font-semibold transition">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-slate-600 hover:text-primary font-semibold transition">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="px-6 py-2 bg-primary text-white rounded-xl font-semibold hover:shadow-lg transition-all">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white py-12 mt-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">fauziDev</h3>
                    <p class="text-slate-400">Solusi pengembangan web profesional dan inovatif</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Layanan</h4>
                    <ul class="space-y-2 text-slate-400">
                        <li><a href="{{ route('services') }}" class="hover:text-primary transition">Web Development</a></li>
                        <li><a href="{{ route('services') }}" class="hover:text-primary transition">UI/UX Design</a></li>
                        <li><a href="{{ route('services') }}" class="hover:text-primary transition">Mobile App</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Tautan</h4>
                    <ul class="space-y-2 text-slate-400">
                        <li><a href="{{ route('home') }}" class="hover:text-primary transition">Beranda</a></li>
                        <li><a href="{{ route('portfolio') }}" class="hover:text-primary transition">Portfolio</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-primary transition">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Sosial Media</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-primary hover:text-secondary transition"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-primary hover:text-secondary transition"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-primary hover:text-secondary transition"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-primary hover:text-secondary transition"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-slate-800 pt-8 text-center text-slate-400">
                <p>&copy; 2024 fauziDev. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
