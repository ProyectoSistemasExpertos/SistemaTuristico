@extends('body.master_body')
@section('body')


<meta name="csrf-token" content="{{ csrf_token() }}">

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
        @if(session('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
        @endif

      

        @php
        $categoryIcons = [
        1 => ['icon' => 'fa-mountain'],
        2 => ['icon' => 'fa-umbrella-beach'],
        3 => ['icon' => 'fa-city'],
        ];
        @endphp

        @foreach($bookings as $item)

        <div class="card mb-2">
            <div class="card-body">

                <div class="row g-2 mb-2">
                    <div class="col-md-4">
                        @if (!empty($item->image))
                        <img class="img-fluid rounded" src="{{ asset('upload/booking_images/' . $item->image) }}" alt="Imagen de la reserva">
                        @else
                        <img class="img-fluid rounded" src="{{ asset('upload/sinFoto.jpg') }}" alt="Sin imagen">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <h3 class="card-title">
                            <i class="fa-solid {{ $categoryIcons[$item->idCategory]['icon'] }}"></i>
                            {{ $item->title }}
                        </h3>
                        <h5 class="card-subtitle mb-2 text-muted">{{ $item->typeCategory }}</h5>
                        <p class="card-text mb-1"><strong>Ubicado en:</strong> {{ $item->location }}</p>
                        <p class="card-text mb-1"><strong>Máximo de personas:</strong> {{ $item->totalPossibleReservation }}</p>
                        <p class="card-text mb-1"><strong>Precio por noche:</strong> ₡{{ $item->price }}</p>
                        <!-- Asegúrate de tener las variables disponibles: $categoryIcons y $item->idCategory -->
                        <p class="card-text"><strong>Puntuación:</strong> {{ $valoration[$item->idBooking] }} <i class="fa-regular fa-star"></i></p>
                        <div class="action-container d-flex justify-content-between">
                            <a href="{{ route('booking.index', $item->idBooking) }}" class="btn btn-primary ver-mas ml-auto" data-id="{{ $item->idBooking }}" id="ver-mas-link-{{ $item->idBooking }}">Ver más</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        @endforeach

    </section>

</div>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>



@endsection