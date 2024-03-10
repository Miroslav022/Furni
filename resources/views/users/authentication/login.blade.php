@extends('Layout')

@section('content')

    <div class="container mt-5">
        <div class="row d-flex justify-content-center authBlock">
            <div class="col-6">
                @if(session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{session()->get('success')}}
                    </div>
                @endif
                    @if(session()->has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{session()->get('error')}}
                        </div>
                    @endif
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Login</h2>
                        <form action="{{route('login.user')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="email" class="form-control" name="email" placeholder="Email address">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                            <p class="mt-3">Don't have an account?<a href="{{route('registration')}}"> Click here for registration.</a></p>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
