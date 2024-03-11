@extends("Layout")

@section("content")

    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Shop</h1>
                    </div>
                </div>
                <div class="col-lg-7">

                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <div class="untree_co-section product-section before-footer-section">
        <div class="container ct-pagination upperPagination">
            {{$products->links()}}
        </div>
        <div class="container">

            <div class="row">
                <div class="col-3">
                    <form action="{{route("shop")}}" method="GET">
                        <div class="form-group">
                            <h4>Search</h4>
                            <input class="form-control" name="search" value="{{$search}}" type="search"/>
                            <button type="submit" class="btn btn-primary mt-3">Search</button>
                        </div>

                        <div class="form-group mt-5">
                            <h4>Filter by Category</h4>
                            @foreach($categories as $category)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="categories[]" {{in_array($category->id, $checkedCat ?? []) ? 'checked=true' : ''}} value="{{ $category->id }}">
                                    <label class="form-check-label">{{ $category->category }}</label>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Apply Filters</button>

{{--                        <div class="form-group mt-5">--}}
{{--                            <h4>Filter by Specification</h4>--}}
{{--                            @foreach($specifications as $spec)--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" name="specifications[]" {{in_array($spec->id, $checkedSpec ?? []) ? 'checked=true' : ''}} value="{{ $spec->id }}">--}}
{{--                                    <label class="form-check-label">{{ $spec->specification }}</label>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
                        <div class="form-group mt-5">
                            <h4>Filter by Material</h4>
                            @foreach($materials as $material)
{{--                            @php dd(in_array($material->id, $checkedMaterials ?? [])) @endphp--}}
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="materials[]" {{in_array($material->id, $checkedMaterials ?? []) ? 'checked' : ''}} value="{{ $material->id }}">
                                    <label class="form-check-label">{{ $material->material }}</label>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Apply Filters</button>

                        <div class="form-group mt-5">
                            <h4>Sort</h4>

                            <select class="form-control" name="sort">
                                <option value="price-asc">Sort by Price (Low to High)</option>
                                <option value="price-desc">Sort by Price (High to Low)</option>
                                <option value="created_at-asc">Sort by Date (Old to New)</option>
                                <option value="created_at-desc">Sort by Date (New to Old)</option>
                            </select>

                        </div>


                        <button type="submit" class="btn btn-primary mt-3">Apply Filters</button>
                    </form>
                </div>

                <div class="col-9">
                    <div class="row" id="productSection">
                        @if(count($products)==0)
                            <div class="alert alert-primary" role="alert">
                            There is not products with these filters.
                            </div>
                        @else
{{--                            @foreach($products as $product)--}}
{{--    --}}{{--                            @php dd($product) @endphp--}}
{{--                                @include("users.partials.productCard")--}}
{{--                            @endforeach--}}

                                @foreach($products as $product)
{{--                                    @php dd($product) @endphp--}}
                                    {{--                    @php dd($product->prices) @endphp--}}
                                    <x-ProductCard productName="{{$product->product_name}}" price="{{$product->price}}" src="{{$product->bg_image}}" product-Id="{{$product->product_id}}" card-style="col-12 col-md-6 col-lg-4 mb-5 mb-md-0"/>
                                @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container ct-pagination">
        {{$products->links()}}
    </div>

@endsection

@section("script")
    <script src="{{'js/addToCart.js'}}"></script>
@endsection
