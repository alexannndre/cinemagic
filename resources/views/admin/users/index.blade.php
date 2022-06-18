<x-dashboard.layout title="CineMagic - Utilizadores" header="Gestão de Utilizadores">
    @can('create', App\Models\User::class)
        <form method="get" action="{{ route('admin.users.create') }}" class="-mt-4">
            @csrf
            <x-dashboard.button class="button-primary mb-3">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                    </path>
                </svg>
                <x-slot:label>Criar</x-slot:label>
            </x-dashboard.button>
        </form>
    @endcan
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <x-dashboard.users-table :users="$users" :authUser="$authUser" />
        </div>
        {{ $users->onEachSide(2)->links() }}
    </div>
</x-dashboard.layout>
