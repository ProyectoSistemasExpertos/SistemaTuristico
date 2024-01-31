<?php $__env->startSection('body'); ?>


<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-6 mb-4">
                    <h1 class="m-0">BODY -> QUITARLO</h1>
                    <div class="box-header with-border">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreateBooking">
                            Crear Hospedake-IT DOES NOT WORK
                        </button>

                    </div>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        <?php
        $categoryIcons = [
        1 => ['icon' => 'fa-mountain'],
        2 => ['icon' => 'fa-umbrella-beach'],
        3 => ['icon' => 'fa-city'],
        ];
        ?>

        <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">

                            <?php if(!empty($item->image)): ?>
                            <img class="img-fluid rounded" src="<?php echo e(asset('upload/booking_images/' . $item->image)); ?>" alt="Imagen de la reserva">
                            <?php else: ?>
                            <img class="img-fluid rounded" src="<?php echo e(asset('upload/sinFoto.jpg')); ?>" alt="Sin imagen">
                            <?php endif; ?>

                            
                                
                                    <!-- Aquí colocamos el resto de los datos a la izquierda -->
                                    <h5 class="card-title">
                                        <i class="fa-solid <?php echo e($categoryIcons[$item->idCategory]['icon']); ?>"></i>
                                        <?php echo e($item->title); ?>

                                    </h5>
                                
                              
                            <p class="card-text"><strong>Puntuación:</strong> <?php echo e($valoration[$item->idBooking]); ?><i class="fa-regular fa-star"></i></p>
                            <p class="card-text"><strong>Ubicación:</strong> <?php echo e($item->location); ?></p>
                            <p class="card-text"><strong>Precio por noche:</strong> ₡<?php echo e($item->price); ?></p>
                            <p class="card-text"><strong>Máximo de personas:</strong> <?php echo e($item->totalPossibleReservation); ?></p>
                            <p class="card-text"><strong>Tipo de sector:</strong> <?php echo e($item->typeCategory); ?></p>
                            <div class="action-container d-flex justify-content-between">
                                <a href="<?php echo e(route('booking.index', $item->idBooking)); ?>" class="btn btn-primary ver-mas ml-auto" data-id="<?php echo e($item->idBooking); ?>" id="ver-mas-link-<?php echo e($item->idBooking); ?>">Ver más</a>
                            </div>

                        </div>
                        <!-- Agregar un contenedor div con la clase .action-container para el enlace Ver más -->

                    </div>
                </div>
            </div>

        </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </section>
    <script>
        $(document).ready(function() {
            $('#ver-mas-link-<?php echo e($item->idBooking); ?>').click(function(event) {
                event.preventDefault(); // Evita la acción predeterminada del enlace (navegación)

                // Obtiene la URL del enlace
                var url = $(this).attr('href');

                // Realiza la solicitud POST a la otra ruta
                $.ajax({
                    url: '/recommendation/create',
                    type: 'POST',
                    data: {
                        idPerson: '<?php echo e($item->idPerson); ?>',
                        idCategory: '<?php echo e($item->idCategory); ?>'
                    },
                    success: function(response) {
                        // Maneja la respuesta de la solicitud POST según sea necesario
                        console.log('Solicitud POST exitosa:', response);
                    },
                    error: function(xhr, status, error) {
                        // Maneja los errores de la solicitud POST según sea necesario
                        console.error('Error en la solicitud POST:', status, error);
                    }
                });

                // Redirige a la URL original del enlace
                window.location.href = url;
            });
        });
    </script>
</div>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('body.master_body', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\ProyectoInformatica\Backend\resources\views/body/components/bookings.blade.php ENDPATH**/ ?>