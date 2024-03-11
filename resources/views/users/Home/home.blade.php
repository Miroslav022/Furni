@extends('Layout')
{{--@php dd(session()->get('user')) @endphp--}}
@section('content')
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Modern Interior <span clsas="d-block">Design Studio</span></h1>
                        <p class="mb-4">Elevate your living space with our exquisite furniture collection. Crafted with precision and style to redefine your interior experience.</p>
                        <p><a href="{{route('shop')}}" class="btn btn-secondary me-2">Shop Now</a>
                        </p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="hero-img-wrap">
                        <img src="images/couch.png" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Product Section -->
    <div class="product-section">
        <div class="container">
            <div class="row" id="productSection">

                <!-- Start Column 1 -->
                <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                    <h2 class="mb-4 section-title">Crafted with excellent material.</h2>
                    <p class="mb-4">Discover our curated selection of furniture, designed for comfort and elegance. Redefine your space with our quality craftsmanship.</p>
                    <p><a href="{{route('shop')}}" class="btn">Explore</a></p>
                </div>
                <!-- End Column 1 -->

                <!-- Start Column 2 -->

                @foreach($data['products'] as $product)
{{--                    @php dd($product->prices) @endphp--}}
                    <x-ProductCard productName="{{$product->product_name}}" price="{{$product->prices->first()->price}}" src="{{$product->bg_image}}" product-Id="{{$product->id}}" card-style="col-12 col-md-4 col-lg-3 mb-5 mb-md-0"/>
                @endforeach

            </div>
        </div>
    </div>
    <!-- End Product Section -->

    @include('users.partials.whyus')

    <!-- Start We Help Section -->
    <div class="we-help-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <div class="imgs-grid">
                        <div class="grid grid-1"><img src="images/img-grid-1.jpg" alt="Untree.co"></div>
                        <div class="grid grid-2"><img src="images/img-grid-2.jpg" alt="Untree.co"></div>
                        <div class="grid grid-3"><img src="images/img-grid-3.jpg" alt="Untree.co"></div>
                    </div>
                </div>
                <div class="col-lg-5 ps-lg-5">
                    <h2 class="section-title mb-4">We Help You Make Modern Interior Design</h2>
                    <p>At our design studio, we understand that every space is unique, and so should be its design. We're here to assist you in creating modern interior spaces that reflect your style and personality. Here's how we make a difference:</p>

                    <ul class="list-unstyled custom-list my-4">
                        <li>Tailored Designs</li>
                        <li>Expert Assistance</li>
                        <li>Quality Materials</li>
                        <li>Effortless Experience</li>
                    </ul>
                    <p><a href="{{route('shop')}}" class="btn">Explore</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- End We Help Section -->

    <!-- Start Testimonial Slider -->
    @include('users.partials.testimonials')
    <!-- End Testimonial Slider -->

@endsection

@section("script")
    <script src="{{'js/addToCart.js'}}"></script>
@endsection
