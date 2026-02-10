<?php $__env->startSection('page-title', 'Manajemen Customer'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8">
            <h1 class="text-4xl font-bold text-white mb-2">Manajemen Customer</h1>
            <p class="text-slate-400">Kelola semua pelanggan Anda</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <div class="bg-slate-800 rounded-xl border border-slate-700 p-6">
                <div class="text-slate-400 text-sm mb-2">Total Customers</div>
                <div class="text-3xl font-bold text-white"><?php echo e($customers->total()); ?></div>
            </div>
            <div class="bg-slate-800 rounded-xl border border-slate-700 p-6">
                <div class="text-slate-400 text-sm mb-2">Total Orders</div>
                <div class="text-3xl font-bold text-primary">
                    <?php echo e(\App\Models\Order::whereHas('user', fn($q) => $q->where('role', 'client'))->count()); ?>

                </div>
            </div>
            <div class="bg-slate-800 rounded-xl border border-slate-700 p-6">
                <div class="text-slate-400 text-sm mb-2">Total Revenue</div>
                <div class="text-3xl font-bold text-secondary">
                    Rp<?php echo e(number_format(\App\Models\Payment::where('status', 'confirmed')->sum('amount'), 0, ',', '.')); ?>

                </div>
            </div>
        </div>

        <!-- Customers Table -->
        <div class="bg-slate-800 rounded-xl border border-slate-700 overflow-hidden">
            <div class="p-6 border-b border-slate-700">
                <h2 class="text-xl font-bold text-white">Daftar Customer</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-700/50 border-b border-slate-700">
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Nama</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Email</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Perusahaan</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-slate-300">Pesanan</th>
                            <th class="px-6 py-4 text-right text-sm font-semibold text-slate-300">Total Belanja</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-slate-300">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-b border-slate-700 hover:bg-slate-700/30 transition">
                            <td class="px-6 py-4 text-white font-semibold"><?php echo e($customer->name); ?></td>
                            <td class="px-6 py-4 text-slate-300"><?php echo e($customer->email); ?></td>
                            <td class="px-6 py-4 text-slate-400"><?php echo e($customer->company_name ?? '-'); ?></td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 bg-primary/20 text-primary rounded-full text-sm font-semibold">
                                    <?php echo e($customer->orders_count); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 text-right text-white font-semibold">
                                Rp<?php echo e(number_format($customer->orders_sum_total_price ?? 0, 0, ',', '.')); ?>

                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="<?php echo e(route('admin.customers.show', $customer)); ?>" class="inline-flex items-center px-3 py-2 bg-primary text-white rounded-lg hover:bg-primary/80 transition text-sm font-semibold">
                                    <i class="fas fa-eye mr-2"></i>Lihat Detail
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-slate-400">
                                <i class="fas fa-inbox text-3xl mb-2 block opacity-50"></i>
                                Belum ada customer
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-slate-700">
                <?php echo e($customers->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\jasa\resources\views/admin/customers/index.blade.php ENDPATH**/ ?>