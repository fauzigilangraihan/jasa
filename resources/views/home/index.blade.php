@extends('layouts.app')

@section('title', 'Beranda - fauziDev')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-screen bg-linear-to-br from-primary via-[#FF8C5A] to-[#FFB366] text-white flex items-center overflow-hidden pt-24">
    <!-- Animated background elements -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-secondary/20 rounded-full filter blur-3xl -mr-32 -mt-32"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-accent/20 rounded-full filter blur-3xl -ml-32 -mb-32"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center py-20">
            <!-- Left Content -->
            <div class="animate-slide-in-left space-y-8">
                <div class="space-y-4">
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-secondary/20 border border-secondary/40">
                        <i class="fas fa-star text-secondary mr-2"></i>
                        <span class="text-secondary font-semibold text-sm">Solusi Web Profesional #1 di Indonesia</span>
                    </div>
                    <h1 class="text-5xl md:text-7xl font-bold leading-tight">
                        Wujudkan
                        <span class="gradient-primary-reverse bg-clip-text text-transparent block">Visi Digital</span>
                        Anda
                    </h1>
                    <p class="text-lg text-slate-200 leading-relaxed max-w-xl">
                        Transformasikan bisnis Anda dengan solusi website profesional, aplikasi web modern, dan platform e-commerce yang powerful. Kami adalah partner terpercaya untuk kesuksesan digital Anda.
                    </p>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href="{{ route('orders.create') }}" class="btn-primary flex items-center justify-center space-x-2 bg-secondary text-primary hover:shadow-premium-hover">
                        <i class="fas fa-rocket"></i>
                        <span>Pesan Sekarang</span>
                    </a>
                    <a href="{{ route('services') }}" class="btn-outline border-secondary text-secondary hover:bg-secondary/10">
                        <i class="fas fa-arrow-right mr-2"></i>
                        Lihat Layanan Kami
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-6 pt-8 border-t border-white/20">
                    <div>
                        <p class="text-2xl md:text-3xl font-bold text-secondary">150+</p>
                        <p class="text-sm text-slate-300">Proyek Selesai</p>
                    </div>
                    <div>
                        <p class="text-2xl md:text-3xl font-bold text-secondary">98%</p>
                        <p class="text-sm text-slate-300">Kepuasan Klien</p>
                    </div>
                    <div>
                        <p class="text-2xl md:text-3xl font-bold text-secondary">50+</p>
                        <p class="text-sm text-slate-300">Tim Expert</p>
                    </div>
                </div>
            </div>

            <!-- Right Side - Illustration -->
            <div class="hidden lg:block animate-slide-in-right">
                <div class="relative">
                    <!-- Floating card 1 -->
                    <div class="absolute -top-10 -right-10 w-40 h-40 gradient-accent rounded-3xl opacity-20 filter blur-3xl animate-float"></div>

                    <!-- Main illustration box -->
                    <div class="relative bg-linear-to-br from-slate-800 to-slate-900 rounded-3xl p-8 shadow-premium border border-white/10 overflow-hidden">
                        <div class="absolute inset-0 opacity-10">
                            <div class="absolute top-0 right-0 w-96 h-96 bg-secondary rounded-full filter blur-3xl"></div>
                        </div>
                        <div class="relative z-10 text-center space-y-6">
                            <div class="flex justify-center space-x-4 text-4xl">
                                <i class="fas fa-code text-[#4A90E2] animate-bounce" style="animation-delay: 0s"></i>
                                <i class="fas fa-palette text-secondary animate-bounce" style="animation-delay: 0.1s"></i>
                                <i class="fas fa-rocket text-[#4A90E2] animate-bounce" style="animation-delay: 0.2s"></i>
                            </div>
                            <div>
                                <p class="text-secondary text-2xl font-bold">Website Berkualitas</p>
                                <p class="text-slate-300 text-sm mt-2">Dibangun dengan teknologi terkini dan best practices industri</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4 text-xs text-slate-300 pt-4 border-t border-white/10">
                                <div><i class="fas fa-check text-emerald-700 mr-2"></i>Responsive Design</div>
                                <div><i class="fas fa-check text-emerald-700 mr-2"></i>Fast Loading</div>
                                <div><i class="fas fa-check text-emerald-700 mr-2"></i>SEO Friendly</div>
                                <div><i class="fas fa-check text-emerald-700 mr-2"></i>Secure</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-20 bg-white dark:bg-slate-900">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16 space-y-4">
            <h2 class="text-4xl md:text-5xl font-bold text-primary dark:text-secondary">Mengapa Memilih fauziDev?</h2>
            <p class="text-lg text-slate-600 dark:text-slate-300 max-w-2xl mx-auto">Kami berkomitmen memberikan layanan terbaik dengan harga kompetitif dan hasil yang memuaskan</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $reasons = [
                    [
                        'icon' => 'fa-star',
                        'title' => 'Tim Profesional',
                        'desc' => 'Tim developer, designer, dan project manager berpengalaman lebih dari 5 tahun'
                    ],
                    [
                        'icon' => 'fa-bolt',
                        'title' => 'Teknologi Modern',
                        'desc' => 'Menggunakan framework dan tools terbaru untuk hasil optimal'
                    ],
                    [
                        'icon' => 'fa-redo',
                        'title' => 'Revisi Unlimited',
                        'desc' => 'Revisi tanpa batas sampai Anda puas dengan hasilnya'
                    ],
                    [
                        'icon' => 'fa-lock',
                        'title' => 'Keamanan Maksimal',
                        'desc' => 'SSL Certificate, backup regular, dan enkripsi data terjamin'
                    ],
                    [
                        'icon' => 'fa-headset',
                        'title' => 'Support 24/7',
                        'desc' => 'Tim support siap membantu Anda kapan saja diperlukan'
                    ],
                    [
                        'icon' => 'fa-chart-line',
                        'title' => 'Hasil Terukur',
                        'desc' => 'Analytics lengkap dan laporan performa website rutin'
                    ]
                ];
            @endphp

            @foreach($reasons as $reason)
                <div class="card-modern-hover p-8 group">
                    <div class="w-16 h-16 rounded-xl gradient-primary flex items-center justify-center text-white text-2xl mb-6 group-hover:scale-110 group-hover:shadow-glow transition-all duration-300">
                        <i class="fas {{ $reason['icon'] }}"></i>
                    </div>
                    <h3 class="text-xl font-bold text-primary dark:text-secondary mb-3">{{ $reason['title'] }}</h3>
                    <p class="text-slate-600 dark:text-slate-400">{{ $reason['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-20 bg-linear-to-b from-slate-50 to-white dark:from-slate-900 dark:to-slate-950">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16 space-y-4">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary/10 dark:bg-secondary/20">
                <i class="fas fa-briefcase text-primary dark:text-secondary mr-2"></i>
                <span class="text-primary dark:text-secondary font-semibold text-sm">Layanan Kami</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-primary dark:text-secondary">Solusi Lengkap untuk Bisnis Digital</h2>
            <p class="text-lg text-slate-600 dark:text-slate-300 max-w-2xl mx-auto">Dari website hingga aplikasi, kami sediakan semua yang Anda butuhkan</p>
        </div>

        @if($services && count($services) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($services->take(4) as $service)
                    <div class="card-modern-hover p-8 text-center group">
                        <div class="text-5xl mb-4 group-hover:scale-125 transition-transform duration-300">
                            <i class="fas {{ $service->icon ?? 'fa-cube' }}"></i>
                        </div>
                        <h3 class="text-xl font-bold text-primary dark:text-secondary mb-2">{{ $service->name }}</h3>
                        <p class="text-slate-600 dark:text-slate-400 text-sm mb-4">{{ Str::limit($service->description, 100) }}</p>
                        <a href="{{ route('services') }}" class="text-primary dark:text-secondary font-semibold hover:gap-2 inline-flex items-center group-hover:text-[#4A90E2] transition">
                            Pelajari lebih lanjut <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('services') }}" class="btn-primary inline-flex items-center">
                    <span>Lihat Semua Layanan</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Pricing Section -->
<section class="py-20 bg-white dark:bg-slate-900">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16 space-y-4">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary/10 dark:bg-secondary/20">
                <i class="fas fa-tag text-primary dark:text-secondary mr-2"></i>
                <span class="text-primary dark:text-secondary font-semibold text-sm">Harga Terjangkau</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-primary dark:text-secondary">Paket Harga Flexible</h2>
            <p class="text-lg text-slate-600 dark:text-slate-300 max-w-2xl mx-auto">Pilih paket yang sesuai dengan kebutuhan dan budget Anda</p>
        </div>

        @if($pricingPackages && count($pricingPackages) > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                @foreach($pricingPackages as $key => $package)
                    <div class="card-modern-hover relative group {{ $key === 1 ? 'md:scale-105 shadow-premium' : '' }}">
                        @if($key === 1)
                            <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-linear-to-r from-primary to-[#4A90E2] text-white px-4 py-1 rounded-full text-sm font-bold">
                                <i class="fas fa-star mr-2"></i>REKOMENDASI
                            </div>
                        @endif

                        <div class="p-8 h-full flex flex-col">
                            <!-- Header -->
                            <div class="mb-6">
                                <h3 class="text-2xl font-bold text-primary dark:text-secondary mb-2">{{ $package->name }}</h3>
                                <p class="text-slate-600 dark:text-slate-400 text-sm">{{ $package->description ?? 'Paket lengkap' }}</p>
                            </div>

                            <!-- Price -->
                            <div class="mb-8 pb-8 border-b border-slate-200 dark:border-slate-700">
                                <div class="flex items-baseline">
                                    <span class="text-4xl font-bold text-primary dark:text-secondary">
                                        Rp{{ number_format($package->price * 1000, 0, ',', '.') }}
                                    </span>
                                </div>
                                <p class="text-slate-600 dark:text-slate-400 text-sm mt-2">per project</p>
                            </div>

                            <!-- Features -->
                            <div class="mb-8 flex-grow space-y-4">
                                @php
                                    $features = ['Halaman Website', 'Design Modern', 'Mobile Responsive', 'SSL Certificate'];
                                @endphp
                                @foreach($features as $feature)
                                    <div class="flex items-start space-x-3">
                                        <div class="w-5 h-5 rounded-full bg-emerald-900/20 dark:bg-emerald-900/30 flex items-center justify-center mt-0.5 flex-shrink-0">
                                            <i class="fas fa-check text-emerald-700 dark:text-emerald-400 text-xs"></i>
                                        </div>
                                        <span class="text-slate-600 dark:text-slate-300">{{ $feature }}</span>
                                    </div>
                                @endforeach
                            </div>

                            <!-- CTA Button -->
                            <a href="{{ route('orders.create') }}" class="btn-primary w-full text-center {{ $key === 1 ? 'bg-secondary text-primary' : '' }}">
                                <i class="fas fa-shopping-cart mr-2"></i>Pilih Paket
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-20 bg-gradient-to-b from-slate-50 to-white dark:from-slate-900 dark:to-slate-950">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16 space-y-4">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary/10 dark:bg-secondary/20">
                <i class="fas fa-quote-left text-primary dark:text-secondary mr-2"></i>
                <span class="text-primary dark:text-secondary font-semibold text-sm">Testimoni Klien</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-primary dark:text-secondary">Kepercayaan dari Klien Kami</h2>
        </div>

        @if($testimonials && count($testimonials) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($testimonials->take(6) as $testimonial)
                    <div class="card-modern-hover p-8 group">
                        <!-- Stars -->
                        <div class="flex items-center mb-4">
                            @for($i = 0; $i < 5; $i++)
                                <i class="fas fa-star text-amber-700"></i>
                            @endfor
                        </div>

                        <!-- Content -->
                        <p class="text-slate-600 dark:text-slate-400 mb-6 italic">
                            "{{ $testimonial->content }}"
                        </p>

                        <!-- Author -->
                        <div class="flex items-center space-x-4 pt-6 border-t border-slate-200 dark:border-slate-700">
                            <div class="w-12 h-12 rounded-full gradient-primary flex items-center justify-center text-white font-bold">
                                {{ substr($testimonial->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-bold text-primary dark:text-secondary">{{ $testimonial->name }}</p>
                                <p class="text-xs text-slate-600 dark:text-slate-400">{{ $testimonial->company ?? 'Klien fauziDev' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- FAQ Section -->
<section class="py-20 bg-white dark:bg-slate-900">
    <div class="container mx-auto px-4 max-w-3xl">
        <div class="text-center mb-16 space-y-4">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary/10 dark:bg-secondary/20">
                <i class="fas fa-question-circle text-primary dark:text-secondary mr-2"></i>
                <span class="text-primary dark:text-secondary font-semibold text-sm">Pertanyaan Umum</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-primary dark:text-secondary">FAQ</h2>
        </div>

        @if($faqItems && count($faqItems) > 0)
            <div class="space-y-4">
                @foreach($faqItems as $index => $faq)
                    <div class="accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                        <button class="accordion-button w-full px-8 py-6 flex items-center justify-between bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all" data-accordion="{{ $index }}">
                            <span class="font-bold text-primary dark:text-secondary text-left">
                                <i class="fas fa-chevron-right mr-3"></i>{{ $faq->question }}
                            </span>
                            <i class="fas fa-chevron-down text-primary dark:text-secondary transition-transform accordion-icon"></i>
                        </button>
                        <div class="accordion-content hidden px-8 py-6 bg-slate-50 dark:bg-slate-900 border-t border-slate-200 dark:border-slate-700">
                            <p class="text-slate-600 dark:text-slate-400">{{ $faq->answer }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 relative bg-gradient-to-r from-primary via-[#1a4d8f] to-primary text-white overflow-hidden">
    <!-- Background elements -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-secondary/10 rounded-full filter blur-3xl -mr-32 -mt-32"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-[#4A90E2]/10 rounded-full filter blur-3xl -ml-32 -mb-32"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center space-y-8 max-w-2xl mx-auto">
            <h2 class="text-4xl md:text-5xl font-bold">
                Siap Memulai Transformasi Digital?
            </h2>
            <p class="text-lg text-slate-200">
                Hubungi kami hari ini dan dapatkan konsultasi gratis untuk proyek Anda
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center pt-4">
                <a href="{{ route('orders.create') }}" class="btn-secondary text-center flex items-center justify-center space-x-2">
                    <i class="fas fa-rocket"></i>
                    <span>Pesan Sekarang</span>
                </a>
                <a href="https://wa.me/62?text=Halo%20fauziDev%2C%20saya%20tertarik%20dengan%20layanan%20Anda" target="_blank" rel="noopener noreferrer" class="btn-outline border-secondary text-secondary hover:bg-secondary/10 flex items-center justify-center space-x-2">
                    <i class="fab fa-whatsapp"></i>
                    <span>Chat WhatsApp</span>
                </a>
            </div>
        </div>
    </div>
</section>

<script>
    // Accordion functionality
    document.querySelectorAll('.accordion-button').forEach(button => {
        button.addEventListener('click', function() {
            const content = this.nextElementSibling;
            const icon = this.querySelector('.accordion-icon');
            const isOpen = content.classList.contains('hidden');

            document.querySelectorAll('.accordion-content').forEach(item => {
                item.classList.add('hidden');
            });
            document.querySelectorAll('.accordion-icon').forEach(item => {
                item.style.transform = 'rotate(0deg)';
            });

            if (isOpen) {
                content.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
            }
        });
    });
</script>
@endsection
