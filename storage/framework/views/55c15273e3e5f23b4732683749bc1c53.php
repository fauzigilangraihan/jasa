<?php $__env->startSection('page-title', $customer->name); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8 flex items-center justify-between">
    <div>
        <a href="<?php echo e(route('admin.customers.index')); ?>" class="text-primary hover:text-primary/80 mb-4 inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
        <h1 class="text-4xl font-bold text-white mb-2"><?php echo e($customer->name); ?></h1>
        <p class="text-slate-400"><?php echo e($customer->email); ?></p>
    </div>
</div>

<!-- Customer Info & Stats -->
<div class="grid md:grid-cols-4 gap-6 mb-8">
            <div class="bg-slate-800 rounded-xl border border-slate-700 p-6">
                <div class="text-slate-400 text-sm mb-2">Total Pesanan</div>
                <div class="text-3xl font-bold text-white"><?php echo e($totalOrders); ?></div>
            </div>
            <div class="bg-slate-800 rounded-xl border border-slate-700 p-6">
                <div class="text-slate-400 text-sm mb-2">Pesanan Selesai</div>
                <div class="text-3xl font-bold text-green-500"><?php echo e($completedOrders); ?></div>
            </div>
            <div class="bg-slate-800 rounded-xl border border-slate-700 p-6">
                <div class="text-slate-400 text-sm mb-2">Pesanan Menunggu</div>
                <div class="text-3xl font-bold text-yellow-500"><?php echo e($pendingOrders); ?></div>
            </div>
            <div class="bg-slate-800 rounded-xl border border-slate-700 p-6">
                <div class="text-slate-400 text-sm mb-2">Total Belanja</div>
                <div class="text-3xl font-bold text-primary">Rp<?php echo e(number_format($totalSpending, 0, ',', '.')); ?></div>
            </div>
        </div>

        <!-- Customer Details -->
        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <div class="md:col-span-1 bg-slate-800 rounded-xl border border-slate-700 p-6">
                <h2 class="text-xl font-bold text-white mb-6">Informasi Customer</h2>
                <div class="space-y-4">
                    <div>
                        <p class="text-slate-400 text-sm mb-1">Nama</p>
                        <p class="text-white font-semibold"><?php echo e($customer->name); ?></p>
                    </div>
                    <div>
                        <p class="text-slate-400 text-sm mb-1">Email</p>
                        <p class="text-white font-semibold"><?php echo e($customer->email); ?></p>
                    </div>
                    <div>
                        <p class="text-slate-400 text-sm mb-1">Telepon</p>
                        <p class="text-white font-semibold"><?php echo e($customer->phone ?? '-'); ?></p>
                    </div>
                    <div>
                        <p class="text-slate-400 text-sm mb-1">Perusahaan</p>
                        <p class="text-white font-semibold"><?php echo e($customer->company_name ?? '-'); ?></p>
                    </div>
                    <div>
                        <p class="text-slate-400 text-sm mb-1">Alamat</p>
                        <p class="text-white font-semibold"><?php echo e($customer->address ?? '-'); ?></p>
                    </div>
                    <div>
                        <p class="text-slate-400 text-sm mb-1">Bergabung</p>
                        <p class="text-white font-semibold"><?php echo e($customer->created_at->format('d M Y H:i')); ?></p>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="md:col-span-2 bg-slate-800 rounded-xl border border-slate-700 p-6">
                <h2 class="text-xl font-bold text-white mb-6">Pesanan Terbaru</h2>
                <div class="space-y-4 max-h-96 overflow-y-auto">
                    <?php $__empty_1 = true; $__currentLoopData = $orders->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="p-4 bg-slate-700/50 rounded-lg border border-slate-600 hover:border-primary transition">
                        <div class="flex items-center justify-between mb-2">
                            <div>
                                <p class="font-semibold text-white"><?php echo e($order->project_name); ?></p>
                                <p class="text-sm text-slate-400"><?php echo e($order->service->name ?? 'N/A'); ?></p>
                            </div>
                            <span class="text-sm px-3 py-1 rounded font-semibold
                                <?php if($order->status === 'completed'): ?> bg-green-500/20 text-green-400
                                <?php elseif($order->status === 'in_progress'): ?> bg-blue-500/20 text-blue-400
                                <?php elseif($order->status === 'pending'): ?> bg-yellow-500/20 text-yellow-400
                                <?php else: ?> bg-red-500/20 text-red-400 <?php endif; ?>">
                                <?php echo e(ucfirst($order->status)); ?>

                            </span>
                        </div>
                        <div class="flex items-center justify-between text-sm text-slate-400">
                            <span>Rp<?php echo e(number_format($order->total_price, 0, ',', '.')); ?></span>
                            <span><?php echo e($order->created_at->format('d M Y')); ?></span>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-slate-400 text-center py-8">Belum ada pesanan</p>
                    <?php endif; ?>
                </div>
                <?php if($orders->count() > 5): ?>
                <div class="mt-4 pt-4 border-t border-slate-600">
                    <a href="#" class="text-primary hover:text-primary/80 text-sm font-semibold">Lihat semua pesanan →</a>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Payments History -->
        <div class="bg-slate-800 rounded-xl border border-slate-700 p-6">
            <h2 class="text-xl font-bold text-white mb-6">Riwayat Pembayaran</h2>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-700/50 border-b border-slate-700">
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Pesanan</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Jumlah</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Metode</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-slate-300">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-b border-slate-700 hover:bg-slate-700/30 transition">
                            <td class="px-6 py-4 text-white font-semibold">
                                <?php echo e($payment->order->project_name ?? 'N/A'); ?>

                            </td>
                            <td class="px-6 py-4 text-white font-semibold">
                                Rp<?php echo e(number_format($payment->amount, 0, ',', '.')); ?>

                            </td>
                            <td class="px-6 py-4 text-slate-300">
                                <i class="fas fa-credit-card mr-2"></i><?php echo e(ucfirst($payment->payment_method)); ?>

                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold
                                    <?php if($payment->status === 'confirmed'): ?> bg-green-500/20 text-green-400
                                    <?php elseif($payment->status === 'pending'): ?> bg-yellow-500/20 text-yellow-400
                                    <?php else: ?> bg-red-500/20 text-red-400 <?php endif; ?>">
                                    <?php echo e(ucfirst($payment->status)); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-400">
                                <?php echo e($payment->created_at->format('d M Y H:i')); ?>

                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-400">
                                Belum ada pembayaran
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if($payments->count() > 0): ?>
            <div class="mt-4 pt-4 border-t border-slate-600">
                <?php echo e($payments->links()); ?>

            </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\jasa\resources\views/admin/customers/show.blade.php ENDPATH**/ ?>