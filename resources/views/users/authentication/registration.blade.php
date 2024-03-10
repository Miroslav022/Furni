@extends('Layout')

@section('content')
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-6  authBlock">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Register</h2>
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


                        <form id="registration" action="{{route("user.registration")}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" name="first_name" value="{{isset($errorsFields['first_name']) ?  '' : old('first_name')}}" placeholder="Enter first name">
                            </div>
                            <div class="mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="last_name" value="{{isset($errorsFields['last_name']) ?  '' : old('last_name')}}" placeholder="Enter last name">
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" value="{{isset($errorsFields['username']) ?  '' : old('username')}}" placeholder="Choose a username">
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Country</label>
                                <select class="form-select form-control" name="country" id="countries-select" aria-label="Default select example">
                                    <option value="0">Choose your country</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->country}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">City</label>
                                <select class="form-select form-control" name="city" id="city-select" disabled="disabled">
                                    <option selected>Choose your city</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" value="{{isset($errorsFields['address']) ?  '' : old('address')}}" placeholder="Enter your street address">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" name="email" value="{{isset($errorsFields['email']) ?  '' : old('email')}}" placeholder="Enter email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" value="{{isset($errorsFields['password']) ?  '' : old('password')}}" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                            <p class="mt-3">Already a member? <a href="{{route('login')}}">Login</a></p>
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
