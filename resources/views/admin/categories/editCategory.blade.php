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
                                <h3 class="mb-0">Edit category</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('categories.update',['category'=>$category->id])}}" method="POST">
                            @method("PATCH")
                            @csrf
                            <h6 class="heading-small text-muted mb-4">Category table</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Category</label>
                                            <input type="text" name="category" id="input-username"
                                                   class="form-control form-control-alternative" value="{{$category->category}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-success">Edit category</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.fixed.footer')
    </div>
@endsection