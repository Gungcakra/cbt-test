<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>{{ $title }}</title>
</head>

<body class="font-poppins text-[#0A090B]">
    <section id="content" class="flex">
        @include('layouts.partials.student.sidebar')
        <div id="menu-content" class="flex flex-col w-full pb-[30px]">
            @include('layouts.partials.student.navbar')

            
            @yield('content')


        </div>
    </section>

</body>

</html>
