@extends('layouts.app')

@section('title', 'Kontak - fauziDev')

@section('content')
<!-- Header -->
<section class="py-20 bg-gradient-to-r from-primary to-accent text-white">
    <div class="container mx-auto px-4">
        <h1 class="text-5xl font-bold mb-4">Hubungi Kami</h1>
        <p class="text-xl opacity-90">Siap membantu Anda mewujudkan proyek digital impian</p>
    </div>
</section>

<!-- Contact Content -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div>
                <h2 class="text-3xl font-bold mb-8">Kirim Pesan</h2>
                <form class="space-y-6">
                    <div>
                        <label class="block text-slate-700 font-semibold mb-2">Nama Lengkap</label>
                        <input type="text" placeholder="John Doe" class="w-full px-4 py-3 border-2 border-slate-300 rounded-lg focus:outline-none focus:border-primary transition">
                    </div>

                    <div>
                        <label class="block text-slate-700 font-semibold mb-2">Email</label>
                        <input type="email" placeholder="john@example.com" class="w-full px-4 py-3 border-2 border-slate-300 rounded-lg focus:outline-none focus:border-primary transition">
                    </div>

                    <div>
                        <label class="block text-slate-700 font-semibold mb-2">Nomor Telepon</label>
                        <input type="tel" placeholder="+62 812 3456 7890" class="w-full px-4 py-3 border-2 border-slate-300 rounded-lg focus:outline-none focus:border-primary transition">
                    </div>

                    <div>
                        <label class="block text-slate-700 font-semibold mb-2">Layanan yang Diinginkan</label>
                        <select class="w-full px-4 py-3 border-2 border-slate-300 rounded-lg focus:outline-none focus:border-primary transition bg-white">
                            <option>Pilih Layanan</option>
                            <option>Web Development</option>
                            <option>Mobile App</option>
                            <option>UI/UX Design</option>
                            <option>Konsultasi</option>
                            <option>Maintenance</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-slate-700 font-semibold mb-2">Pesan</label>
                        <textarea rows="5" placeholder="Ceritakan kebutuhan proyek Anda..." class="w-full px-4 py-3 border-2 border-slate-300 rounded-lg focus:outline-none focus:border-primary transition resize-none"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-primary to-[#FF8C5A] text-white font-bold py-3 rounded-lg hover:shadow-lg transition-shadow">
                        Kirim Pesan
                    </button>
                </form>
            </div>

            <!-- Contact Information -->
            <div>
                <h2 class="text-3xl font-bold mb-8">Informasi Kontak</h2>

                <div class="space-y-8">
                    <!-- Phone -->
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-primary to-[#FF8C5A] rounded-lg flex items-center justify-center">
                                <i class="fas fa-phone text-white text-lg"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg mb-1">Telepon</h3>
                            <p class="text-slate-600">+62 812 3456 7890</p>
                            <p class="text-slate-600 text-sm mt-1">Senin - Jumat, 09:00 - 18:00</p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-secondary to-[#FFD93D] rounded-lg flex items-center justify-center">
                                <i class="fas fa-envelope text-white text-lg"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg mb-1">Email</h3>
                            <p class="text-slate-600">hello@fauzidev.com</p>
                            <p class="text-slate-600 text-sm mt-1">Respon dalam 24 jam</p>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-accent to-[#4AFF6A] rounded-lg flex items-center justify-center">
                                <i class="fas fa-map-marker-alt text-white text-lg"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg mb-1">Alamat</h3>
                            <p class="text-slate-600">Jakarta, Indonesia</p>
                            <p class="text-slate-600 text-sm mt-1">Layanan Online & Offline</p>
                        </div>
                    </div>

                    <!-- WhatsApp -->
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-[#25D366] to-[#20BA60] rounded-lg flex items-center justify-center">
                                <i class="fab fa-whatsapp text-white text-lg"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg mb-1">WhatsApp</h3>
                            <a href="https://wa.me/628123456789" class="text-primary hover:underline">+62 812 3456 7890</a>
                            <p class="text-slate-600 text-sm mt-1">Chat langsung dengan tim</p>
                        </div>
                    </div>
                </div>

                <!-- CTA -->
                <div class="mt-12 p-8 bg-gradient-to-r from-primary/5 to-accent/5 border-l-4 border-primary rounded-lg">
                    <h3 class="font-bold text-lg mb-2">Butuh Jawaban Cepat?</h3>
                    <p class="text-slate-600 mb-4">Hubungi kami via WhatsApp untuk respons yang lebih cepat.</p>
                    <a href="https://wa.me/628123456789" class="inline-block px-6 py-3 bg-gradient-to-r from-[#25D366] to-[#20BA60] text-white font-bold rounded-lg hover:shadow-lg transition-shadow">
                        <i class="fab fa-whatsapp mr-2"></i>Chat di WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map or Additional Info -->
<section class="py-20 bg-slate-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Jam Operasional</h2>
        <div class="grid md:grid-cols-4 gap-6">
            @foreach([
                ['day' => 'Senin - Jumat', 'time' => '09:00 - 18:00', 'icon' => 'fa-calendar-check'],
                ['day' => 'Sabtu', 'time' => '10:00 - 16:00', 'icon' => 'fa-calendar'],
                ['day' => 'Minggu', 'time' => 'Tutup', 'icon' => 'fa-ban'],
                ['day' => 'Emergency', 'time' => 'Hubungi WA', 'icon' => 'fa-phone-alt'],
            ] as $schedule)
            <div class="text-center p-6 bg-white rounded-lg">
                <i class="fas {{ $schedule['icon'] }} text-3xl text-primary mb-3"></i>
                <p class="font-bold">{{ $schedule['day'] }}</p>
                <p class="text-slate-600">{{ $schedule['time'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
