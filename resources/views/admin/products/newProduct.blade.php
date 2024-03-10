@extends('AdminLayout')

@section('content')
    <div class="container-fluid mt--7">
        <!-- Table -->
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                @include('includes.success')
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Add new product</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">Product table</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first_name">Product name</label>
                                            <input type="text" name="product_name" id="input-username"
                                                   class="form-control form-control-alternative" placeholder="Stefan">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-role">Category</label>
                                            <select class="form-control" name="category">
{{--                                                <option value="0">Select category</option>--}}
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->category}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-role">Warehouse location</label>
                                            <select class="form-control" name="inventory" id="exampleFormControlSelect1">
                                                <option value="0">Select store location</option>
                                                @foreach($inventories as $inventory)
                                                    <option value="{{$inventory->id}}">{{$inventory->location->address}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="qty">Quantity</label>
                                            <input type="text" name="quantity" id="qty"
                                                   class="form-control form-control-alternative" placeholder="50">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="price">Price</label>
                                            <input type="text" name="price" id="price"
                                                   class="form-control form-control-alternative" placeholder="$200">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="price">Background image</label>
                                            <input type="file" name="bg_image" >
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="price">Product images</label>
                                            <input type="file" name="images[]" multiple >
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Description</label>
                                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <hr class="my-4" />
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Materials</h3>
                                </div>
                            </div>
                            <h6 class="heading-small text-muted mb-4">Select product material</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-12 material-grid">
                                        @foreach($materials as $material)
                                            <div class="form-group">
                                                <input class="form-check-input" name="materials[]" type="checkbox" value="{{$material->id}}" id="material{{$material->id}}">
                                                <label class="form-check-label" for="material{{$material->id}}">
                                                    {{$material->material}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4" />

                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Specifications</h3>
                                </div>
                            </div>
                            <h6 class="heading-small text-muted mb-4">Select product specification</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row align-items-end">
                                            <div class="col-4">
                                                <label class="form-control-label" for="input-role">Specifications</label>
                                                <select class="form-control" name="specification" id="specifications">
                                                    <option value="0">Select specification</option>
                                                    @foreach($specifications as $specification)
                                                        <option value="{{$specification->id}}">{{$specification->specification}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <button class="btn btn-lg btn-primary" id="addSpec">Add specification</button>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 specifications-wrapper">

                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button class="btn btn-success">Add product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.fixed.footer')
    </div>
@endsection

@section('script')
    <script src="{{asset("js/specifications.js")}}"></script>
@endsection
