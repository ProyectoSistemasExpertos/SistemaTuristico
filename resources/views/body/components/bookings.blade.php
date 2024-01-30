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

        @php
        $categoryIcons = [
        1 => ['icon' => 'fa-mountain'],
        2 => ['icon' => 'fa-umbrella-beach'],
        3 => ['icon' => 'fa-city'],
        ];
        @endphp

        @if(session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
@endif

        @foreach($bookings as $item)

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">

                            @if (!empty($item->image))
                            <img class="img-fluid rounded" src="{{ asset('upload/booking_images/' . $item->image) }}" alt="Imagen de la reserva">
                            @else
                            <img class="img-fluid rounded" src="{{ asset('upload/sinFoto.jpg') }}" alt="Sin imagen">
                            @endif

                            
                                
                                    <!-- Aquí colocamos el resto de los datos a la izquierda -->
                                    <h5 class="card-title">
                                        <i class="fa-solid {{ $categoryIcons[$item->idCategory]['icon'] }}"></i>
                                        {{ $item->title }}
                                    </h5>
                                
                              
                            <p class="card-text"><strong>Puntuación:</strong> {{ $valoration[$item->idBooking] }}<i class="fa-regular fa-star"></i></p>
                            <p class="card-text"><strong>Ubicación:</strong> {{ $item->location }}</p>
                            <p class="card-text"><strong>Precio por noche:</strong> ₡{{ $item->price }}</p>
                            <p class="card-text"><strong>Máximo de personas:</strong> {{ $item->totalPossibleReservation }}</p>
                            <p class="card-text"><strong>Tipo de sector:</strong> {{ $item->typeCategory }}</p>
                            <div class="action-container d-flex justify-content-between">
                                <a href="{{ route('booking.index', $item->idBooking) }}" class="btn btn-primary ver-mas ml-auto" data-id="{{ $item->idBooking }}" id="ver-mas-link-{{ $item->idBooking }}">Ver más</a>
                            </div>

                        </div>
                        <!-- Agregar un contenedor div con la clase .action-container para el enlace Ver más -->

                    </div>
                </div>
            </div>

        </div>

        @endforeach

    </section>
    <script>
        $(document).ready(function() {
            $('#ver-mas-link-{{ $item->idBooking }}').click(function(event) {
                event.preventDefault(); // Evita la acción predeterminada del enlace (navegación)

                // Obtiene la URL del enlace
                var url = $(this).attr('href');

                // Realiza la solicitud POST a la otra ruta
                $.ajax({
                    url: '/recommendation/create',
                    type: 'POST',
                    data: {
                        idPerson: '{{ $item->idPerson }}',
                        idCategory: '{{ $item->idCategory }}'
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



@endsection