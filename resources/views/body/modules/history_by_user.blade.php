<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Reservas por Usuario</title>
    <!-- Agrega la hoja de estilo de Bootstrap -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0-alpha1/css/bootstrap.min.css">
    <!-- Agrega la hoja de estilo de Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="d-flex align-items-center justify-content-center ">

    @if(count($users) > 0)
    <div class="card">
        <div class="card-body">
            @foreach($users as $user)
            <div class="row g-2 mb-2">
                <div class="col-md-4">
                    @if (!empty($user->image))
                    <img class="img-fluid rounded" src="{{ asset('upload/booking_images/' . $user->image) }}"
                        alt="sin imagen">
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
                    <p class="card-text mb-1"><strong>Con un precio de:</strong>{{$user->price}}</p>
                    <p class="card-text mb-1"><strong>Publicado por: </strong>{{$user->name}} {{$user->firstLastName}} {{$user->secondLastName}}</p>
                    <p class="card-text mb-1"><strong>Su día de llegada fue el: </strong>{{$user->arrival_date}}</p>
                    <p class="card-text mb-1"><strong>Y finalizó el: </strong>{{$user->final_date}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <p class="text-center">No hay registros disponibles para este usuario.</p>
    @endif

    <!-- Agrega los scripts de Bootstrap y Font Awesome al final del body -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <!-- Bootstrap JS -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js"></script>

</body>

</html>
