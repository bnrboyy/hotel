@extends('frontoffice.layouts.main-layout')

@section('style')
    <link rel="stylesheet" href="css/about.css">
@endsection

@section('content')
    <div class="head-title">
        <div class="my-5 px-4">
            <h1 class="fw-bold h-font text-center">ABOUT US</h1>
            <div class="h-line bg-dark"></div>
            <p class="text-center mt-3">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                Odit provident ea facere maxime illum harum reprehenderit impedit est tempore accusamus!
                Lorem ipsum dolor, <br> sit amet consectetur adipisicing elit. Recusandae neque iure voluptas,
                possimus magni placeat necessitatibus exercitationem quisquam quis libero.
            </p>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
                <h3 class="mb-3">Lorem ipsum dolor sit.</h3>
                <p>Lorem ipsum dolor sit amet,
                   consectetur adipisicing elit.
                   Iusto vel perferendis, magnam sapiente sed enim eius similique quaerat dolorum tempore!
                </p>
            </div>
            <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
                <img src="images/about/about.jpg" class="w-100">
            </div>
        </div>

    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div>
                    <img src="images/about/hotel.svg" width="70px">
                    <h3 class>100+ ROOMS</h3>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>

    </script>
@endsection


