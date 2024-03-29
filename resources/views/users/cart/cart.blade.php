@extends("Layout")

@section("content")
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Cart</h1>
                    </div>
                </div>
                <div class="col-lg-7">

                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->



    <div class="untree_co-section before-footer-section">
        <div class="container cart-container">
            <div class="row mb-5 ">
                <form class="col-md-12" method="post">
                    <div class="site-blocks-table">

                        @if(empty(session()->get('cart')))
                            <div class="alert alert-danger" role="alert">
                                Cart is empty!
                            </div>
                        @else
                            <div class="loader"></div>

                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="product-thumbnail">Image</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-total">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                                </thead>
                                <tbody id="cart-body">

                                </tbody>
                            </table>
                        @endif
                    </div>

                </form>
            </div>

            @if(!empty(session()->get('cart')))
                <div class="row coupon-container">
                   <div class="col-md-6"></div>
                    <div class="col-md-6 pl-5">
                        <div class="row justify-content-end">
                            <div class="col-md-7 cart-total">
                                <div class="row">
                                    <div class="col-md-12 text-right border-bottom mb-5">
                                        <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <span class="text-black">Subtotal</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <strong class="text-black sub-total">$230.00</strong>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-6">
                                        <span class="text-black">Total</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <strong class="text-black totalPrice">$230.00</strong>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <a class="btn btn-black btn-lg py-3 btn-block"
                                                href="{{route('order.index')}}">Proceed To Checkout
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
            @else
                <div class="col-md-6">
                    <a href="{{route('shop')}}" class="btn btn-outline-black btn-sm btn-block">Go Shopping</a>
                </div>
              @endif
    </div>


@endsection

@section("script")
    <script src="{{'js/cart.js'}}"></script>
@endsection
