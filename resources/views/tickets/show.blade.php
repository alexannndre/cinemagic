<x-dashboard.layout title="CineMagic - Recibo">
    <div class="grid gap-6 mb-8 md:grid-cols-3">
        <div class="min-w-0 col-span-1 p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div class="float-left mb-2 ml-3 text-2xl font-semibold dark:text-gray-200">Bilhete #{{ $ticket->id }}
            </div>
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-white border-b dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800">
                        <th class="invisible px-4 py-3"></th>
                        <th class="invisible px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 font-bold">Referência</td>
                        <td class="float-right px-4 py-3">{{ $ticket->id }}</td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 font-bold">Filme</td>
                        <td class="float-right px-4 py-3">{{ $ticket->screening->film->titulo }}</td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 font-bold">Data da sessão</td>
                        <td class="float-right px-4 py-3">
                            {{ $ticket->screening->data->translatedFormat('j \d\e F \d\e Y') }}
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 font-bold">Hora da sessão</td>
                        <td class="float-right px-4 py-3">{{ $ticket->screening->horario_inicio->format('G:i') }}</td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 font-bold">Sala</td>
                        <td class="float-right px-4 py-3">{{ $ticket->screening->screen->nome }}</td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 font-bold">Lugar</td>
                        <td class="float-right px-4 py-3">{{ $ticket->seat->fila . $ticket->seat->posicao }}</td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 font-bold">Estado</td>
                        <td class="float-right px-4 py-3">
                            <span
                                class="px-2 py-1 font-semibold leading-tight {{ $ticket->estado == 'usado' ? 'text-red-700 bg-red-100 dark:text-red-100 dark:bg-red-700' : 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' }}  rounded-full">
                                {{ $ticket->estado == 'usado' ? 'Usado' : 'Não Usado' }}
                            </span>
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 font-bold">Data da compra </td>
                        <td class="float-right px-4 pt-3">
                            {{ $ticket->receipt->data->translatedFormat('j \d\e F \d\e Y') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="min-w-0 p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <x-tickets.client-data :ticket="$ticket" />
        </div>
    </div>
</x-dashboard.layout>
