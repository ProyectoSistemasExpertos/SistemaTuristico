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

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Tuplas</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Historial de Preferencias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Historial de Reservaciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Perfil de Usuario</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Agrega el modal -->
    <div class="modal fade" id="nuevoDestinoModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Creación de Nuevo Destino</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Contenido del formulario o cualquier otro contenido para la creación de destino -->
                    <!-- Puedes agregar un formulario aquí -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <!-- Puedes agregar un botón de guardar en el formulario si es necesario -->
                </div>
            </div>
        </div>
    </div>

    <!-- Mueve el script al final del documento -->
    <script>
        function openModal() {
            var myModal = new bootstrap.Modal(document.getElementById('nuevoDestinoModal'));
            myModal.show();
        }
    </script>

    <!-- Agrega la librería de Bootstrap 5 JS al final del documento -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</body>

</html>
