<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @include('includes.css')
</head>

<body>
    <div class="page-wrapper">
        @yield('sidebar-nav')

        <div class="main-container">
            @yield('content')
        </div>
    </div>
    
    @include('includes.js')
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                autoWidth: false,
                responsive: true,
            });
        });
    </script>
</body>

</html>