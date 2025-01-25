<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
</head>
<body class="font-poppins text-[#0A090B]">
    <section id="content" class="flex">
       @include('layouts.partials.admin.sidebar')
        <div id="menu-content" class="flex flex-col w-full pb-[30px]">
          @include('layouts.partials.admin.navbar')
            
            @yield('content')

        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuButton = document.getElementById('more-button');
            const dropdownMenu = document.querySelector('.dropdown-menu');

            menuButton.addEventListener('click', function() {
                dropdownMenu.classList.toggle('hidden');
            });

            // Close the dropdown menu when clicking outside of it
            document.addEventListener('click', function(event) {
                const isClickInside = menuButton.contain(event.target) || dropdownMenu.contain(event.target);
                if (!isClickInside) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        });

    </script>

</body>
</html>
