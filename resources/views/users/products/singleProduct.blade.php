@extends("Layout")
{{--@php  dd(session()->get('cart')) @endphp--}}
{{--@php  session()->remove('cart') @endphp--}}
@section("content")
    <section class="py-5">
        <div class="container">
            <div class="row gx-5">
                <aside class="col-lg-6">
                    <div class="border rounded-4 mb-3 d-flex justify-content-center">
                        <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit"
                             src="{{asset('products/'.$product->bg_image)}}"/>
                    </div>
                    <div class="d-flex justify-content-center mb-3">

                        @foreach($product->images as $image)
                            <img width="60" height="60" class="rounded-2" src="{{asset('products/'.$image->src)}}"/>
                        @endforeach
                    </div>
                    <!-- thumbs-wrap.// -->
                    <!-- gallery-wrap .end// -->
                </aside>
                <main class="col-lg-6">
                    <div class="ps-lg-3">
                        <h4 class="title text-dark">
                            {{$product->product_name}} <br/>
                            {{$product->category->category}}
                        </h4>
                        <div class="d-flex flex-row my-3">
                            <div class="text-warning mb-1 me-2">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span class="ms-1">
                4.5
              </span>
                            </div>
                            <span class="text-muted"><i class="fas fa-shopping-basket fa-sm mx-1"></i>154 orders</span>
                            <span class="text-success ms-2">In stock</span>
                        </div>

                        <div class="mb-3">
                            <span class="h5">${{$product->prices->first()->price}}</span>
                            <span class="text-muted">/per box</span>
                        </div>

                        <p>
                            {{$product->description}}
                        </p>

                        <div class="row">
                            <p>Specifications:</p>
                            @foreach($product->specifications as $spec)
                                {{--                                @php dd($spec->specification) @endphp--}}
                                <dt class="col-4">{{$spec->specification}}:</dt>
                                <dd class="col-8">{{$spec->pivot->value}}</dd>
                            @endforeach

                        </div>

                        <div class="row mt-4">
                            <p>Materials:</p>
                            @foreach($product->materials as $material)

                                <dt class="col-12">{{$material->material}}</dt>
                            @endforeach

                        </div>

                        <hr/>

                        <div class="row mb-4" id="productSection">
                            <!-- col.// -->
                            <div class="col-md-12 col-12 mb-3">
                                <label class="mb-2 d-block">Quantity</label>
                                <div class="input-group mb-3 quantity-operations" style="width: 170px;">
                                    <button class="btn btn-white border border-secondary px-3 decrease" type="button"
                                            id="button-addon1" data-mdb-ripple-color="dark">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="text" class="form-control text-center border border-secondary quantity"
                                           value="1" aria-label="Example text with button addon"
                                           aria-describedby="button-addon1"/>
                                    <button class="btn btn-white border border-secondary px-3 increase" type="button"
                                            id="button-addon2" data-mdb-ripple-color="dark">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <div class="col-md-12 col-12 mb-3">
                                    <dt>The product is available in the following locations:</dt>
                                    <form>
                                        @foreach($product->inventories as $inv)
                                            <div class="form-check d-flex align-items-center gap-2">
                                                <input class="form-check-input inventories-checkbox" name="inventories" type="radio"
                                                       value="{{$inv->pivot->inventory_id}}" id="inventory{{$inv->pivot->inventory_id}}"
                                                       data-qty="{{$inv->pivot->quantity}}">
                                                <label class="form-check-label" for="inventory{{$inv->pivot->inventory_id}}">
                                                    {{$inv->location->address}} - <b>{{$inv->location->city->city}}</b>
                                                    (<b>{{$inv->pivot->quantity}}</b> on stock)
                                                </label>
                                            </div>
                                        @endforeach
                                    </form>
                                </div>
                            </div>

                            @php
                            $is_inCart = false;
                            if(session()->has('cart')){
                                foreach (session()->get('cart') as $item) {
                                    if($item->product->product_id===$product->id) {
                                        $is_inCart = true;
                                        break;
                                    }
                                }
                            }
                            @endphp
                            @if(session()->has('user') && !$is_inCart)
                                <a href="#" class="btn btn-primary shadow-0 addToCart" data-id="{{$product->id}}">
                                    <i class="me-1 fa fa-shopping-basket"></i> Add to cart </a>
                            @elseif($is_inCart)
                                <div class="alert alert-info" role="alert">
                                    Product is already in the cart!
                                </div>
                            @else
                                <div class="alert alert-info" role="alert">
                                    Please log in if you want shopping!
                                </div>
                            @endif
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </section>
    <!-- content -->

    <section class="border-top py-4">
        <div class="container">
            <div class="row gx-4">
                <div class="col-lg-8 mb-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 course-details-content">
                                <div class="course-details-card mt--40">
                                    <div class="course-content" data-product="66">
                                        <div class="row">
                                            <div class="report"></div>
                                            <h5 class="mb--25">Write review</h5>
                                            <form id="rewiew-form">
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Title</label>
                                                    <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="message" class="form-label">Rewiew</label>
                                                    <textarea class="form-control" name="message" id="message" rows="3" data-gramm="false" wt-ignore-input="true"></textarea>
                                                </div>
                                                <input type="hidden" name="product_id" value="{{$product->id}}"/>
                                                <button type="submit" class="btn btn-success" data-id="18" id="sendRewies">Send review</button>
                                            </form>
                                        </div>
                                        <div class="comment-wrapper pt--40 reviews-block">
                                            @foreach($product->recensions as $recension)
                                                <div class=" mt-3 d-flex justify-content-between align-items-center recension">
                                                    <div class=" mt-3 edu-comment d-flex gap-3">
                                                        <div class="thumbnail"> <img class="rec-img" src="{{asset('images/user.png')}}" alt="Comment Images"> </div>
                                                        <div class="comment-content">
                                                            <div class="comment-top">
                                                                <h6 class="title">{{$recension->user->first_name}} {{$recension->user->last_name}}</h6>
                                                                <div class="rating"> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i> </div>
                                                            </div>
                                                            <span class="subtitle text-dark">“{{$recension->title}} ”</span>
                                                            <p>{{$recension->recension}}</p>
                                                        </div>

                                                    </div>
                                                    @if($recension->user_id === session()->get('user')->id)
                                                        <div>
                                                            <a class="btn btn-danger remove-btn" data-id="{{$recension->id}}">Remove review</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="px-0 border rounded-2 shadow-0">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Similar items</h5>
                                @foreach($similarProducts as $s_product)
                                    <div class="d-flex mb-3">
                                        <a href="{{route('product.show', ["product"=>$s_product->id])}}" class="me-3">
                                            <img src="{{asset('products/'.$s_product->bg_image)}}"
                                                 style="min-width: 96px; height: 96px;" class="img-md img-thumbnail"/>
                                        </a>
                                        <div class="info">
                                            <a href="{{route('product.show', ["product"=>$s_product->id])}}"
                                               class="nav-link mb-1">
                                                {{$s_product->product_name}} <br/>
                                                {{$s_product->category->category}}
                                            </a>
                                            <strong class="text-dark"> ${{$s_product->prices->first()->price}}</strong>
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section("script")
    {{--    <script src="{{asset('js/addToCart.js')}}"></script>--}}
    <script src="{{asset('js/products/addProductFromSinglePage.js')}}"></script>
    <script src="{{asset('js/products/recension.js')}}"></script>

@endsection
