<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'PTIKBlog') . ' - ' . $title }}</title>

    @if (isset($meta_tags))
        {{ $meta_tags }}
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="flex flex-col min-h-screen bg-gray-100 dark:bg-gray-900">

        @include('layouts.navigation')

        <main class="flex-grow">
            {{ $slot }}
        </main>

        <footer class="w-full bg-gray-100">
            <div
                class="flex justify-between items-center max-w-7xl mx-auto py-6 px-4 font-semibold text-xs sm:px-6 lg:px-8 lg:text-sm">
                <p>Copyright &copy; {{ date('Y') }} - PTIK21 Blog</p>
                <p>Create By Hizkia Reppi</p>
            </div>
        </footer>
    </div>
    @include('sweetalert::alert')
</body>

</html>
