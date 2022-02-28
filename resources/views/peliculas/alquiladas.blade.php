<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Alquiladas') }}
        </h2>
    </x-slot>

    @php

    $titulos= ['nombre' => '#', 'precio'=>'#', 'alquila el dia' => '#'];

@endphp

    <x-tabla
    :enunciado="'Tus Películas Alquiladas'"
    :titulos="$titulos">
    {{--creo todos los datos con dos for que me sacan todos los datos de la consulta--}}
    @foreach ($prestadas as $prestada)
    <tr class="whitespace-nowrap">
        @php
            $pelicula = $prestada->pelicula;
        @endphp
        <td class="px-6 py-4">
            <div class="text-sm text-gray-900">
                {{$pelicula->nombre}}
            </div>
        </td>

        <td class="px-6 py-4">

            <div class="text-sm text-gray-900">
                {{$pelicula->precio}}
            </div>

        </td>

        <td class="px-6 py-4">
            <div class="text-sm text-gray-900">
                {{$prestada->created_at}}
            </div>
        </td>


    </tr>
    @endforeach
    </x-tabla>

</x-app-layout>
