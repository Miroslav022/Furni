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
                                <h3 class="mb-0">Add Inventory location</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('inventories.update',['inventory'=>$location->id])}}" method="POST">
                            @csrf
                            @method("PATCH")
                            <h6 class="heading-small text-muted mb-4">Location information</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-address">Address</label>
                                            <input id="input-address" value="{{$location->address}}" name="address" class="form-control form-control-alternative" placeholder="Address" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Country</label>
                                            <select class="form-control" name="country" id="countries-select">
                                                <option value="0">Select country</option>
                                                @foreach($countries as $country)
                                                    <option value="{{$country->id}}" {{$location->city->country->id === $country->id ? "selected" : ''}}>{{$country->country}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">City</label>
                                            <select class="form-control" name="city" id="city-select">
                                                @foreach($cities as $city)
                                                    <option value="{{$city->id}}" {{$location->city->id === $city->id ? 'selected' : ''}}>{{$city->city}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-success">Add inventory location</button>
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

@section('script')
    <script src="{{asset("js/registration.js")}}"></script>
@endsection
