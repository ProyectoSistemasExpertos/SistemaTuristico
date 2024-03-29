<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario - Turismo</title>
    <!-- Enlace a los estilos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">

</head>

<body class="bg-info">

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizar datos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Contenido del formulario -->
                    <form id="form" action="{{ route('update') }}" method="post">
                        @csrf
                        @method('post')
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese su nombre" value="{{$user->name}}" required>
                        </div>
                        <div class="form-group">
                            <label for="firstLastName">Primer apellido:</label>
                            <input type="text" class="form-control" id="firstLastName" name="firstLastName" placeholder="Ingrese su primer apellido" value="{{$user->firstLastName}}" required>
                        </div>
                        <div class="form-group">
                            <label for="secondLastName">Segundo apellido:</label>
                            <input type="text" class="form-control" id="secondLastName" name="secondLastName" placeholder="Ingrese su segundo apellido" value="{{$user->secondLastName}}" required>
                        </div>
                        <div class="form-group">
                            <label for="idCard">Cédula:</label>
                            <input type="text" class="form-control" id="idCard" name="idCard" placeholder="Ingrese su cédula" value="{{$user->idCard}}" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Teléfono:</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Ingrese su teléfono" value="{{$user->phone}}" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Dirección:</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Ingrese su dirección" value="{{$user->address}}" required>
                        </div>
                        <div class="form-group">
                            <label for="idCategory">Categoría Preferida:</label>
                            <select class="form-control" id="idCategory" name="idCategory">
                                <option value="1" @if($user->preferences->contains('idCategory', 1)) selected @endif>Montaña</option>
                                <option value="2" @if($user->preferences->contains('idCategory', 2)) selected @endif>Playa</option>
                                <option value="3" @if($user->preferences->contains('idCategory', 3)) selected @endif>Ciudad</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Scripts de Bootstrap y Popper.js (necesario para algunas funcionalidades de Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>