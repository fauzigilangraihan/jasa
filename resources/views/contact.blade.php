@extends('layouts.app')

@section('title', 'Kontak - fauziDev')

@section('content')
<section class="py-24 bg-[#0A192F] text-[#FDF8F1]">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold mb-4 tracking-tight">Hubungi Kami</h1>
        <div class="w-20 h-1 bg-[#FDF8F1] mx-auto mb-6"></div>
        <p class="text-xl opacity-80 max-w-2xl mx-auto font-light">Siap membantu Anda mewujudkan proyek digital impian dengan sentuhan profesional.</p>
    </div>
</section>

<section class="py-20 bg-[#FDF8F1]">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-16">
            <div class="bg-white p-8 md:p-12 rounded-2xl shadow-sm border border-[#0A192F]/5">
                <h2 class="text-3xl font-bold mb-8 text-[#0A192F]">Kirim Pesan</h2>
                <form class="space-y-6">
                    <div>
                        <label class="block text-[#0A192F] font-semibold mb-2 text-sm uppercase tracking-widest">Nama Lengkap</label>
                        <input type="text" placeholder="John Doe" class="w-full px-4 py-3 bg-[#FDF8F1]/30 border border-[#0A192F]/10 rounded-xl focus:outline-none focus:border-[#0A192F] transition text-[#0A192F]">
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[#0A192F] font-semibold mb-2 text-sm uppercase tracking-widest">Email</label>
                            <input type="email" placeholder="john@example.com" class="w-full px-4 py-3 bg-[#FDF8F1]/30 border border-[#0A192F]/10 rounded-xl focus:outline-none focus:border-[#0A192F] transition text-[#0A192F]">
                        </div>
                        <div>
                            <label class="block text-[#0A192F] font-semibold mb-2 text-sm uppercase tracking-widest">Telepon</label>
                            <input type="tel" placeholder="+62 8..." class="w-full px-4 py-3 bg-[#FDF8F1]/30 border border-[#0A192F]/10 rounded-xl focus:outline-none focus:border-[#0A192F] transition text-[#0A192F]">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[#0A192F] font-semibold mb-2 text-sm uppercase tracking-widest">Layanan</label>
                        <select class="w-full px-4 py-3 bg-[#FDF8F1]/30 border border-[#0A192F]/10 rounded-xl focus:outline-none focus:border-[#0A192F] transition text-[#0A192F]">
                            <option>Pilih Layanan</option>
                            <option>Web Development</option>
                            <option>Mobile App</option>
                            <option>UI/UX Design</option>
                            <option>Konsultasi</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[#0A192F] font-semibold mb-2 text-sm uppercase tracking-widest">Pesan</label>
                        <textarea rows="4" placeholder="Ceritakan proyek Anda..." class="w-full px-4 py-3 bg-[#FDF8F1]/30 border border-[#0A192F]/10 rounded-xl focus:outline-none focus:border-[#0A192F] transition resize-none text-[#0A192F]"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-[#0A192F] text-[#FDF8F1] font-bold py-4 rounded-xl hover:bg-[#112240] transition-all transform hover:-translate-y-1 shadow-lg uppercase tracking-[0.2em] text-sm">
                        Kirim Sekarang
                    </button>
                </form>
            </div>

            <div class="flex flex-col justify-center">
                <h2 class="text-3xl font-bold mb-10 text-[#0A192F]">Informasi Kontak</h2>

                <div class="space-y-10">
                    <div class="flex items-start gap-6">
                        <div class="flex-shrink-0 w-14 h-14 bg-[#0A192F] rounded-2xl flex items-center justify-center rotate-3">
                            <i class="fas fa-phone text-[#FDF8F1] text-xl -rotate-3"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-[#0A192F] mb-1">Hubungi Kami</h3>
                            <p class="text-slate-600">+62 812 3456 7890</p>
                            <a href="https://wa.me/628123456789" class="text-[#0A192F] text-sm font-bold border-b-2 border-[#0A192F] mt-2 inline-block hover:opacity-70 transition">Chat via WhatsApp</a>
                        </div>
                    </div>

                    <div class="flex items-start gap-6">
                        <div class="flex-shrink-0 w-14 h-14 bg-[#0A192F] rounded-2xl flex items-center justify-center -rotate-3">
                            <i class="fas fa-envelope text-[#FDF8F1] text-xl rotate-3"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-[#0A192F] mb-1">Email Resmi</h3>
                            <p class="text-slate-600">hello@fauzidev.com</p>
                            <p class="text-xs text-slate-400 mt-1 italic">Dibalas dalam 24 jam</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-6">
                        <div class="flex-shrink-0 w-14 h-14 bg-[#0A192F] rounded-2xl flex items-center justify-center rotate-3">
                            <i class="fas fa-map-marker-alt text-[#FDF8F1] text-xl -rotate-3"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-[#0A192F] mb-1">Lokasi</h3>
                            <p class="text-slate-600">Bandung, Indonesia</p>
                            <p class="text-xs text-slate-400 mt-1">Layanan tersedia Nasional secara Remote</p>
                        </div>
                    </div>
                </div>

                <div class="mt-16 p-8 border border-[#0A192F]/10 rounded-2xl bg-[#0A192F]/5 relative overflow-hidden">
                    <i class="fas fa-quote-right absolute -right-4 -bottom-4 text-6xl text-[#0A192F]/5"></i>
                    <p class="text-[#0A192F] font-medium italic relative z-10">"Kualitas adalah prioritas kami. Setiap baris kode yang kami tulis dirancang untuk kemajuan bisnis Anda."</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto bg-[#0A192F] rounded-[2rem] p-10 md:p-16 text-[#FDF8F1] shadow-2xl">
            <h2 class="text-3xl font-bold text-center mb-12">Jam Operasional</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @foreach([
                    ['day' => 'Senin - Jumat', 'time' => '09:00 - 18:00'],
                    ['day' => 'Sabtu', 'time' => '10:00 - 16:00'],
                    ['day' => 'Minggu', 'time' => 'Tutup'],
                    ['day' => 'Support', 'time' => '24/7 (WA)'],
                ] as $schedule)
                <div class="text-center">
                    <p class="text-[#FDF8F1]/60 text-xs uppercase tracking-widest mb-2">{{ $schedule['day'] }}</p>
                    <p class="font-bold text-lg">{{ $schedule['time'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
