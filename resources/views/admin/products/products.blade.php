@extends('AdminLayout')

@section('content')
    <div class="container-fluid mt--7">
        <!-- Table -->
        <div class="row">
            <div class="col">
                @include('includes.success')
                <div class="card shadow">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Card tables</h3>
                    </div>
                    <div class="card-header"><a href="{{route('products.create')}}" class="btn btn-primary text-white">Add product</a></div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Price</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
{{--                            @php dd($products) @endphp--}}
                            @foreach($products as $index=>$product)
                                <tr>
                                    <td>
                                        <p>{{$index+1}}</p>
                                    </td>
                                    <td>
                                        <p>{{$product->product_name}}</p>
                                    </td>
                                    <td>
                                        <p>{{$product->category->category}}</p>
                                    </td>
                                    <td>
                                        <p>${{$product->prices->first()->price}}</p>
                                    </td>

                                    <td>
                                        <a href="{{route('products.edit',['product'=>$product->id])}}" class="btn btn-warning">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{route('products.destroy',[$product->id])}}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        {{$products->links()}}

                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('admin.fixed.footer')
    </div>
@endsection
