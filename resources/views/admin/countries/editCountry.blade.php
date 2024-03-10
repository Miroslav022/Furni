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
                                <h3 class="mb-0">Edit country</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('countries.update',['country'=>$country->id])}}" method="POST">
                            @csrf
                            @method("PATCH")
                            <h6 class="heading-small text-muted mb-4">Country table</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Country</label>
                                            <input type="text" name="country" id="input-username"
                                                   class="form-control form-control-alternative" value="{{$country->country}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-success">Edit country</button>
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
