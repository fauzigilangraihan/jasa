<?php $__env->startSection('title', 'Kontak - fauziDev'); ?>

<?php $__env->startSection('content'); ?>
<section class="py-24 bg-[#0A192F] text-[#FDF8F1]">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold mb-4 tracking-tight">Hubungi Kami</h1>
        <div class="w-20 h-1 bg-[#FDF8F1] mx-auto mb-6"></div>
        <p class="text-xl opacity-80 max-w-2xl mx-auto">Siap membantu Anda mewujudkan proyek digital impian dengan solusi teknologi terkini.</p>
    </div>
</section>

<section class="py-20 bg-[#FDF8F1]">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-16">
            <div class="bg-white p-8 md:p-10 rounded-2xl shadow-sm border border-[#0A192F]/5">
                <h2 class="text-3xl font-bold mb-8 text-[#0A192F]">Kirim Pesan</h2>
                <form class="space-y-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[#0A192F] font-semibold mb-2 text-sm uppercase tracking-wider">Nama Lengkap</label>
                            <input type="text" placeholder="John Doe" class="w-full px-4 py-3 bg-[#FDF8F1]/30 border border-[#0A192F]/10 rounded-lg focus:outline-none focus:border-[#0A192F] transition">
                        </div>
                        <div>
                            <label class="block text-[#0A192F] font-semibold mb-2 text-sm uppercase tracking-wider">Email</label>
                            <input type="email" placeholder="john@example.com" class="w-full px-4 py-3 bg-[#FDF8F1]/30 border border-[#0A192F]/10 rounded-lg focus:outline-none focus:border-[#0A192F] transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[#0A192F] font-semibold mb-2 text-sm uppercase tracking-wider">Layanan</label>
                        <select class="w-full px-4 py-3 bg-[#FDF8F1]/30 border border-[#0A192F]/10 rounded-lg focus:outline-none focus:border-[#0A192F] transition">
                            <option>Pilih Layanan</option>
                            <option>Web Development</option>
                            <option>Mobile App</option>
                            <option>UI/UX Design</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[#0A192F] font-semibold mb-2 text-sm uppercase tracking-wider">Pesan</label>
                        <textarea rows="4" placeholder="Ceritakan kebutuhan proyek Anda..." class="w-full px-4 py-3 bg-[#FDF8F1]/30 border border-[#0A192F]/10 rounded-lg focus:outline-none focus:border-[#0A192F] transition resize-none"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-[#0A192F] text-[#FDF8F1] font-bold py-4 rounded-lg hover:bg-[#112240] transition-colors shadow-lg uppercase tracking-widest text-sm">
                        Kirim Sekarang
                    </button>
                </form>
            </div>

            <div class="flex flex-col justify-center">
                <h2 class="text-3xl font-bold mb-10 text-[#0A192F]">Informasi Kontak</h2>

                <div class="space-y-10">
                    <div class="flex items-start gap-6">
                        <div class="flex-shrink-0 w-12 h-12 bg-[#0A192F] rounded-full flex items-center justify-center">
                            <i class="fas fa-phone text-[#FDF8F1]"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-[#0A192F]">Telepon</h3>
                            <p class="text-slate-600">+62 812 3456 7890</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-6">
                        <div class="flex-shrink-0 w-12 h-12 bg-[#0A192F] rounded-full flex items-center justify-center">
                            <i class="fas fa-envelope text-[#FDF8F1]"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-[#0A192F]">Email</h3>
                            <p class="text-slate-600">hello@fauzidev.com</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-6">
                        <div class="flex-shrink-0 w-12 h-12 bg-[#25D366] rounded-full flex items-center justify-center">
                            <i class="fab fa-whatsapp text-white"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-[#0A192F]">WhatsApp</h3>
                            <a href="https://wa.me/628123456789" class="text-[#0A192F] font-semibold border-b-2 border-[#0A192F] hover:opacity-70 transition-opacity">Mulai Chat Sekarang</a>
                        </div>
                    </div>
                </div>

                <div class="mt-16 p-6 border-l-2 border-[#0A192F] bg-white rounded-r-lg">
                    <p class="italic text-slate-600 text-sm">"Kami percaya bahwa komunikasi yang baik adalah kunci utama keberhasilan setiap proyek digital."</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold text-center mb-12 text-[#0A192F]">Jam Operasional</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <?php $__currentLoopData = [
                ['day' => 'Senin - Jumat', 'time' => '09:00 - 18:00'],
                ['day' => 'Sabtu', 'time' => '10:00 - 16:00'],
                ['day' => 'Minggu', 'time' => 'Tutup'],
                ['day' => 'Emergency', 'time' => '24/7 (WA)'],
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="text-center">
                <p class="font-bold text-[#0A192F] uppercase text-xs tracking-widest mb-2"><?php echo e($schedule['day']); ?></p>
                <p class="text-slate-500 text-sm"><?php echo e($schedule['time']); ?></p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\jasa\resources\views/contact.blade.php ENDPATH**/ ?>