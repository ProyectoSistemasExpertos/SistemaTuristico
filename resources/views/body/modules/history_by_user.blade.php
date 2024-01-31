@extends('body.master_body')
@section('body')

<body class="d-flex align-items-center justify-content-center ">

    @if(count($users) > 0)
    @foreach($users as $user)
    <div class="card mb-2">
        <div class="card-body ">
            <div class="row g-2 mb-2">
                <div class="col-md-4">
                    @if (!empty($user->image))
                    <img class="img-fluid rounded" src="{{ asset('upload/booking_images/' . $user->image) }}" alt="sin imagen">
                    @else
                    <img class="img-fluid rounded" src="{{ asset('upload/sinFoto.jpg') }}" alt="Sin imagen">
                    @endif
                </div>
                <div class="col-md-8">
                    <h3 class="card-title">{{$user->title}}</h3>
                    <h5 class="card-subtitle mb-2 text-muted">{{$user->typeCategory}}</h5>
                    <p class="card-text mb-1"><strong>Descripción del Lugar:</strong>{{$user->description}}</p>
                    <p class="card-text mb-1"><Strong>Ubicado en: </Strong>{{$user->location}}</p>
                    <p class="card-text mb-1"><strong>Reservado para un total de personas:
                        </strong>{{$user->totalPossibleReservation}}</p>
                    <p class="card-text mb-1"><strong>Precio :</strong>₡ {{$user->price}}</p>
                    <p class="card-text mb-1"><strong>Publicado por: </strong>{{$user->name}} {{$user->firstLastName}} {{$user->secondLastName}}</p>
                    <p class="card-text mb-1"><strong>Su día de llegada fue el: </strong>{{$user->arrival_date}}</p>
                    <p class="card-text mb-1"><strong>Y finalizó el: </strong>{{$user->final_date}}</p>

                    <div class="action-container d-flex justify-content-between">
                        <a class="btn btn-primary mb-2 ml-auto" data-bs-toggle="modal" data-bs-target="#valorationModal">
                            Valorar
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
     <!-- Modal -->
     <div class="modal fade" id="valorationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Deseas valorar la publicación?</h5>
                </div>
                <div class="modal-body">
                    <!-- Contenido del formulario -->
                    <form id="form" action="{{ route('valoration.create') }}" method="post">
                        @csrf
                        @method('post')
                        <div class="form-group mb-2">
                            <label class = "mb-2" for="name">Seleccione una valoración</label>
                            <input type="hidden" class="form-control" id="commentary" name="commentary" placeholder="" value="Bueno">
                            <input type="hidden" class="form-control" id="idPeron" name="idPerson" placeholder="" value="">
                            <input type="hidden" class="form-control" id="idBooking" name="idBooking" placeholder="" value="{{ $user->idBooking}}">
                            <select class="form-control" id="socre" name="score">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @else
    <p class="text-center">No hay registros disponibles para este usuario.</p>
    @endif



   
    <!-- Agrega los scripts de Bootstrap y Font Awesome al final del body -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js"></script>



</body>


@endsection