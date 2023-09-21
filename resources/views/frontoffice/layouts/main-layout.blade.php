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
</body>

</html>
