@extends('body.master_body')
@section('body')

    <!-- Enlace a los estilos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">

    <style>
        .container {
            margin-top: 50px;
        }

        .profile-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
            /* Cambia el color del botón a verde musgo (success) */
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .edit-button:hover {
            /* Cambia el color del botón a un tono más oscuro al pasar el ratón */
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

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h5>Perfil de Usuario.</h5>
                <div class="profile-container p-4" style="background-color: rgba(255, 255, 255, 0.8); font-family: 'Playfair Display', serif;">

                    <div class="row align-items-center">
                        <!-- Imagen del perfil -->
                        <div class="col-md-3">
                            @foreach ($imageUrls as $index => $imageUrl)
                            <img  class="img-fluid rounded" src="{{ $imageUrl }}" alt="Imagen {{ $index + 1 }}" style="max-width: 100%; height: auto;">
                           @endforeach
                        </div>
                        <!-- Información del usuario y botón de edición -->
                        <div class="col-md-9 user-info">
                            <div class = "mb-2">
                                <p>Nombre completo:
                                <h5>{{$user->name}} {{$user->firstLastName}} {{$user->secondLastName}}</h5>
                            </div>
                            </p>
                            <div class = "mb-2">
                                <p>Cédula: {{$user->idCard}}</p>
                            </div>
                            <div class = "mb-2">
                                <p>Correo electrónico: {{$user->email}}</p>
                            </div>
                            <div class = "mb-2">
                                <p>Teléfono: {{$user->phone}}</p>
                            </div>
                            <div class = "mb-2">
                                <p>Dirección: {{$user->address}}</p>
                            </div>
                            <div class = "mb-2">
                                @foreach($category as $categories)
                                <p>Preferencias: {{$categories->typeCategory}}</p>
                                @endforeach
                            </div>
                            <!-- Botón de edición -->
                            <button type="button" class="btn btn-success mt-3" data-toggle="modal" data-target="#myModal">Editar Perfil</button>
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