<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Header -->
    @include('frontoffice.layouts.header')
    @yield('style')
    <title>Hotel Booking</title>
</head>

<body class="bg-light" style="overflow-x: hidden; min-height: 100vh !important">

    <!-- Navbar -->
    @include('frontoffice.layouts.navbar')


    <!-- Content Section -->
    @yield('content')


    <!-- Footer -->
    @include('frontoffice.layouts.footer')

    <!-- Scripts -->
    @include('frontoffice.layouts.scripts')

    @yield('scripts')

    <script>
        function bookingSearch() {
            const phone = localStorage.getItem('phone')
            const card_id = localStorage.getItem('card_id')

            window.location.href = `/bookingsearch?phone=${phone}&card_id=${card_id}`;
        }
    </script>
</body>

</html>
