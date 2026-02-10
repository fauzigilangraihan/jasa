<?php $__env->startSection('title', 'Beranda - fauziDev'); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Section -->
<section class="relative min-h-screen bg-primary text-white flex items-center overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-secondary/20 rounded-full filter blur-3xl -mr-32 -mt-32"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary-light/20 rounded-full filter blur-3xl -ml-32 -mb-32"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="animate-slide-in-left">
                <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                    Wujudkan Ide Digital Anda
                </h1>
                <p class="text-xl mb-8 text-white/90">
                    Solusi web dan aplikasi profesional untuk bisnis Anda. Kami siap mengubah visi Anda menjadi kenyataan digital yang menguntungkan.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="<?php echo e(route('services')); ?>" class="px-8 py-3 bg-secondary text-primary rounded-xl font-bold hover:shadow-lg transition-all hover:scale-105">
                        Lihat Layanan
                    </a>
                    <a href="<?php echo e(route('contact')); ?>" class="px-8 py-3 border-2 border-white text-white rounded-xl font-bold hover:bg-white/10 transition-all">
                        Hubungi Kami
                    </a>
                </div>
            </div>

            <div class="hidden md:block animate-slide-in-right">
                <div class="relative">
                    <div class="w-full h-96 bg-white/10 rounded-2xl backdrop-blur-md border border-white/20 flex items-center justify-center">
                        <i class="fas fa-laptop text-white text-9xl opacity-20"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-4">Layanan Kami</h2>
            <p class="text-xl text-slate-600">Kami menyediakan solusi lengkap untuk kebutuhan digital Anda</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="p-8 bg-slate-50 rounded-2xl hover:shadow-xl transition-all hover:-translate-y-2">
                <div class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center mb-4">
                    <i class="fas <?php echo e($service->icon); ?> text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4"><?php echo e($service->name); ?></h3>
                <p class="text-slate-600"><?php echo e($service->description); ?></p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-3 text-center py-12">
                <p class="text-slate-600">Layanan tidak tersedia</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-primary text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold mb-6">Siap Memulai Proyek Anda?</h2>
        <p class="text-xl mb-8 opacity-90">Hubungi kami hari ini untuk konsultasi gratis</p>
        <a href="https://wa.me/6285123456789" class="inline-block px-10 py-4 bg-secondary text-primary rounded-xl font-bold hover:shadow-lg transition-all hover:scale-105">
            <i class="fab fa-whatsapp mr-2"></i>Hubungi Sekarang
        </a>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\jasa\resources\views/home.blade.php ENDPATH**/ ?>