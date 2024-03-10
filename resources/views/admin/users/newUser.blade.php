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
                                <h3 class="mb-0">Add new user</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('users.store')}}" method="POST">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">Users table</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first_name">First name</label>
                                            <input type="text" name="first_name" id="input-username"
                                                   class="form-control form-control-alternative" placeholder="Stefan">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-last_name">Last name</label>
                                            <input type="text" name="last_name" id="input-username"
                                                   class="form-control form-control-alternative" placeholder="Stefanovic">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Username</label>
                                            <input type="text" name="username" id="input-username"
                                                   class="form-control form-control-alternative" placeholder="stefan123">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-email">Email</label>
                                            <input type="text" name="email" id="input-username"
                                                   class="form-control form-control-alternative" placeholder="stefan@gmail.com">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-password">Password</label>
                                            <input type="password" name="password" id="input-username"
                                                   class="form-control form-control-alternative" placeholder="Example: Stefan123!">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-role">Role</label>
                                            <select class="form-control" name="role" id="exampleFormControlSelect1">
                                                <option value="0">Select Role</option>
                                                @foreach($roles as $role)
                                                    <option value="{{$role->id}}">{{$role->role}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <hr class="my-4" />
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Add user location</h3>
                                </div>
                            </div>
                            <h6 class="heading-small text-muted mb-4">Location information</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-address">Address</label>
                                            <input id="input-address" name="address" class="form-control form-control-alternative" placeholder="Home Address" type="text">
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
                                                    <option value="{{$country->id}}">{{$country->country}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">City</label>
                                            <select class="form-control" disabled="disabled" name="city" id="city-select">
                                                <option value="0">Select city</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-success">Add user</button>
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
