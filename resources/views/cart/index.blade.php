<x-dashboard.layout title="CineMagic - Carrinho de Compras" :header="!$cart->isEmpty() ? 'Carrinho de Compras' : ''">
    @if (!$cart->isEmpty())
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-white border-b dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Filme</th>
                    <th class="px-4 py-3">Género</th>
                    <th class="px-4 py-3">Preço</th>
                    <th class="px-4 py-3">Ações</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach ($cart as $film)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                    <img class="object-cover w-full h-full rounded-full"
                                        src="{{ asset('storage/cartazes/' . $film->cartaz_url) }}" alt="{{ $film->titulo }}"
                                        class="mt-2 mb-3 rounded-full w-9 h-9" loading="lazy">
                                    <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                </div>
                                <div>
                                    <p class="font-semibold">{{ $film->titulo }}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">{{ $film->ano }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <p class="font-semibold">{{ $film->genre->nome }}</p>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <p class="font-semibold">5€</p>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">
                                <form method="POST" action="cart/film/{{ $film->id }}">
                                    <button type="submit"
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Delete">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <x-dashboard.empty-cart />
    @endif

</x-dashboard.layout>