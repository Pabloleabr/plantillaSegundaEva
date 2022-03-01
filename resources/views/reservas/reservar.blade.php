

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Reservar') }}
            </h2>
        </x-slot>


        @php
        //obtengo todos los links para el buscador atraves de las claves
        $titulos= ['id' => '#','codigo' => '#', 'aeropuerto_origen'=>'#'
        , 'aeropuerto_destino'=>'#', 'companyia_id'=>'#',
        'precio'=>'#', 'plazas'=>'#', 'llegada'=>'#', 'salida'=>'#'];
        $link='';
        foreach ($titulos as $key => $value) {
            $link .= '&' . $key . '=' . '';
        }

    @endphp

    <x-tabla
    :enunciado="'vuelo' . $vuelo->codigo"
    :titulos="$titulos">
    {{--creo todos los datos con dos for que me sacan todos los datos de la consulta--}}

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
    </tr>
    </x-tabla>

    <form action="route" method="post">
        @csrf
        @foreach ($titulos as $campo=>$ruta)
        <input type="hidden" name="{{$campo}}"
        value="{{$vuelo[$campo]}}">

        @endforeach

    </form>
    {{--  <x-tablaBasica
    :enunciado="'titulo'"
    :datos="[['titulo1'=>1,'titulo2'=>2]]">
    </x-tablaBasica> --}}


    </x-app-layout>


