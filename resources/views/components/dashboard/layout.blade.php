<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="{{ asset('js/init-alpine.js') }}"></script>
</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <x-dashboard.sidebar />

        <div class="flex flex-col flex-1 w-full">
            <x-dashboard.header />
            <main class="h-full pb-16 overflow-y-auto">
                <div class="container grid px-6 mx-auto">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        @if ($backButton == 'true')
                            <span class="float-left"> {{ $header }} </span>
                            <x-back-button class="ml-4 float-left" />
                        @else
                            {{ $header }}
                        @endif

                    </h2>
                    @if (session('alert-msg'))
                        <x-dashboard.alert />
                    @endif

                    @if (isset($errors))
                        @foreach ($errors->all() as $error)
                            <x-dashboard.alert-with-error :message="$error" />
                        @endforeach
                    @endif

                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</body>

<script src="{{ asset('js/app.js') }}" defer></script>

</html>
