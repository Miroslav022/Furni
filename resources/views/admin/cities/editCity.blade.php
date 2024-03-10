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
                                <h3 class="mb-0">Add new city</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('cities.update',['city'=>$city->id])}}" method="POST">
                            @method('PATCH')
                            @csrf
                            <h6 class="heading-small text-muted mb-4">City table</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">City</label>
                                            <input type="text" name="city" id="input-username"
                                                   class="form-control form-control-alternative" value="{{$city->city}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Country</label>
                                            <select class="form-control" name="country">
                                                <option value="0">Select Country</option>
                                                @foreach($countries as $country)
                                                    <option value="{{$country->id}}" {{$city->country_id ==$country->id ? 'selected' : ''}}>{{$country->country}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-success">Edit city</button>
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
