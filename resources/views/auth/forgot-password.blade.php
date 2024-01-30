@extends('home')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <div class="row justify-content-center">
        <div class="col-md-35">
            <div class="card-body">
            <form method="POST" action="{{ route('send-password-reset-link') }}">
                @csrf
                <div class="mb-7">
                    <h3 class="font-semibold text-2xl text-gray-800">¿Olvidaste tu Contraseña?</h3>
                    <p class="text-gray-400">
                        Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.
                    </p>
                </div>
                <div class="space-y-6">
                    <div>
                        <input
                            id="email"
                            name="email"
                            placeholder="Correo"
                            class="w-full text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:border-purple-400"
                            type="email"
                            required autofocus
                           
                        />
                    </div>
                    <div>
                        <button
                            type="submit"
                            class="w-full flex justify-center bg-purple-800 hover:bg-purple-700 text-gray-100 p-3 h-30 rounded-lg tracking-wide font-semibold cursor-pointer transition ease-in duration-500"
                            
                        >
                            Enviar Enlace de Restablecimiento
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

@endsection