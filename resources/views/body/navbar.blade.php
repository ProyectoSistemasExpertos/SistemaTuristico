<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navbar</title>
    <!-- Agrega la hoja de estilo de Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Agrega la hoja de estilo de Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <style>
        .navbar-nav .nav-link {
            color: white;
            /* Cambia el color del texto a blanco */
        }
    </style>
 @php
    $imageUrls = [
   "https://cdn.pixabay.com/photo/2016/06/09/18/36/logo-1446293_960_720.png"
    ];
    @endphp

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="{{ route('booking.index') }}">
            @foreach ($imageUrls as $index => $imageUrl)
        <img src="{{ $imageUrl }}" alt="Imagen {{ $index}}" style="max-width: 10%; height: auto;">
            Tuplas
              @endforeach
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('history_by_user',auth()->user()->id ) }}">Historial de Reservaciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('view-profile') }}">Perfil de Usuario</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('logout')}}">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>


</body>

</html>