@php
    $title = app('admin')->title;
    $breadcrumbs = app('admin')->breadcrumbs;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    @vite(['resources/admin/scss/style.scss', 'resources/admin/js/script.js'])
</head>

<body>
    <div class="page">
        <x-admin.header />
        <x-admin.sidebar :entities="$entities"/>
        <main class="main">
            <div class="container">
                @if (!empty($breadcrumbs))
                    <x-admin.breadcrumbs :collection="$breadcrumbs"/>
                @endif
                <h1 class="title">{{ $title }}</h1>
                {{ $slot }}
            </div>
        </main>
        {{-- <x-admin.footer></x-admin.footer> --}}
    </div>
</body>

</html>
