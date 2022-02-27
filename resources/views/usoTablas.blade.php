<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    @php
    //obtengo todos los links para el buscador atraves de las claves
    $titulos= ['id' => '#','nombre' => '#'];
    $link='';
    foreach ($titulos as $key => $value) {
        $link .= '&' . $key . '=' . '';
    }
    $link = e($link);
    //consigo los titulos con sus links para ordenar atraves de las claves
    foreach ($titulos as $key => $value) {

        $titulos[$key] = '/alumnos/?orden=' . $key . $link;
    }
@endphp
{{--Creo el formulario de busuedas con cada campo cogido de los titulos--}}
<form action="/alumnos?orden={{old('orden')}}{!!$link!!}" method="GET" class=" flex flex-wrap gap-2 justify-center p-2">
    @foreach (array_keys($titulos)  as $titulo)
        <div>
            <label for="{{$titulo}}">{{$titulo}}</label>
            <input type="text" name="{{$titulo}}" class="border">
        </div>
    @endforeach
    <input type="submit" value="buscar">
</form>

<x-tabla
:enunciado="'alumnos'"
:titulos="$titulos">
{{--creo todos los datos con dos for que me sacan todos los datos de la consulta--}}
@foreach ($alumnos as $alumno)
<tr class="whitespace-nowrap">

    <td class="px-6 py-4">
        <div class="text-sm text-gray-900">
            {{$alumno->id}}
        </div>
    </td>

    <td class="px-6 py-4">
        <div class="text-sm text-gray-900">
            {{$alumno->nombre}}
        </div>
    </td>

</tr>
@endforeach
</x-tabla>

{{--  <x-tablaBasica
:enunciado="'titulo'"
:datos="[['titulo1'=>1,'titulo2'=>2]]">
</x-tablaBasica> --}}

{{-- <div class="flex items-center">
    {{ $alumnos->links() }}
</div> --}}


</x-app-layout>
