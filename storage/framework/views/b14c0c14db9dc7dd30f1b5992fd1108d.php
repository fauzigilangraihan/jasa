<?php $__env->startSection('page-title', 'Laporan Pembayaran'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8 flex items-center justify-between">
    <div>
        <a href="<?php echo e(route('admin.reports.index')); ?>" class="text-primary hover:text-primary/80 mb-4 inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
        <h1 class="text-4xl font-bold text-white mb-2">Laporan Pembayaran</h1>
        <p class="text-slate-400">Kelola dan pantau pembayaran pelanggan</p>
    </div>
</div>

<!-- Key Metrics -->
<div class="grid md:grid-cols-3 gap-6 mb-8">
            <div class="bg-slate-800 rounded-xl border border-slate-700 p-6">
                <p class="text-slate-400 text-sm mb-2">Pembayaran Dikonfirmasi</p>
                <p class="text-3xl font-bold text-green-400">Rp<?php echo e(number_format($confirmedAmount, 0, ',', '.')); ?></p>
            </div>
            <div class="bg-slate-800 rounded-xl border border-slate-700 p-6">
                <p class="text-slate-400 text-sm mb-2">Pembayaran Menunggu</p>
                <p class="text-3xl font-bold text-yellow-400">Rp<?php echo e(number_format($pendingAmount, 0, ',', '.')); ?></p>
            </div>
            <div class="bg-slate-800 rounded-xl border border-slate-700 p-6">
                <p class="text-slate-400 text-sm mb-2">Rata-rata Pembayaran</p>
                <p class="text-3xl font-bold text-primary">Rp<?php echo e(number_format($averagePayment, 0, ',', '.')); ?></p>
            </div>
        </div>

        <!-- Filter -->
        <form method="GET" class="bg-slate-800 rounded-xl border border-slate-700 p-6 mb-8">
            <div class="grid md:grid-cols-5 gap-4 items-end">
                <div>
                    <label class="block text-slate-300 font-semibold mb-2">Dari Tanggal</label>
                    <input type="date" name="from_date" value="<?php echo e(request('from_date')); ?>" class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white">
                </div>
                <div>
                    <label class="block text-slate-300 font-semibold mb-2">Hingga Tanggal</label>
                    <input type="date" name="to_date" value="<?php echo e(request('to_date')); ?>" class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white">
                </div>
                <div>
                    <label class="block text-slate-300 font-semibold mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white">
                        <option value="">Semua Status</option>
                        <option value="pending" <?php echo e(request('status') === 'pending' ? 'selected' : ''); ?>>Pending</option>
                        <option value="confirmed" <?php echo e(request('status') === 'confirmed' ? 'selected' : ''); ?>>Confirmed</option>
                    </select>
                </div>
                <div></div>
                <button type="submit" class="w-full px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/80 transition font-semibold">
                    <i class="fas fa-filter mr-2"></i>Filter
                </button>
            </div>
        </form>

        <!-- Payments Table -->
        <div class="bg-slate-800 rounded-xl border border-slate-700 overflow-hidden">
            <div class="p-6 border-b border-slate-700">
                <h2 class="text-xl font-bold text-white">Daftar Pembayaran</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-700/50 border-b border-slate-700">
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Customer</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Pesanan</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Metode</th>
                            <th class="px-6 py-4 text-right text-sm font-semibold text-slate-300">Jumlah</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-slate-300">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-b border-slate-700 hover:bg-slate-700/30 transition">
                            <td class="px-6 py-4 text-white font-semibold"><?php echo e($payment->order->user->name ?? 'N/A'); ?></td>
                            <td class="px-6 py-4 text-slate-300"><?php echo e($payment->order->project_name ?? 'N/A'); ?></td>
                            <td class="px-6 py-4 text-slate-300">
                                <i class="fas fa-credit-card mr-2"></i><?php echo e(ucfirst($payment->payment_method)); ?>

                            </td>
                            <td class="px-6 py-4 text-right text-white font-semibold">
                                Rp<?php echo e(number_format($payment->amount, 0, ',', '.')); ?>

                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold
                                    <?php if($payment->status === 'confirmed'): ?> bg-green-500/20 text-green-400
                                    <?php elseif($payment->status === 'pending'): ?> bg-yellow-500/20 text-yellow-400
                                    <?php else: ?> bg-red-500/20 text-red-400 <?php endif; ?>">
                                    <?php echo e(ucfirst($payment->status)); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-400"><?php echo e($payment->created_at->format('d M Y H:i')); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-slate-400">
                                Tidak ada data pembayaran
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-slate-700">
                <?php echo e($payments->links()); ?>

            </div>
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\jasa\resources\views/admin/reports/payments.blade.php ENDPATH**/ ?>