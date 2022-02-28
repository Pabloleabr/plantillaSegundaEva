<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-tabla
    :enunciado="'criterios de ' "
    :titulos="['ccee' => '', 'nota' =>'']">
    {{--creo todos los datos con dos for que me sacan todos los datos de la consulta--}}
    @foreach ($criterios as $criterio=>$nota)
    <tr class="whitespace-nowrap">

        <td class="px-6 py-4">
            <div class="text-sm text-gray-900">
                {{$criterio}}
            </div>
        </td>

        <td class="px-6 py-4">
            <div class="text-sm text-gray-900">
                {{$nota}}
            </div>
        </td>

    </tr>
    @endforeach


    </x-tabla>
</x-app-layout>
