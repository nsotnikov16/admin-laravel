<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/admin/scss/style.scss', 'resources/admin/js/script.js'])
</head>

<body>
    <div class="page">
        <x-admin.header></x-admin.header>
        <x-admin.sidebar></x-admin.sidebar>

        <main class="main">
            <div class="container">
                <x-admin.breadcrumbs></x-admin.breadcrumbs>
                <h1 class="title">{{ $title }}</h1>
                {{ $slot }}
            </div>
        </main>
        {{-- <x-admin.footer></x-admin.footer> --}}
    </div>
</body>

</html>
