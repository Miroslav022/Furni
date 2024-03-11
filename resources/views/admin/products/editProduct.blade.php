@extends('AdminLayout')

@section('content')
    <div class="container-fluid mt--7">
        <!-- Table -->
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                @include('includes.success')
                @if ($errors->any())
                    @php $errorsFields = $errors->messages() @endphp
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{session('error')}}
                    </div>
                @endif
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Edit product</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{--Products--}}
                        <form action="{{route('products.update',['product'=>$product->id])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method("PATCH")
                            <h6 class="heading-small text-muted mb-4">Product table</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first_name">Product name</label>
                                            <input type="text" name="product_name" id="input-username"
                                                   class="form-control form-control-alternative" value="{{$product->product_name}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-role">Category</label>
{{--                                                    @php dd($product->category->id) @endphp--}}
                                            <select class="form-control" name="category">
                                                {{--                                                <option value="0">Select category</option>--}}
                                                @foreach($categories as $category)

                                                    <option value="{{$category->id}}" {{$product->category->id === $category->id ? 'selected' : ''}}>{{$category->category}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="price">Price</label>
                                            <input type="text" name="price" id="price"
                                                   class="form-control form-control-alternative" value="{{$product->prices->first()->price}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="price">Background image</label>
                                            <input type="file" name="bg_image" >
                                        </div>
                                        <div class="image mb-3">
                                            <img src="{{asset("products/".$product->bg_image)}}" class="img-fluid" alt="">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="price">Product images</label>
                                            <input type="file" name="images[]" multiple >
                                        </div>
                                       <div class="image-wrapper">
{{--                                           @php dd() @endphp--}}
                                           @if(count($product->images)>0)
                                               @foreach($product->images as $image)
                                                   <div class="image mb-3">
                                                       <img src="{{asset("products/".$image->src)}}" class="img-fluid" alt="">
                                                       <button class="btn btn-danger removeImage" data-id="{{$image->id}}">Delete image</button>
                                                   </div>
                                               @endforeach
                                           @else
                                               <div class="alert alert-danger" role="alert">
                                                   There isn't anything to show! Add images
                                               </div>
                                           @endif

                                       </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Description</label>
                                            <textarea class="form-control" name="description"  id="exampleFormControlTextarea1" rows="3">{{$product->description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group ">
                                            <button class="btn btn-success w-100">Edit product</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        {{--Warehouses--}}
                        <form>
                            <hr class="my-4" />

                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Warehouse & quantity</h3>
                                </div>
                            </div>
                            <h6 class="heading-small text-muted mb-4">Warehouse location and qunatity</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group ">
                                            <div class="row align-items-end">
                                                <div class="col-10">
                                                    <label class="form-control-label" for="input-role">Warehouse location</label>
                                                    <select class="form-control" name="inventory" id="inventory">
                                                        @foreach($inventories as $inventory)
                                                            <option value="{{$inventory->id}}">{{$inventory->location->address}}-{{$inventory->location->city->city}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-1">
                                                    <button class="btn btn-success btn-lg addWarehouse" data-id="{{$product->id}}">Add warehouse</button>
                                                </div>
                                            </div>
                                            <div class="prepareToAdd">
                                                <div class="inventory">
                                                    {{--                                        @php dd($product->inventories) @endphp--}}
                                                    @if(count($product->inventories)>0)
                                                        @foreach($product->inventories as $inventory)
                                                            {{--                                            @php dd($product->inventories) @endphp--}}
                                                            <div class="col-lg-12 d-flex align-items-center each-inventory inventory">
                                                                <div class="form-group">
                                                                    <label class="form-control-label" for="qty">{{$inventory->location->address}} - <b>Quantity</b></label>
                                                                    <input type="text" name="quantity" id="qty"
                                                                           class="form-control form-control-alternative" value="{{$inventory->pivot->quantity}}">
                                                                    <input type="hidden" value="{{$inventory->pivot->inventory_id}}" class="inventory_id"/>
                                                                </div>
                                                                <button class="btn btn-danger btn-lg ml-2 remove-inventory" data-id="{{$inventory->pivot->id}}">Delete</button>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="alert alert-danger" role="alert">
                                                            There isn't anything to show! Add warehouse location and insert quantity
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <button class="btn btn-success btn-lg ml-auto d-block add-inventory">Apply changes</button>
                                            <div class="addWarehouses-warpper col-12"></div>
                                        </div>
                                        <hr class="my-4" />

                                    </div>
{{--                                    <div class="inventory">--}}
{{--                                        @php dd($product->inventories) @endphp--}}
{{--                                        @if(count($product->inventories)>0)--}}
{{--                                        @foreach($product->inventories as $inventory)--}}
{{--                                            @php dd($product->inventories) @endphp--}}
{{--                                            <div class="col-lg-12 d-flex align-items-center each-inventory inventory">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label class="form-control-label" for="qty">{{$inventory->location->address}} - <b>Quantity</b></label>--}}
{{--                                                    <input type="text" name="quantity" id="qty"--}}
{{--                                                           class="form-control form-control-alternative" value="{{$inventory->pivot->quantity}}">--}}
{{--                                                    <input type="hidden" value="{{$inventory->pivot->inventory_id}}" class="inventory_id"/>--}}
{{--                                                </div>--}}
{{--                                                <button class="btn btn-danger btn-lg ml-2 remove-inventory" data-id="{{$inventory->pivot->id}}">Delete</button>--}}
{{--                                            </div>--}}
{{--                                        @endforeach--}}
{{--                                        @else--}}
{{--                                            <div class="alert alert-danger" role="alert">--}}
{{--                                                There isn't anything to show! Add warehouse location and insert quantity--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}


                                </div>
                            </div>
                        </form>

                        {{--Materials--}}
                        <form action="{{route('product-materials.store')}}" method="POST">
                            @csrf
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
                                                <input class="form-check-input" name="materials[]" type="checkbox" {{in_array($material->id, $checkedMaterials) ? 'checked' : ''}} value="{{$material->id}}" id="material{{$material->id}}">
                                                <label class="form-check-label" for="material{{$material->id}}">
                                                    {{$material->material}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <input type="hidden" name="product_id" value="{{$product->id}}"/>
                                    <div class="col-lg-12">
                                        <div class="form-group ">
                                            <button class="btn btn-success ml-auto d-block">Edit product materials</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        {{--Specifications--}}
                        <form action="{{route('product-specification.store')}}" method="POST">
                            @csrf
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
                                                <select class="form-control" id="specifications">
                                                    <option value="0">Select specification</option>
                                                    @foreach($specifications as $specification)
                                                        <option value="{{$specification->id}}">{{$specification->specification}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <button class="btn btn-lg btn-success" id="addSpec">Add new specification</button>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 specifications-wrapper">
                                                @foreach($product->specifications as $spec)

                                                    <div class="form-group">
                                                        <div class="row align-items-end">
                                                            <div class="col-4">
{{--                                                                @php dd() @endphp--}}
                                                                <label for="exampleInputEmail1">{{$spec->specification}}</label>
                                                                <input type="text" class="form-control" name="specifications[{{$spec->pivot->specification_id}}][value]" value="{{$spec->pivot->value}}" id="exampleInputEmail1">
                                                                <input type="hidden" class="form-control" name="specifications[{{$spec->pivot->specification_id}}][id]" value="{{$spec->pivot->specification_id}}" id="exampleInputEmail1">
                                                            </div>
                                                            <div class="col-3">
                                                                <button class="btn btn-lg btn-danger remove-spec" data-id="{{$spec->pivot->id}}">Delete specification</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <input type="hidden" name="product_id" value="{{$product->id}}"/>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-success">Apply product specifications</button>
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
    <script src="{{asset("js/products/editProducts.js")}}"></script>
@endsection
