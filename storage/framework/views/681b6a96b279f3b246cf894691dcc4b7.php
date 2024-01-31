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

        <?php
        $categoryIcons = [
        1 => ['icon' => 'fa-mountain'],
        2 => ['icon' => 'fa-umbrella-beach'],
        3 => ['icon' => 'fa-city'],
        ];
        ?>


        <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card mb-2">
            <div class="card-body ">
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
                        <a class="btn btn-primary mb-2 ml-auto" data-bs-toggle="modal" data-bs-target="#reservarModal">
                            Reservar
                        </a>
                     </div>
                        
                    </div>
                </div>
              
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        <!-- Modal -->
        <!-- Ventana modal para la reserva -->
        <div class="modal fade" id="reservarModal" tabindex="-1" aria-labelledby="reservarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reservarModalLabel">¿Deseas reservar?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Contenido del formulario de reserva -->
                        <form id="reservarForm" method="post" action="<?php echo e(route('housing.store')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <label for="initial_date" class="form-label">Fecha de Inicio</label>
                                <input type="date" class="form-control" id="initial_date" name="initial_date">
                            </div>
                            <div class="mb-3">
                                <label for="final_date" class="form-label">Fecha de Fin</label>
                                <input type="date" class="form-control" id="final_date" name="final_date">
                            </div>
                            <div class="mb-3">
                                <label for="arrival_date" class="form-label">Fecha de Llegada</label>
                                <input type="date" class="form-control" id="arrival_date" name="arrival_date">
                            </div>
                            <div class="mb-3">
                                <label for="total_person" class="form-label">Total de Personas</label>
                                <input type="number" class="form-control" id="total_person" name="total_person">
                            </div>
                            <div class="mb-3">
                                <input type="hidden" class="form-control" id="idPerson" name="idPerson" value="<?php echo e(auth()->user()->id); ?>">
                            </div>
                            <div class="mb-3">
                                <input type="hidden" class="form-control" id="idBooking" name="idBooking" value="<?php echo e($item->idBooking); ?>">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="confirmarReserva()">Confirmar
                            Reserva</button>

                    </div>
                </div>
            </div>
            <!-- Fin de la ventana modal para la reserva -->



    </section>
</div>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<script>
    function confirmarReserva() {
        // Capturar datos del formulario
        var formData = new FormData(document.getElementById('reservarForm'));

        // Realizar petición AJAX
        $.ajax({
            type: 'POST',
            url: '<?php echo e(route("housing.store")); ?>',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Manejar la respuesta aquí (puede redirigir o mostrar un mensaje)
                console.log(response);
                $('#reservarForm')[0].reset();
                    // Cerrar el modal
                    $('#reservarModal').modal('hide');
            },
            error: function(error) {
                // Manejar el error aquí (puede mostrar un mensaje de error)
                console.log(error.responseJSON);
            }
        });
        
    }
    $('#reservarModal').on('hidden.bs.modal', function () {
            $('#reservarForm')[0].reset();
        });
    
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('body.master_body', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\ProyectoInformatica\Backend\resources\views/body/components/booking_complete.blade.php ENDPATH**/ ?>