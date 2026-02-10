<?php $__env->startSection('page-title', 'Laporan & Analitik'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8">
            <h1 class="text-4xl font-bold text-white mb-2">Laporan & Analitik</h1>
            <p class="text-slate-400">Pantau performa bisnis Anda</p>
        </div>

        <!-- Key Metrics -->
        <div class="grid md:grid-cols-4 gap-6 mb-8">
            <div class="bg-slate-800 rounded-xl border border-slate-700 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-slate-400 text-sm mb-2">Total Revenue</p>
                        <p class="text-3xl font-bold text-white">Rp<?php echo e(number_format($totalRevenue, 0, ',', '.')); ?></p>
                    </div>
                    <div class="w-12 h-12 bg-green-500/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-chart-line text-green-400 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-slate-800 rounded-xl border border-slate-700 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-slate-400 text-sm mb-2">Total Pesanan</p>
                        <p class="text-3xl font-bold text-white"><?php echo e($totalOrders); ?></p>
                    </div>
                    <div class="w-12 h-12 bg-blue-500/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-shopping-cart text-blue-400 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-slate-800 rounded-xl border border-slate-700 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-slate-400 text-sm mb-2">Total Customer</p>
                        <p class="text-3xl font-bold text-white"><?php echo e($totalCustomers); ?></p>
                    </div>
                    <div class="w-12 h-12 bg-primary/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-users text-primary text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-slate-800 rounded-xl border border-slate-700 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-slate-400 text-sm mb-2">Conversion Rate</p>
                        <p class="text-3xl font-bold text-white"><?php echo e($conversionRate); ?>%</p>
                    </div>
                    <div class="w-12 h-12 bg-secondary/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-percent text-secondary text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Report Links -->
        <div class="grid md:grid-cols-2 gap-6">
            <a href="<?php echo e(route('admin.reports.sales')); ?>" class="bg-slate-800 rounded-xl border border-slate-700 p-8 hover:border-primary transition group">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h3 class="text-2xl font-bold text-white mb-2">Laporan Penjualan</h3>
                        <p class="text-slate-400">Analisis data penjualan dan pesanan</p>
                    </div>
                    <div class="w-16 h-16 bg-blue-500/20 rounded-lg flex items-center justify-center group-hover:bg-blue-500/30 transition">
                        <i class="fas fa-chart-bar text-blue-400 text-2xl"></i>
                    </div>
                </div>
                <div class="pt-4 border-t border-slate-700">
                    <span class="text-primary font-semibold group-hover:translate-x-2 transition inline-block">
                        Lihat Laporan →
                    </span>
                </div>
            </a>

            <a href="<?php echo e(route('admin.reports.payments')); ?>" class="bg-slate-800 rounded-xl border border-slate-700 p-8 hover:border-primary transition group">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h3 class="text-2xl font-bold text-white mb-2">Laporan Pembayaran</h3>
                        <p class="text-slate-400">Kelola dan pantau pembayaran pelanggan</p>
                    </div>
                    <div class="w-16 h-16 bg-green-500/20 rounded-lg flex items-center justify-center group-hover:bg-green-500/30 transition">
                        <i class="fas fa-credit-card text-green-400 text-2xl"></i>
                    </div>
                </div>
                <div class="pt-4 border-t border-slate-700">
                    <span class="text-primary font-semibold group-hover:translate-x-2 transition inline-block">
                        Lihat Laporan →
                    </span>
                </div>
            </a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\jasa\resources\views/admin/reports/index.blade.php ENDPATH**/ ?>