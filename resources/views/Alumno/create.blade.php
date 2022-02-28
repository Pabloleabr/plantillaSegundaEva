<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <form action="{{route('alumnos.store')}}" method="POST" class="p-6">
        @csrf
        <x-label for="nombre" :value="__('nombre')" />

                <x-input id="nombre" class="block mt-1 w-full"
                                type="text"
                                name="nombre"
                                required autocomplete="current-nombre" />
        <button type="submit">Crear</button>
    </form>


</x-app-layout>
