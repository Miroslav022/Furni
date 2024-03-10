@extends('Layout')

@section('content')
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Checkout</h1>
                    </div>
                </div>
                <div class="col-lg-7">

                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <div class="untree_co-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-5 mb-md-0">
                    <h2 class="h3 mb-3 text-black">Shipping address Details</h2>
                    <div class="p-3 p-lg-5 border bg-white">
                        <table class="table site-block-order-table mb-5">
                            <thead>
                            <th>Address</th>
                            <th>City</th>
                            <th>Country</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$location->address}}</td>
                                    <td>{{$location->city->city}}</td>
                                    <td>{{$location->city->country->country}}</td>

                                </tr>
                            </tbody>
                        </table>

                        <form action="{{route('order.location')}}" method="POST">
                            @csrf
                        <div class="form-group">
                            <label for="c_ship_different_address" class="text-black" data-bs-toggle="collapse" href="#ship_different_address" role="button" aria-expanded="false" aria-controls="ship_different_address"><input type="button" class="btn btn-black" value="Specify new shipping address" id="c_ship_different_address"></label>
                            <div class="collapse" id="ship_different_address">
                                <div class="py-2">
                                    <div class="form-group">
                                        <label for="c_country" class="text-black">Country <span class="text-danger">*</span></label>
                                        <select id="countries-select" name="country" class="form-control">
                                            <option value="0">Select a city</option>
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}">{{$country->country}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="c_country" class="text-black">Country <span class="text-danger">*</span></label>
                                        <select id="city-select" disabled="disabled" name="city" class="form-control">
                                            <option value="0">Select a country</option>
                                        </select>
                                    </div>


                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="c_address" name="address" placeholder="Street address">
                                        </div>
                                    </div>
                                    <div class="input-group-append mt-3">
                                        <button class="btn btn-black btn-sm" type="submit" id="button-addon2">Apply new location</button>
                                    </div>

                                </div>

                            </div>
                        </div>
                        </form>


                    </div>
                </div>
                <div class="col-md-6">

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Your Order</h2>
                            <div class="p-3 p-lg-5 border bg-white">
                                <table class="table site-block-order-table mb-5">
                                    <thead>
                                    <th>Product</th>
                                    <th>Total</th>
                                    </thead>
                                    <tbody>
                                    @php $total = 0; @endphp
                                    @foreach(session()->get('cart') as $item)
                                        <tr>
                                            <td>{{$item->product->product_name}} <strong class="mx-2">x</strong> {{$item->quantity}}</td>
                                            <td>${{$item->product->price * $item->quantity}}</td>
                                            @php $total = $total + $item->product->price * $item->quantity@endphp
                                        </tr>
                                    @endforeach
                                        <tr>
                                            <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
                                            <td class="text-black">${{$total}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                                            <td class="text-black font-weight-bold"><strong>${{$total+20}}</strong></td>
                                        </tr>


                                    </tbody>
                                </table>
                                <div class="form-group">
                                    <form action="{{route('order.store')}}" method="POST">
                                        @csrf
                                        <button class="btn btn-black btn-lg py-3 btn-block">Place Order</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- </form> -->
        </div>
    </div>

@endsection

@section('script')
    <script src="{{asset('js/registration.js')}}"></script>
@endsection
