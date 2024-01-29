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
                            Crear Categoria
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

        @foreach($booking as $item)


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

                            <h5 class="card-title"><i class="fa-solid {{ $categoryIcons[$item->idCategory]['icon'] }}"></i>{{ $item->title }}</h5>
                            <p class="card-text">{{ $item->description }}</p>
                            <p class="card-text"><strong>Ubicación:</strong> {{ $item->location }}</p>
                            <p class="card-text"><strong>Precio por noche:</strong> ₡{{ $item->price }}</p>
                            <p class="card-text"><strong>Total de habitaciones disponibles:</strong> {{ $item->totalPossibleReservation }}</p>
                            <p class="card-text"><strong>Tipo de propiedad:</strong> {{ $item->typeCategory }}</p>
                            <p class="card-text"><strong>Subido por:</strong> {{ $item->name }} {{ $item->firstLastName }} {{ $item->secondLastName }}</p>
                            <p class="card-text"><strong>Telefono:</strong> {{ $item->phone }}</p>
                            <p class="card-text"><strong>Correo:</strong> {{ $item->email }}</p>
                        </div>
                        <a href="" class="btn btn-primary">Reservar</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach


        <!--=====================================
    MODAL NUEVA CATEGORIA
======================================-->

        <div id="modalCreateBooking" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="{{ route('booking.create') }}">
                        @csrf
                        <!--=====================================
                    CABEZA DEL MODAL
                ======================================-->
                        <div class="modal-header" style="background:blue; color:white;">
                            <h4 class="modal-title">
                                <span class="fas fa-layer-group"></span> Agregar Categoría
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="color:white;">&times;</span>
                            </button>
                        </div>
                        <!--=====================================
                    CUERPO DEL MODAL
                ======================================-->
                        <div class="modal-body">
                            <div class="box-body">
                                <!-- ENTRADA PARA EL NOMBRE -->
                                <div class="form-group">
                                    
                                    <input type="hidden" id="idPerson" name="idPerson" value="1">
                                    <input type="hidden" id="state" name="state" value="1">
                                    <label for="inputName" class="control-label">Nombre Categoría</label>
                                    <input name="title" id="title" class="form-control" type="text" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="lblDescription" class="control-label">Descripción</label>
                                    <input name="description" id="description" class="form-control" type="text" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="lblPrice" class="control-label">Precio</label>
                                    <input name="price" id="price" class="form-control" type="number" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="lblLocation" class="control-label">Ubicación</label>
                                    <select class="form-select input-lg" name="location" id="location" required>
                                            
                                            <option value="San José">San José</option>
                                            <option value="Alajuela">Alajuela</option>
                                            <option value="Heredia">Heredia</option>
                                            <option value="Cartago">Cartago</option>
                                            <option value="Guanacaste">Guanacaste</option>
                                            <option value="Puntarenas">Puntarenas</option>
                                            <option value="Limón">Limón</option>
                                            
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label for="lblTotalPossibleReservation" class="control-label">Reserva Total Posible</label>
                                    <input name="totalPossibleReservation" id="totalPossibleReservation" class="form-control" type="number" value="" required>
                                </div>
                                <!-- ENTRADA PARA SELECCIONAR UNA IMAGEN -->
                                <div class="form-group">
                                    <label for="image" class="control-label">Subir Imagen</label>
                                    <input type="file" id="image" name="image" class="form-control-file" accept="image/*">
                                </div>
                                <div class="form-group">
                                    <label for="inputEstado" class="control-label">Categoría</label>
                                    <div>
                                        <select class="form-select input-lg" name="idCategory" id="idCategory" required>
                                            <option value="">Seleccionar categoría</option>
                                            @foreach($category as $c)
                                            <option value="{{$c->idCategory}}">{{$c->typeCategory}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--=====================================
                    PIE DEL MODAL
                ======================================-->
                        <!-- Modal footer -->
                        <div class="modal-footer d-flex justify-content-between">
                            <div>
                                <!--<button type="submit" class="btn btn-primary">Guardar Datos</button> -->
                                <input type="submit" class="btn btn-primary waves-effect waves-light" value="Guardar Datos">
                                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- FIN VENTANA MODAL CREAR CATEGORIA -->

    </section>
</div>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>

@endsection