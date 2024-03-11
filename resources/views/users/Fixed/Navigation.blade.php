<?php
$name = Route::currentRouteName();
?>


<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}">Furni</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                @foreach($data['menu'] as $m)
                    <li class="nav-item {{$m['route']===$name ? 'active' : ''}}">
                        <a class="nav-link" href="{{route($m['route'])}}">{{$m['name']}}</a>
                    </li>
                @endforeach
            </ul>

            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5 ">
                @if(!session()->has("user"))
                    <li><a class="nav-link" href="{{route('login')}}"><img src="{{asset('images/user.svg')}}"></a></li>
                @else
                    @php $user = session()->get('user') @endphp
                    @if($user->role_id===1)
                        <li><a class="nav-link text-light font-weight-bold" href="{{route('adminpage')}}">Adminpanel</a></li>
                    @endif
                    <li><a class="nav-link text-light" href="{{route('home')}}">Edit account</a></li>
                    <li><a class="nav-link text-light" href="{{route('orders')}}">My orders</a></li>
                    <li><a class="nav-link text-light" href="{{route('logout')}}">Logout</a></li>
                    <li><a class="nav-link" href="{{route('cart.index')}}"><img src="{{asset('images/cart.svg')}}"></a></li>
                @endif

            </ul>
        </div>
    </div>

</nav>
