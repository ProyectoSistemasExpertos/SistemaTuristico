@extends('body.master_blade')
@section('body')
<nav class="bg-white-600 p-4 text-black w-full rounded-b-lg">
        <ul class="flex flex-wrap justify-end">
            <li style="margin-right: 1.5rem" class="hover:text-blue-300 mb-2">
                <a href="/booking" onclick="event.preventDefault(); document.getElementById('category-form').submit();">Inicio</a>
                <form id="category-form" action="/booking" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="category" value="0">
                </form>
            </li>
            <li style="margin-right: 1.5rem" class="hover:text-blue-300 mb-2">
                <a href="/history-preference">Historial de Preferencias</a>
            </li>
            <li style="margin-right: 1.5rem" class="hover:text-blue-300 mb-2">
                <a href="/user-history">Historial de Reservaciones</a>
            </li>
            <li style="margin-right: 1.5rem" class="hover:text-blue-300 mb-2" onclick="openModal()">
                Crear un Nuevo Destino
            </li>
            <li style="margin-right: 1.5rem" class="hover:text-blue-300 mb-2">
                <a href="/view-user">
                    <span class="fa fa-user" style="margin-right: 0.5rem;"></span>
                    {{ $userData->name }}
                </a>
            </li>
        </ul>
    </nav>

    @if ($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="absolute inset-0 bg-black opacity-50" onclick="closeModal()"></div>
            <div class="bg-white p-8 rounded-lg z-50 w-11/12 md:w-2/3 lg:w-1/2 xl:w-1/3">
                <h2 class="text-2xl font-bold mb-4 text-center">Registrar un Nuevo Destino</h2>

                <!-- Formulario -->
                <form action="{{ route('store.destination') }}" method="POST" class="text-left" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-600">Título:</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="Ingrese el título" class="mt-1 p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 {{ $errors->has('title') ? 'border-red-500' : '' }}">
                        @if ($errors->has('title'))
                            <div class="text-red-500 text-sm">{{ $errors->first('title') }}</div>
                        @endif
                    </div>

                    <!-- Resto del formulario (traducción similar) -->

                    <div class="mb-4">
                        <button type="submit" class="bg-blue-500 text-white p-2 rounded-full">Crear Destino</button>
                        <button type="button" onclick="closeModal()" class="ml-2 p-2 bg-red-500 text-white rounded-full">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

@endsection