<?php $__env->startSection('page-title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<!-- Stats Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
    <!-- Total Customers Card -->
    <div class="p-6 bg-white rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-slate-500 text-sm font-medium mb-1">Total Customers</p>
                <p class="text-3xl font-bold text-primary"><?php echo e($totalClients); ?></p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-users text-blue-600 text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Total Orders Card -->
    <div class="p-6 bg-white rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-slate-500 text-sm font-medium mb-1">Total Pesanan</p>
                <p class="text-3xl font-bold text-primary"><?php echo e($totalOrders); ?></p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-shopping-cart text-green-600 text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Total Revenue Card -->
    <div class="p-6 bg-white rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-slate-500 text-sm font-medium mb-1">Total Revenue</p>
                <p class="text-2xl font-bold text-primary">Rp<?php echo e(number_format($totalRevenue, 0, ',', '.')); ?></p>
            </div>
            <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-money-bill-wave text-emerald-600 text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Pending Payments Card -->
    <div class="p-6 bg-white rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-slate-500 text-sm font-medium mb-1">Pending Pembayaran</p>
                <p class="text-3xl font-bold text-warning"><?php echo e($pendingPayments); ?></p>
            </div>
            <div class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-clock text-amber-600 text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders & Payments Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent Orders -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-list text-blue-600"></i>
            </div>
            <h2 class="text-lg font-bold text-slate-900">Pesanan Terbaru</h2>
        </div>
        <div class="space-y-3">
            <?php $__empty_1 = true; $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="p-4 bg-slate-50 rounded-lg border border-slate-200 hover:border-primary/30 transition">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-2">
                    <p class="font-semibold text-slate-900">#<?php echo e($order->id); ?> - <?php echo e($order->user->name); ?></p>
                    <span class="inline-flex items-center text-sm px-3 py-1 rounded-full w-fit
                        <?php if($order->status === 'completed'): ?> bg-green-100 text-green-700
                        <?php elseif($order->status === 'in_progress'): ?> bg-blue-100 text-blue-700
                        <?php else: ?> bg-amber-100 text-amber-700 <?php endif; ?>">
                        <?php echo e(ucfirst($order->status)); ?>

                    </span>
                </div>
                <p class="text-slate-600 text-sm">Rp<?php echo e(number_format($order->total_amount, 0, ',', '.')); ?> • <?php echo e($order->created_at->format('d M Y')); ?></p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center py-8">
                <i class="fas fa-inbox text-slate-300 text-3xl mb-2 block"></i>
                <p class="text-slate-500 text-sm">Belum ada pesanan</p>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Recent Payments -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-credit-card text-green-600"></i>
            </div>
            <h2 class="text-lg font-bold text-slate-900">Pembayaran Terbaru</h2>
        </div>
        <div class="space-y-3">
            <?php $__empty_1 = true; $__currentLoopData = $pendingPayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="p-4 bg-slate-50 rounded-lg border border-slate-200 hover:border-primary/30 transition">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-2">
                    <p class="font-semibold text-slate-900"><?php echo e($payment->order->user->name); ?></p>
                    <span class="inline-flex items-center text-sm px-3 py-1 rounded-full w-fit
                        <?php if($payment->status === 'confirmed'): ?> bg-green-100 text-green-700
                        <?php elseif($payment->status === 'pending'): ?> bg-amber-100 text-amber-700
                        <?php else: ?> bg-red-100 text-red-700 <?php endif; ?>">
                        <?php echo e(ucfirst($payment->status)); ?>

                    </span>
                </div>
                <p class="text-slate-600 text-sm">Rp<?php echo e(number_format($payment->amount, 0, ',', '.')); ?> • <?php echo e($payment->created_at->format('d M Y H:i')); ?></p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center py-8">
                <i class="fas fa-inbox text-slate-300 text-3xl mb-2 block"></i>
                <p class="text-slate-500 text-sm">Belum ada pembayaran</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\jasa\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>