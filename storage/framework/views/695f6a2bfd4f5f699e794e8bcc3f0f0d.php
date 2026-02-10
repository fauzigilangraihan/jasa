<?php $__env->startSection('page-title', 'Manajemen Pembayaran'); ?>

<?php $__env->startSection('content'); ?>
<?php if(session('success')): ?>
<div class="mb-6 p-4 bg-success/10 text-success rounded-lg border border-success/20">
    <?php echo e(session('success')); ?>

</div>
<?php endif; ?>

<!-- Stats -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-8">
    <div class="p-4 md:p-6 bg-white rounded-xl border border-primary-dark/10 shadow-sm">
        <p class="text-slate-600 mb-2">Total Pembayaran</p>
        <p class="text-3xl md:text-3xl font-bold text-primary"><?php echo e($payments->total()); ?></p>
    </div>
    <div class="p-4 md:p-6 bg-white rounded-xl border border-primary-dark/10 shadow-sm">
        <p class="text-slate-600 mb-2">Pending</p>
        <p class="text-3xl md:text-3xl font-bold text-warning"><?php echo e($payments->where('status', 'pending')->count()); ?></p>
    </div>
    <div class="p-4 md:p-6 bg-white rounded-xl border border-primary-dark/10 shadow-sm">
        <p class="text-slate-600 mb-2">Total Revenue</p>
        <p class="text-2xl md:text-2xl font-bold text-primary">Rp<?php echo e(number_format($payments->sum('amount'), 0, ',', '.')); ?></p>
    </div>
</div>

<div class="bg-white rounded-xl border border-primary-dark/10 shadow-sm overflow-x-auto">
    <table class="w-full min-w-max md:min-w-full">
        <thead class="bg-primary/5 border-b border-primary-dark/10">
            <tr>
                <th class="px-4 md:px-6 py-3 text-left text-sm font-semibold text-primary">Transaksi ID</th>
                <th class="px-4 md:px-6 py-3 text-left text-sm font-semibold text-primary">Customer</th>
                <th class="px-4 md:px-6 py-3 text-left text-sm font-semibold text-primary">Jumlah</th>
                <th class="px-4 md:px-6 py-3 text-left text-sm font-semibold text-primary">Status</th>
                <th class="px-4 md:px-6 py-3 text-left text-sm font-semibold text-primary">Tanggal</th>
                <th class="px-4 md:px-6 py-3 text-left text-sm font-semibold text-primary">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-primary-dark/10">
            <?php $__empty_1 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="hover:bg-primary/5 transition">
                <td class="px-4 md:px-6 py-4 font-mono text-sm text-primary">#<?php echo e($payment->transaction_id); ?></td>
                <td class="px-4 md:px-6 py-4">
                    <p class="font-semibold text-slate-900"><?php echo e($payment->order->user->name); ?></p>
                    <p class="text-xs text-slate-600"><?php echo e($payment->order->user->email); ?></p>
                </td>
                <td class="px-4 md:px-6 py-4 font-semibold text-slate-900">Rp<?php echo e(number_format($payment->amount, 0, ',', '.')); ?></td>
                <td class="px-4 md:px-6 py-4">
                    <span class="px-2 md:px-3 py-1 rounded-full text-xs font-semibold
                        <?php if($payment->status === 'completed'): ?> bg-success/10 text-success
                        <?php elseif($payment->status === 'pending'): ?> bg-warning/10 text-warning
                        <?php else: ?> bg-danger/10 text-danger <?php endif; ?>">
                        <?php echo e(ucfirst($payment->status)); ?>

                    </span>
                </td>
                <td class="px-4 md:px-6 py-4 text-sm text-slate-600"><?php echo e($payment->created_at->format('d M Y H:i')); ?></td>
                <td class="px-4 md:px-6 py-4 flex gap-1 md:gap-2">
                    <a href="<?php echo e(route('admin.payments.show', $payment)); ?>" class="px-2 md:px-3 py-1 bg-primary/20 text-primary rounded hover:bg-primary/30 transition text-xs md:text-sm">
                        Detail
                    </a>
                    <?php if($payment->status === 'pending'): ?>
                    <form method="POST" action="<?php echo e(route('admin.payments.confirm', $payment)); ?>" class="inline" onsubmit="return confirm('Konfirmasi pembayaran ini?')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        <button type="submit" class="px-2 md:px-3 py-1 bg-success/20 text-success rounded hover:bg-success/30 transition text-xs md:text-sm">
                            Konfirmasi
                        </button>
                    </form>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="6" class="px-4 md:px-6 py-8 text-center text-slate-600">
                    <i class="fas fa-inbox text-4xl mb-2"></i>
                    <p>Belum ada pembayaran</p>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php if($payments->hasPages()): ?>
<div class="mt-6">
    <?php echo e($payments->links()); ?>

</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\jasa\resources\views/admin/payments/index.blade.php ENDPATH**/ ?>