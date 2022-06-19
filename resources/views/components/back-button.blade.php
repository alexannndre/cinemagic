<button type="button" onclick="location.href='{{ url()->previous() }}'"
    {{ $attributes->merge(['class' => 'button-primary ' . $class]) }}>
    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
        </path>
    </svg>
    <span>Voltar</span>
</button>
