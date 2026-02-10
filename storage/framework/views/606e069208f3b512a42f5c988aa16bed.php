<?php $__env->startSection('title', 'Portfolio - fauziDev'); ?>

<?php $__env->startSection('content'); ?>
<!-- Header -->
<section class="py-20 bg-gradient-to-r from-primary to-accent text-white">
    <div class="container mx-auto px-4">
        <h1 class="text-5xl font-bold mb-4">Portfolio Kami</h1>
        <p class="text-xl opacity-90">Proyek-proyek terbaik yang telah kami selesaikan</p>
    </div>
</section>

<!-- Portfolio Grid -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php $__currentLoopData = [
                ['title' => 'E-Commerce Platform', 'category' => 'Web Development', 'image' => 'fa-shopping-cart'],
                ['title' => 'SaaS Dashboard', 'category' => 'Web Development', 'image' => 'fa-chart-line'],
                ['title' => 'Mobile Social App', 'category' => 'Mobile App', 'image' => 'fa-comments'],
                ['title' => 'Design System', 'category' => 'UI/UX Design', 'image' => 'fa-palette'],
                ['title' => 'API Backend', 'category' => 'Web Development', 'image' => 'fa-server'],
                ['title' => 'Content Management', 'category' => 'Web Development', 'image' => 'fa-file-alt'],
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="group overflow-hidden rounded-2xl bg-slate-100 cursor-pointer hover:shadow-xl transition-all">
                <div class="h-48 bg-gradient-to-br from-primary/10 to-accent/10 flex items-center justify-center overflow-hidden relative">
                    <i class="fas <?php echo e($project['image']); ?> text-6xl text-primary/20 group-hover:scale-110 transition-transform"></i>
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6">
                        <a href="#" class="text-white font-bold flex items-center">
                            Lihat Detail <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
                <div class="p-6">
                    <span class="inline-block px-3 py-1 bg-primary/10 text-primary rounded-full text-sm font-semibold mb-2">
                        <?php echo e($project['category']); ?>

                    </span>
                    <h3 class="text-xl font-bold"><?php echo e($project['title']); ?></h3>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="py-20 bg-slate-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-4">Testimoni Klien</h2>
            <p class="text-xl text-slate-600">Apa kata klien kami tentang layanan kami</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <?php $__currentLoopData = [
                [
                    'name' => 'Budi Santoso',
                    'company' => 'PT Tech Innovate',
                    'text' => 'fauziDev sangat profesional dan responsif. Proyek selesai tepat waktu dengan kualitas luar biasa.'
                ],
                [
                    'name' => 'Siti Nurhaliza',
                    'company' => 'Digital Agency XYZ',
                    'text' => 'Sangat puas dengan hasilnya. Tim mereka mengerti dengan sempurna kebutuhan bisnis kami.'
                ],
                [
                    'name' => 'Ahmad Wijaya',
                    'company' => 'E-Commerce Store',
                    'text' => 'Dari konsultasi hingga implementasi, semua berjalan lancar. Highly recommended!'
                ],
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="p-8 bg-white rounded-2xl border border-slate-200">
                <div class="flex items-center mb-4">
                    <?php for($i = 0; $i < 5; $i++): ?>
                    <i class="fas fa-star text-secondary"></i>
                    <?php endfor; ?>
                </div>
                <p class="text-slate-700 mb-6 italic">"<?php echo e($testimonial['text']); ?>"</p>
                <div>
                    <p class="font-bold"><?php echo e($testimonial['name']); ?></p>
                    <p class="text-sm text-slate-600"><?php echo e($testimonial['company']); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\jasa\resources\views/portfolio.blade.php ENDPATH**/ ?>