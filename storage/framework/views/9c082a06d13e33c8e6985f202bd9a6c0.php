<?php $__env->startSection('content'); ?>

<div class="row justify-content-center">
    <div class="col-md-25">

        <div class="card-body">
            <form method="POST" action="<?php echo e(route('register')); ?>" class="max-w-md mx-auto">
                <?php echo csrf_field(); ?>
                <h1 class="text-gray-800 font-bold text-xl">Regístrate</h1>
                <p class="text-xs font-bold text-gray-600 mb-1">Por favor, completa el siguiente formulario...</p>

                <div class="grid grid-cols-2 md:grid-cols-2 gap-1">

                <div class="flex items-center border-2 py-2 px-1 rounded-lg mb-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                    <input id="name" name="name" placeholder="Nombre" class="pl-2 text-xs w-full focus:outline-none" type="text" value="" required autofocus>
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="flex items-center border-2 py-2 px-1 rounded-lg mb-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                    <input id="firstLastName" name="firstLastName" placeholder="Primer Apellido" class="pl-2 text-xs w-full focus:outline-none" type="text" value="" required autofocus>
                    <?php $__errorArgs = ['firstLastName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                    <div class="flex items-center border-2 py-2 px-1 rounded-lg mb-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                        <input id="secondLastName" name="secondLastName" placeholder="Segundo Apellido" class="pl-2 text-xs w-full focus:outline-none" type="text" value="" required autofocus>
                        <?php $__errorArgs = ['secondLastName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="flex items-center border-2 py-2 px-1 rounded-lg mb-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                        <input class="pl-2 text-xs w-full focus:outline-none" type="text" id="idCard" name="idCard" placeholder="Cédula" required>
                        <?php $__errorArgs = ['idCard'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="flex items-center border-2 py-2 px-1 rounded-lg mb-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M5 4c0-1.1.9-2 2-2h10a2 2 0 014 4v16a2 2 0 01-2 2H7a2 2 0 01-2-2V4zM15 2a2 2 0 0110 3.79M9 21h.01"></path>
                        </svg>
                        <input class="pl-2 text-xs w-full focus:outline-none" type="text" value="" id="phone" name="phone" placeholder="Teléfono" required>
                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="flex items-center border-2 py-2 px-1 rounded-lg mb-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 22s-8-4.5-8-12a8 8 0 1 1 16 0c0 7.5-8 12-8 12zm0 0V12"></path>
                        </svg>
                        <input class="pl-2 text-xs w-full focus:outline-none" type="text" value="" id="address" name="address" placeholder="Dirección" required>
                        <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="flex items-center border-2 py-2 px-1 rounded-lg mb-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                        <input class="pl-2 text-xs w-full focus:outline-none" type="text" value="" id="email" name="email" placeholder="Correo electrónico" required>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="flex items-center border-2 py-2 px-1 rounded-lg mb-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 6a6 6 0 100 12 6 6 0 000-12zm0 2a2 2 0 110 4 2 2 0 010-4zm0 5a2 2 0 100 4 2 2 0 000-4zm-7.485-7.485a9 9 0 0112.97-2.515M22 12h-2m2 0h-2m2 0h-2m-8-2a4 4 0 110 8 4 4 0 010-8z"></path>
                        </svg>
                        <input class="pl-2 text-xs w-full focus:outline-none" type="password" id="password" name="password" placeholder="Contraseña" required>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="flex items-center border-2 py-2 px-1 rounded-lg mb-1">
                    <select class="pl-2 font-bold text-xs w-full focus:outline-none" id="idCategory" name="idCategory" required>
                        <option value="">Selecciona tu preferencia de viajes</option>
                        <option value="1">Montañas</option>
                        <option value="2">Playas</option>
                        <option value="3">Ciudades</option>
                    </select>
                </div>
                <input type="checkbox" id="idRol" name="idRol" value="on" class="text-s">
                <strong>Soy vendedor</strong>
                <div>
                    <button type="submit" class="w-full flex justify-center bg-purple-800 hover:bg-purple-700 text-gray-100 p-2 mt-2 rounded-lg tracking-wide font-semibold cursor-pointer transition ease-in duration-500">
                        Registrarse
                    </button>
                </div>
            </form>
            <p class="text-gray-400 mt-3">
                ¿Ya tienes una cuenta? <a href="<?php echo e(route('show-login')); ?>" class="text-sm text-purple-700 hover:text-purple-700">
                    <strong> Ingresar</strong>
                </a>

            </p>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\ProyectoInformatica\Backend\resources\views/auth/register.blade.php ENDPATH**/ ?>