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
            color: #000 !important;
            /* Cambia el color al mismo que en el navbar */
        }

        /* Añade un estilo para el fondo del offcanvas */
        .offcanvas.offcanvas-start {
            background-color: #f8f9fa;
            /* Color similar al bg-light del navbar */
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

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="sidebarLabel">¿Filtrar por?</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="nav flex-column">
                    <li class="nav-item">
                            <a class="nav-link" href="{{ route('booking.filter_by_category', '1') }}" >
                                Montaña
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('booking.filter_by_category', '2') }}">
                                Playa
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="{{ route('booking.filter_by_category', '3') }}" data-value="3">
                                Ciudad
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
