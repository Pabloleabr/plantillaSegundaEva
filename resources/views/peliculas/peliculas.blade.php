<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('peliculas') }}
        </h2>
    </x-slot>

    @php

    $titulos= ['id' => '#','nombre' => '#', 'cantidad'=>'#', 'precio' => '', 'duracion'=>''];
    //consigo los titulos con sus links para ordenar con las claves
    foreach ($titulos as $key => $value) {

        $titulos[$key] = '/peliculas?orden=' . $key ;
    }
@endphp

    <x-tabla
    :enunciado="'Películas'"
    :titulos="$titulos">
    {{--creo todos los datos con dos for que me sacan todos los datos de la consulta--}}
    @foreach ($peliculas as $pelicula)
    <tr class="whitespace-nowrap">

        <td class="px-6 py-4">
            <div class="text-sm text-gray-900">
                {{$pelicula->id}}
            </div>
        </td>

        <td class="px-6 py-4">

            <div class="text-sm text-gray-900">
                    {{$pelicula->nombre}}
            </div>

        </td>

        <td class="px-6 py-4">

            <div class="text-sm text-gray-900">
                    {{$pelicula->cantidad}}
            </div>

        </td>

        <td class="px-6 py-4">
            <div class="text-sm text-gray-900">
                {{$pelicula->precio}}
            </div>
        </td>
        <td class="px-6 py-4">
            <div class="text-sm text-gray-900">
                {{$pelicula->duracion}}
            </div>
        </td>

        <td class="px-6 py-4">
            <form action="{{route('alquilar',$pelicula)}}" method="POST">
                @csrf
                <button type="submit" class="text-sm text-gray-900">
                    Reservar
                </button>
            </form>
        </td>

    </tr>
    @endforeach
    </x-tabla>

</x-app-layout>
