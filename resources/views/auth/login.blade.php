@extends('home')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <div class="row justify-content-center">
            <div class="col-md-35">
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-7">
                            <h1 class="text-gray-800 font-bold text-xl">Iniciar sesión</h1>
                                <p class="text-gray-400">
                                    ¿No tienes una cuenta?
                                    <a href="register" class="text-sm text-purple-700 hover:text-purple-700">
                                        <strong> Regístrate</strong> 
                                    </a>
                                </p>
                            </div>
                            <div class="space-y-6">
                                <div>
                                    <input
                                        id="email"
                                        name="email"
                                        placeholder="Correo electrónico"
                                        class="w-full text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:border-purple-400"
                                        type="text"
                                        value=""
                                        required autofocus
                                    />
                                </div>
                                <div class="relative" x-data="{ show: false }">
                                    <input
                                        id="password"
                                        name="password"
                                        placeholder="Contraseña"
                                        x-bind:type="show ? 'text' : 'password'"
                                        class="w-full text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:border-purple-400"
                                        value=""
                                        required
                                    />
                                    <div class="flex items-center absolute inset-y-0 right-0 mr-3 text-sm leading-5">
                                        
                                        <button @click="show = !show" type="button">
                                            <svg class="h-4 text-purple-700" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                                <path fill="currentColor" d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between">
                                    <div class="text-sm ml-auto">
                                        <a href="forgot-password" class="text-purple-700 hover:text-purple-600">
                                           <strong>¿Olvidaste tu contraseña?</strong> 
                                        </a>
                                    </div>
                                </div>
                                <div>
                                    <button
                                        type="submit"
                                        class="w-full flex justify-center bg-purple-800 hover:bg-purple-700 text-gray-100 p-3 rounded-lg tracking-wide font-semibold cursor-pointer transition ease-in duration-500"
                                    >
                                        Ingresar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>


@endsection
