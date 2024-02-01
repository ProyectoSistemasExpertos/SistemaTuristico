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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


<div class="content-wrapper">
    <!-- Main content -->
    <section class="content" style="background-color: #F1E9E7;">
        @if(session('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
        @endif

        @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
        @endif



        @php
        $categoryIcons = [
        1 => ['icon' => 'fa-mountain'],
        2 => ['icon' => 'fa-umbrella-beach'],
        3 => ['icon' => 'fa-city'],
        ];

        $categoryColors = [
        1 => '#BEF87D', // Color para la categoría 1
        2 => '#EEF6B0', // Color para la categoría 2
        3 => '#DAF1EB', // Color para la categoría 3
        ];
        @endphp

        @foreach($bookings as $item)
        <div class="card mb-2" style="background-color: {{ isset($recommendation_flag) && $recommendation_flag ? $categoryColors[$item->idCategory] : ''}}">
            <div class="card-body">

                <div class="row g-2 mb-2">
                    <div class="col-md-4">
                        @if (!empty($item->image))
                        <img class="img-fluid rounded" src="{{$item->image }}" alt="Imagen de la reserva" style="max-width: 100%; height: auto;">
                        @else
                        <img class="img-fluid rounded" src="{{ asset('upload/sinFoto.jpg') }}" alt="Sin imagen" style="max-width: 100%; height: auto;">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <h3 class="card-title ">
                            <i class="fa-solid {{ $categoryIcons[$item->idCategory]['icon'] }}"></i>
                            <strong>{{ $item->title }}</strong>
                        </h3>
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
                            <a href="{{ route('booking.index', $item->idBooking) }}" class="btn btn-primary ver-mas ml-auto" data-id="{{ $item->idBooking }}" id="ver-mas-link-{{ $item->idBooking }}"><strong>Ver más</strong></a>
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
