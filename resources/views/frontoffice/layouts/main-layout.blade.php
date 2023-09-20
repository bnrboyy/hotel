<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Header -->
    @include('frontoffice.layouts.header')
    @yield('style')
    <title>Hotel Booking</title>
</head>

<body class="bg-light">

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
