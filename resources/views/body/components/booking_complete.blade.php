@extends('body.master_body')
@section('body')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .star-rating {
        color: #FFD700;
        /* Color amarillo dorado para las estrellas */
    }

    .star-rating .fa-regular.fa-star {
        color: #CCCCCC;
        /* Color gris para las estrellas no seleccionadas */
    }
</style>
<!-- Agrega el CSS de Toastr -->
<!-- Bootstrap CSS y Popper.js -->
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<div class="content-wrapper">
    <section class="content">

        @php
        $categoryIcons = [
        1 => ['icon' => 'fa-mountain'],
        2 => ['icon' => 'fa-umbrella-beach'],
        3 => ['icon' => 'fa-city'],
        ];
        @endphp


        @foreach($bookings as $item)
        <div class="card mb-2">
            <div class="card-body ">
                <div class="row g-2 mb-2">
                    <div class="col-md-4">

                        @if (!empty($item->image))
                        <img class="img-fluid rounded" src="{{$item->image }}" alt="Imagen de la reserva" style="max-width: 100%; height: auto;">
                        @else
                        <img class="img-fluid rounded" src="{{ asset('upload/sinFoto.jpg') }}" alt="Sin imagen" style="max-width: 100%; height: auto;">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <h3 class="card-title">
                            <i class="fa-solid {{ $categoryIcons[$item->idCategory]['icon'] }}"></i>
                            {{ $item->title }}
                        </h3>
                        <h5 class="card-text mb-1 text-muted">
                            <strong>
                                <i class="fas fa-info-circle"></i>
                                Descripción:
                            </strong>
                            {{ $item->description }}
                        </h5>
                        <h5 class="card-subtitle mb-1 text-muted">
                            @if($item->typeCategory == 'Montaña')
                            <i class="material-icons">terrain</i>
                            @elseif($item->typeCategory == 'Playa')
                            <i class="material-icons">beach_access</i>
                            @elseif($item->typeCategory == 'Ciudad')
                            <i class="material-icons">location_city</i>
                            @else
                            <i class="material-icons">category</i>
                            @endif
                            {{ $item->typeCategory }}
                        </h5>
                        <h5 class="card-subtitle mb-1 text-muted">
                            <i class="material-icons">place</i>
                            {{ $item->location }}
                        </h5>
                        <h5 class="card-subtitle mb-1 text-muted">
                            <i class="material-icons">group</i>
                            Máximo de personas: {{ $item->totalPossibleReservation }}
                        </h5>

                        <h5 class="card-subtitle mb-1 text-muted">
                            <i class="material-icons">attach_money</i>
                            Precio por persona: ₡{{ $item->price }}
                        </h5>

                        <div class="action-container d-flex justify-content-between">
                            <h5 class="card-text">
                                &nbsp;&nbsp;&nbsp;
                                <span class="star-rating">
                                    @for ($i = 1; $i <= 5; $i++) @if ($i <=$valoration[$item->idBooking])
                                        <i class="fa-solid fa-star"></i>
                                        @else
                                        <i class="fa-regular fa-star"></i>
                                        @endif
                                        @endfor
                                </span>
                            </h5>
                            <a class="btn btn-primary text-white mb-2 ml-auto" data-bs-toggle="modal" data-bs-target="#reservarModal">
                                <strong>Reservar</strong>
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        @endforeach


        <!-- Modal -->
        <!-- Ventana modal para la reserva -->
        <div class="modal fade" id="reservarModal" tabindex="-1" aria-labelledby="reservarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reservarModalLabel">¿Deseas reservar?</h5>
                        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Contenido del formulario de reserva -->
                        <form id="reservarForm" method="post" action="{{ route('housing.store') }}">
                            @csrf
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
                                <input type="hidden" class="form-control" id="idPerson" name="idPerson" value="{{ auth()->user()->id }}">
                            </div>
                            <div class="mb-3">
                                <input type="hidden" class="form-control" id="idBooking" name="idBooking" value="{{$item->idBooking}}">
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


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap JS -->
<script>
    function cerrarModal() {
        //APLICA LO MISMO QUE data-bs-dismiss="modal" pero en esta funcion
        $('#reservarModal').modal('hide');

    }

    function confirmarReserva() {
        // Capturar datos del formulario
        var formData = new FormData(document.getElementById('reservarForm'));
        // Realizar petición AJAX
        $.ajax({
            type: 'POST',
            url: '{{ route("housing.store") }}',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Manejar la respuesta aquí (puede redirigir o mostrar un mensaje)
                $('#reservarForm')[0].reset();
                // Cerrar el modal
                $('#reservarModal').modal('hide');
            },
            error: function(error) {
                // Manejar el error aquí (puede mostrar un mensaje de error)
                console.log(error);
            }
        });
        cerrarModal();
    }
    $('#reservarModal').on('hidden.bs.modal', function() {
        $('#reservarForm')[0].reset();
    });
</script>
@endsection
