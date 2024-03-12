@extends('Layout')

@section('content')
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-6  authBlock">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Edit account</h2>
                        @php $errorsFields = [] @endphp
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
                        @include('includes.success')

                        <form id="registration" action="{{route("edit.user",['id'=>$user->id])}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}" placeholder="Enter first name">
                            </div>
                            <div class="mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}" placeholder="Enter last name">
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" value="{{$user->username}}" placeholder="Choose a username">
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Country</label>
                                <select class="form-select form-control" name="country" id="countries-select" aria-label="Default select example">
                                    <option value="0">Choose your country</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}" {{$country->id===$user->location->city->country->id? 'selected' : ''}}>{{$country->country}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" data-id="{{$user->location->city_id}}" id="cityId">
                            <div class="mb-3">
                                <label for="username" class="form-label">City</label>
                                <select class="form-select form-control" name="city" id="city-select" disabled="disabled">
                                    <option selected>Choose your city</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" value="{{$user->location->address}}" placeholder="Enter your street address">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" name="email" value="{{$user->email}}" placeholder="Enter email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password"  placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section("script")
    <script src="{{asset('js/registration.js')}}"></script>
@endsection
