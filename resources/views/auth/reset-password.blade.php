@extends('home')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<h1 class="text-gray-800 font-bold text-2xl mb-4">Restablecer Contraseña</h1>
<p class="text-gray-400 mb-6">
    Ingresa tu nueva contraseña para restablecer tu cuenta.
</p>
<form method="post" action="{{ route('show-reset-password') }}">
    @csrf
    <input type="hidden" id="token" name="token" value="{{ $token }}">

    <div class="mb-4">
        <input id="email" name="email" placeholder="Confirma tu correo electrónico" value="" class="w-full text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:border-purple-400" type="email" required autofocus />
    </div>

    <div class="relative mb-4" x-data="{ show: false }">
        <input id="password" name="password" placeholder="Nueva Contraseña" x-bind:type="show ? 'text' : 'password'" class="w-full text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:border-purple-400" required />
        <div class="flex items-center absolute inset-y-0 right-0 mr-3 text-sm leading-5">
            <button @click="show = !show" type="button">
                <svg class="h-4 text-purple-700" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                    <path fill="currentColor" d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z"></path>
                </svg>
            </button>
        </div>
    </div>

    <div>
        <button type="submit" class="w-full flex justify-center bg-purple-800 hover:bg-purple-700 text-gray-100 p-3 rounded-lg tracking-wide font-semibold cursor-pointer transition ease-in duration-500">
            Restablecer Contraseña
        </button>
    </div>
</form>


<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
@endsection
