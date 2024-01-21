<div>
    
    <form method="POST" action="{{route('login')}}">

        @csrf
        <input type="email" class="form-control" id="email" name="email" placeholder="correo">
        <input type="password" class="form-control" id="password" name="password" placeholder="contraseña">

        <button type="submit">ingresar</button>
    </form>
</div>