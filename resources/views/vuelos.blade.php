<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if(session('error') != null)
        <div class="flex p-2 bg-red-500 rounded-lg m-4" >
            {{session('error')}}
        </div>
    @endif

    @php
    //obtengo todos los links para el buscador atraves de las claves
    $titulos= ['id' => '#','codigo' => '#', 'origen'=>'#', 'destino'=>'#', 'compañia'=>'#',
    'precio'=>'#', 'plazasTotales'=>'#', 'llegada'=>'#', 'salida'=>'#'];
    $link='';
    foreach ($titulos as $key => $value) {
        $link .= '&' . $key . '=' . '';
    }
    $link = e($link);
    //consigo los titulos con sus links para ordenar atraves de las claves
    foreach ($titulos as $key => $value) {

        $titulos[$key] = '/vuelos/?orden=' . $key . $link;
    }
@endphp
{{--Creo el formulario de busuedas con cada campo cogido de los titulos--}}
<form action="/vuelos?orden={{old('orden')}}{!!$link!!}" method="GET" class="flex flex-wrap gap-2 justify-center p-2">
    @foreach (array_keys($titulos)  as $titulo)
        <div>
            <label for="{{$titulo}}">{{$titulo}}</label>
            <input type="text" name="{{$titulo}}" class="border">
        </div>
    @endforeach
    <input type="submit" value="buscar">
</form>
<x-tabla
:enunciado="'vuelos'"
:titulos="$titulos">
{{--creo todos los datos con dos for que me sacan todos los datos de la consulta--}}
@foreach ($vuelos as $vuelo)
<tr class="whitespace-nowrap">

    <td class="px-6 py-4">
        <div class="text-sm text-gray-900">
            {{$vuelo->id}}
        </div>
    </td>

    <td class="px-6 py-4">

            <div class="text-sm text-gray-900">
                {{$vuelo->codigo}}
            </div>

    </td>

    <td class="px-6 py-4">
        <div class="text-sm text-gray-900">
            {{$vuelo->aeropuerto_de_origen->nombre}}
        </div>
    </td>

    <td class="px-6 py-4">
            <div class="text-sm text-gray-900">
                {{$vuelo->aeropuerto_de_destino->nombre}}
            </div>
    </td>

    <td class="px-6 py-4">
        <div class="text-sm text-gray-900">
            {{$vuelo->companyia->nombre}}
        </div>
    </td>
    <td class="px-6 py-4">
        <div class="text-sm text-gray-900">
            {{$vuelo->precio}}
        </div>
    </td>
    <td class="px-6 py-4">
        <div class="text-sm text-gray-900">
            {{$vuelo->plazas}}
        </div>
    </td>
    <td class="px-6 py-4">
        <div class="text-sm text-gray-900">
            {{$vuelo->llegada}}
        </div>
    </td>
    <td class="px-6 py-4">
        <div class="text-sm text-gray-900">
            {{$vuelo->salida}}
        </div>
    </td>

    <td class="px-6 py-4">
        <a href="{{route('reservar', $vuelo)}}">
        <div class="text-sm text-gray-900">
            reservar
        </div>
    </a>
    </td>
</tr>
@endforeach
</x-tabla>

{{--  <x-tablaBasica
:enunciado="'titulo'"
:datos="[['titulo1'=>1,'titulo2'=>2]]">
</x-tablaBasica> --}}

 <div class="flex items-center">
    {{ $vuelos->links() }}
</div>


</x-app-layout>
