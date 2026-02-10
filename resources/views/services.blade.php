@extends('layouts.app')

@section('title', 'Layanan - fauziDev')

@section('content')
<!-- Header -->
<section class="py-20 bg-primary text-white">
    <div class="container mx-auto px-4">
        <h1 class="text-5xl font-bold mb-4">Layanan Kami</h1>
        <p class="text-xl opacity-90">Solusi lengkap untuk semua kebutuhan digital Anda</p>
    </div>
</section>

<!-- Services Grid -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-12 mb-20">
            @foreach([
                [
                    'title' => 'Web Development',
                    'features' => ['Responsive Design', 'Fast Loading', 'SEO Optimized', 'Security Focus'],
                    'icon' => 'fa-code'
                ],
                [
                    'title' => 'UI/UX Design',
                    'features' => ['Modern Design', 'User Testing', 'Figma Design', 'Prototyping'],
                    'icon' => 'fa-pencil-ruler'
                ],
                [
                    'title' => 'Mobile App',
                    'features' => ['Native Development', 'Cross-Platform', 'App Store Ready', 'Maintenance'],
                    'icon' => 'fa-mobile-alt'
                ],
                [
                    'title' => 'Consulting',
                    'features' => ['Tech Strategy', 'Team Building', 'Process Improvement', 'Training'],
                    'icon' => 'fa-lightbulb'
                ],
            ] as $service)
            <div class="p-8 border-2 border-slate-200 rounded-2xl hover:border-primary transition-all">
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary to-accent rounded-xl flex items-center justify-center mr-4">
                        <i class="fas {{ $service['icon'] }} text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold">{{ $service['title'] }}</h3>
                </div>
                <ul class="space-y-3">
                    @foreach($service['features'] as $feature)
                    <li class="flex items-center text-slate-700">
                        <i class="fas fa-check text-accent mr-3"></i>{{ $feature }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Pricing -->
<section class="py-20 bg-slate-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-4">Paket Harga</h2>
            <p class="text-xl text-slate-600">Pilih paket yang sesuai dengan kebutuhan Anda</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @foreach([
                [
                    'name' => 'Starter',
                    'price' => '2,999',
                    'desc' => 'Untuk bisnis kecil',
                    'features' => ['Landing Page', 'Mobile Responsive', '3 Bulan Support', 'Basic SEO']
                ],
                [
                    'name' => 'Professional',
                    'price' => '7,999',
                    'desc' => 'Untuk bisnis menengah',
                    'features' => ['Full Website', 'E-Commerce Ready', '6 Bulan Support', 'Advanced SEO', 'Analytics'],
                    'featured' => true
                ],
                [
                    'name' => 'Enterprise',
                    'price' => 'Custom',
                    'desc' => 'Untuk bisnis besar',
                    'features' => ['Custom App', 'Full Support', 'Dedicated Team', 'Training & Maintenance']
                ],
            ] as $package)
            <div class="p-8 bg-white rounded-2xl {{ isset($package['featured']) ? 'border-2 border-primary shadow-xl scale-105' : 'border border-slate-200' }} transition-all">
                @if(isset($package['featured']))
                <div class="inline-block px-4 py-1 bg-primary text-white rounded-full text-sm font-bold mb-4">
                    Rekomendasi
                </div>
                @endif
                <h3 class="text-2xl font-bold mb-2">{{ $package['name'] }}</h3>
                <p class="text-slate-600 mb-4">{{ $package['desc'] }}</p>
                <div class="text-4xl font-bold text-primary mb-6">
                    Rp {{ $package['price'] }}<span class="text-sm text-slate-600">/bln</span>
                </div>
                <ul class="space-y-3 mb-8">
                    @foreach($package['features'] as $feature)
                    <li class="flex items-center text-slate-700">
                        <i class="fas fa-check text-accent mr-3"></i>{{ $feature }}
                    </li>
                    @endforeach
                </ul>
                <a href="{{ route('contact') }}" class="block w-full py-3 bg-primary text-white rounded-xl font-bold text-center hover:bg-primary/90 transition">
                    Pilih Paket
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
