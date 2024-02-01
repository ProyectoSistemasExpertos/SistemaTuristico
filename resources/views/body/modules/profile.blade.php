@extends('body.master_body')
@section('body')

<!-- Enlace a los estilos de Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">

<!-- Enlace a los estilos de FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
    .container {
        margin-top: 50px;
    }

    .profile-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        font-family: 'Montserrat', sans-serif;
    }

    .profile-image {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        margin-right: 20px;
    }

    .user-info {
        max-width: 400px;
    }

    .edit-button {
        background-color: #28a745;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .edit-button:hover {
        background-color: #218838;
    }

    h5 {
        font-weight: bold;
        color: #333;
    }

    p {
        color: #555;
        margin-bottom: 0.5rem;
    }

    .mb-2 {
        margin-bottom: 1rem;
    }

    .btn-success {
        background-color: #28a745;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-success:hover {
        background-color: #218838;
    }
</style>

@php
$imageUrls = [
"https://img.freepik.com/vector-gratis/marco-facebook-cambio-climatico-plano-organico_23-2148928533.jpg?w=740&t=st=1706749055~exp=1706749655~hmac=2679e15d26d50284574ab5786b94091c49a8a6563bb3fd1cc2717ace578a3b92"
];
@endphp
</head>

<body class="bg-info">
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="profile-container p-4" style="background-color: rgba(255, 255, 255, 0.8);">
                    <h5 class="mb-4"><strong> Perfil de Usuario</strong></h5>
                    <div class="row align-items-center">
                        <!-- Imagen del perfil -->
                        <div class="col-md-3">
                            @foreach ($imageUrls as $index => $imageUrl)
                            <img class="img-fluid rounded profile-image" src="{{ $imageUrl }}" alt="Imagen {{ $index + 1 }}">
                            @endforeach
                        </div>
                        <!-- Información del usuario y botón de edición -->
                        <div class="col-md-9 user-info">
                            <div class="mb-2">
                                <p class="mb-1">
                                <h5><i class="fas fa-user"></i>&nbsp;&nbsp; <strong>{{$user->name}} {{$user->firstLastName}} {{$user->secondLastName}}</h5></strong></p>

                            </div>
                            <div class="mb-2">
                                <p><i class="fas fa-id-card"></i><strong> Cédula:</strong> {{$user->idCard}}</p>
                            </div>
                            <div class="mb-2">
                                <p><i class="fas fa-envelope"></i><strong> Correo electrónico:</strong> {{$user->email}}</p>
                            </div>
                            <div class="mb-2">
                                <p><i class="fas fa-phone"></i><strong> Teléfono:</strong> {{$user->phone}}</p>
                            </div>
                            <div class="mb-2">
                                <p><i class="fas fa-map-marker-alt"></i><strong> Dirección:</strong> {{$user->address}}</p>
                            </div>
                            <div class="mb-2">
                                @foreach($category as $categories)
                                <p><i class="fas fa-heart"></i><strong> Preferencias:</strong> {{$categories->typeCategory}}</p>
                                @endforeach
                            </div>
                            <!-- Botón de edición -->
                            <button type="button" class="btn btn-success mt-3" data-toggle="modal" data-target="#myModal">
                                <strong>Editar Perfil</strong>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Incluir el modal desde otro archivo -->
    @include('body.modules.update-profile')

    <!-- Scripts de Bootstrap y Popper.js (necesario para algunas funcionalidades de Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

@endsection
