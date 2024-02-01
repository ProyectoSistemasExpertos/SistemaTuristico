<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!-- Bootstrap CSS (Puedes instalar Bootstrap mediante npm o usar un CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilo personalizado para las etiquetas en el offcanvas */
        .offcanvas-body .nav-link {
            color: white !important; /* Cambia el color al blanco */
        }

        /* Añade un estilo para el fondo del offcanvas */
        .offcanvas.offcanvas-start {
            background-color: #3498db; /* Cambia el color de fondo al mismo que en el navbar */
        }

        /* Añade estilo para el hover de los enlaces */
        .offcanvas-body .nav-link:hover {
            background-color: #2980b9; /* Cambia el color de fondo al mismo que en el navbar cuando hover */
        }

        /* Establece un ancho máximo para el contenedor del navbar */
        .offcanvas.offcanvas-start {
            max-width: 300px; /* Puedes ajustar este valor según tus preferencias */
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar"
            aria-controls="sidebar">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div class="container-fluid mx-auto">
        <div class="row">
            <!-- Sidebar -->
            <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="sidebarLabel"><strong> ¿Filtrar por?</strong></h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('booking.filter_by_category', '1') }}">
                               <strong> Montaña</strong>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('booking.filter_by_category', '2') }}">
                               <strong> Playa</strong>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('booking.filter_by_category', '3') }}" data-value="3">
                               <strong> Ciudad</strong>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Puedes instalar Bootstrap mediante npm o usar un CDN) y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
