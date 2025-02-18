<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--bootstrap Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!--bootstrap Style-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!--tipografias-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&family=Unica+One&display=swap"
        rel="stylesheet">
    <!--estilos-->
    @vite(['resources/scss/config/reset.scss', 'resources/scss/layouts/button.scss', 'resources/scss/layouts/form.scss', 'resources/scss/main.scss', 'resources/js/dom.js', 'resources/js/checkboxFormEntrada.js', 'resources/js/checkboxFormEvento.js', 'resources/js/btnComprar.js'])
    <title>{{ $title ?? 'Titulo' }}</title>
    
    <meta name="description" content="{{$meta_description??'Eventos online'}}">
</head>

<body>
    {{ $slot }}
    <!--Sweet alert 2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
