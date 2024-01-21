<div>
    
    <form method="POST" action="{{route('register')}}">

        @csrf
        <input type="text" class="form-control" id="name" name="name" placeholder="nombre">
        <input type="text" class="form-control" id="firstLastName" name="firstLastName" placeholder="apellido1">
        <input type="text" class="form-control" id="secondLastName" name="secondLastName" placeholder="apellido2">
        <input type="text" class="form-control" id="idCard" name="idCard" placeholder="cedula">
        <input type="text" class="form-control" id="phone" name="phone" placeholder="celular">
        <input type="text" class="form-control" id="Address" name="Address" placeholder="direccion">

        <input type="email" class="form-control" id="email" name="email" placeholder="correo">
        <input type="password" class="form-control" id="password" name="password" placeholder="contraseña">

        <button type="submit">register</button>
    </form>
</div>
