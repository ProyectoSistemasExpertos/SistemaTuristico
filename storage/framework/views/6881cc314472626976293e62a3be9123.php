
<?php $__env->startSection('body'); ?>


<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-6 mb-4">
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <?php if(session('success')): ?>
        <script>
            toastr.success("<?php echo e(session('success')); ?>");
        </script>
        <?php endif; ?>

      

        <?php
        $categoryIcons = [
        1 => ['icon' => 'fa-mountain'],
        2 => ['icon' => 'fa-umbrella-beach'],
        3 => ['icon' => 'fa-city'],
        ];
        ?>

        <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <div class="card mb-2">
            <div class="card-body">

                <div class="row g-2 mb-2">
                    <div class="col-md-4">
                        <?php if(!empty($item->image)): ?>
                        <img class="img-fluid rounded" src="<?php echo e(asset('upload/booking_images/' . $item->image)); ?>" alt="Imagen de la reserva">
                        <?php else: ?>
                        <img class="img-fluid rounded" src="<?php echo e(asset('upload/sinFoto.jpg')); ?>" alt="Sin imagen">
                        <?php endif; ?>
                    </div>
                    <div class="col-md-8">
                        <h3 class="card-title">
                            <i class="fa-solid <?php echo e($categoryIcons[$item->idCategory]['icon']); ?>"></i>
                            <?php echo e($item->title); ?>

                        </h3>
                        <h5 class="card-subtitle mb-2 text-muted"><?php echo e($item->typeCategory); ?></h5>
                        <p class="card-text mb-1"><strong>Ubicado en:</strong> <?php echo e($item->location); ?></p>
                        <p class="card-text mb-1"><strong>Máximo de personas:</strong> <?php echo e($item->totalPossibleReservation); ?></p>
                        <p class="card-text mb-1"><strong>Precio por noche:</strong> ₡<?php echo e($item->price); ?></p>
                        <!-- Asegúrate de tener las variables disponibles: $categoryIcons y $item->idCategory -->
                        <p class="card-text"><strong>Puntuación:</strong> <?php echo e($valoration[$item->idBooking]); ?> <i class="fa-regular fa-star"></i></p>
                        <div class="action-container d-flex justify-content-between">
                            <a href="<?php echo e(route('booking.index', $item->idBooking)); ?>" class="btn btn-primary ver-mas ml-auto" data-id="<?php echo e($item->idBooking); ?>" id="ver-mas-link-<?php echo e($item->idBooking); ?>">Ver más</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </section>

</div>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('body.master_body', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\ProyectoInformatica\Backend\resources\views/body/index.blade.php ENDPATH**/ ?>