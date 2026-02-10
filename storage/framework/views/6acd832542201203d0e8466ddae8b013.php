<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - fauziDev</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css']); ?>
</head>
<body class="bg-primary min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md">
        <div class="bg-secondary rounded-2xl shadow-2xl p-8">
            <!-- Logo -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-primary rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-code text-white text-2xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-primary">fauziDev</h1>
                <p class="text-slate-600 mt-2">Masuk ke akun Anda</p>
            </div>

            <?php if($errors->any()): ?>
            <div class="mb-6 p-4 bg-danger/10 text-danger rounded-lg border border-danger/20">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p class="text-sm"><?php echo e($error); ?></p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-6">
                <?php echo csrf_field(); ?>

                <!-- Email -->
                <div>
                    <label class="block text-slate-700 font-semibold mb-2">Email</label>
                    <input type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus
                        class="w-full px-4 py-3 border-2 border-slate-300 rounded-lg focus:outline-none focus:border-primary transition <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-slate-700 font-semibold mb-2">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 border-2 border-slate-300 rounded-lg focus:outline-none focus:border-primary transition <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4">
                    <label for="remember" class="ml-2 text-slate-600 text-sm">Ingat saya</label>
                </div>

                <!-- Login Button -->
                <button type="submit" class="w-full py-3 bg-primary text-white font-bold rounded-lg hover:shadow-lg transition-all">
                    Masuk
                </button>
            </form>

            <!-- Divider -->
            <div class="relative my-8">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-slate-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-slate-500">atau</span>
                </div>
            </div>

            <!-- Register Link -->
            <p class="text-center text-slate-600">
                Belum punya akun?
                <a href="<?php echo e(route('register')); ?>" class="font-semibold text-primary hover:underline">Daftar di sini</a>
            </p>
        </div>

        <!-- Back Home -->
        <div class="text-center mt-6">
            <a href="<?php echo e(route('home')); ?>" class="text-white hover:underline">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Beranda
            </a>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\jasa\resources\views/auth/login.blade.php ENDPATH**/ ?>