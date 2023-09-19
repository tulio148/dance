<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="https://developer.squareup.com/reference/sdks/web/static/styles/code-preview.css"
        preload> --}}
    <!-- Scripts -->
    @routes
    @viteReactRefresh
    @vite(['resources/js/app.jsx', "resources/js/Pages/{$page['component']}.jsx", 'resources/js/sq-card-pay.js', 'resources/js/sq-payment-flow.js'])
    <script type="text/javascript" src="https://sandbox.web.squarecdn.com/v1/square.js"></script>
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia
</body>

</html>
