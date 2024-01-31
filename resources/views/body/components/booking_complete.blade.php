@extends('body.master_body')
@section('body')


<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-6 mb-4">
                    <h1 class="m-0">BODY -> QUITARLO</h1>

                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        @php
        $categoryIcons = [
        1 => ['icon' => 'fa-mountain'],
        2 => ['icon' => 'fa-umbrella-beach'],
        3 => ['icon' => 'fa-city'],
        ];
        @endphp

        @foreach($bookings as $item)

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('booking.index') }}" class="btn btn-primary mb-2">Volver</a>
                            @if (!empty($item->image))
                            <img class="img-fluid rounded" src="{{ asset('upload/booking_images/' . $item->image) }}"
                                alt="Imagen de la reserva">
                            @else
                            <img class="img-fluid rounded" src="{{ asset('upload/sinFoto.jpg') }}" alt="Sin imagen">
                            @endif

                            <div class="row">
                                <div class="col-md-7"> <!-- Aquí colocamos el resto de los datos a la izquierda -->
                                    <h5 class="card-title">
                                        <i class="fa-solid {{ $categoryIcons[$item->idCategory]['icon'] }}"></i>
                                        {{ $item->title }}
                                    </h5>
                                </div>
                                <div class="col-md-5 text-right"> <!-- Aquí colocamos el score a la derecha -->
                                    <h5 class="card-title text-right">
                                        {{ $valoration[$item->idBooking] }} <i class="fa-regular fa-star"></i>
                                    </h5>
                                </div>
                            </div>
                            <p class="card-text">{{ $item->description }}</p>
                            <p class="card-text"><strong>Ubicación:</strong> {{ $item->location }}</p>
                            <p class="card-text"><strong>Precio por noche:</strong> ₡{{ $item->price }}</p>
                            <p class="card-text"><strong>Total de habitaciones disponibles:</strong> {{
                                $item->totalPossibleReservation }}</p>
                            <p class="card-text"><strong>Tipo de propiedad:</strong> {{ $item->typeCategory }}</p>
                            <p class="card-text"><strong>Subido por:</strong> {{ $item->name }} {{ $item->firstLastName
                                }} {{ $item->secondLastName }}</p>
                            <p class="card-text"><strong>Telefono:</strong> {{ $item->phone }}</p>
                            <p class="card-text"><strong>Correo:</strong> {{ $item->email }}</p>

                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#reservarModal">
                            Reservar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach


        <!-- Modal -->
        <!-- Ventana modal para la reserva -->
        <div class="modal fade" id="reservarModal" tabindex="-1" aria-labelledby="reservarModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reservarModalLabel">¿Deseas reservar?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <input type="text" class="form-control" id="idPerson" name="idPerson" value="">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="idBooking" name="idBooking" value="">
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
            url: '{{ route("housing.store") }}',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                // Manejar la respuesta aquí (puede redirigir o mostrar un mensaje)
                console.log(response);
            },
            error: function (error) {
                // Manejar el error aquí (puede mostrar un mensaje de error)
                console.log(error.responseJSON);
            }
        });
    }
</script>
@endsection