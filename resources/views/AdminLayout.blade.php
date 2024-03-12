<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>
        Argon Dashboard - Free Dashboard for Bootstrap 4 by Creative Tim
    </title>
    <!-- Favicon -->
    <link href="{{asset('img/brand/favicon.png')}}" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="{{asset('js/plugins/nucleo/css/nucleo.css')}}" rel="stylesheet"/>
    <link href="{{asset('js/plugins/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet"/>
    <!-- CSS Files -->
    <link href="{{asset('css/argon-dashboard.css?v=1.1.2')}}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>

<body class="">
@include('admin.fixed.nav')
<div class="main-content">
    <!-- Navbar -->
    @include('admin.fixed.upperNav')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
{{--                <div class="row">--}}
{{--                    <div class="col-xl-3 col-lg-6">--}}
{{--                        <div class="card card-stats mb-4 mb-xl-0">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col">--}}
{{--                                        <h5 class="card-title text-uppercase text-muted mb-0">Traffic</h5>--}}
{{--                                        <span class="h2 font-weight-bold mb-0">350,897</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-auto">--}}
{{--                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">--}}
{{--                                            <i class="fas fa-chart-bar"></i>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <p class="mt-3 mb-0 text-muted text-sm">--}}
{{--                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>--}}
{{--                                    <span class="text-nowrap">Since last month</span>--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-3 col-lg-6">--}}
{{--                        <div class="card card-stats mb-4 mb-xl-0">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col">--}}
{{--                                        <h5 class="card-title text-uppercase text-muted mb-0">New users</h5>--}}
{{--                                        <span class="h2 font-weight-bold mb-0">2,356</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-auto">--}}
{{--                                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow">--}}
{{--                                            <i class="fas fa-chart-pie"></i>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <p class="mt-3 mb-0 text-muted text-sm">--}}
{{--                                    <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 3.48%</span>--}}
{{--                                    <span class="text-nowrap">Since last week</span>--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-3 col-lg-6">--}}
{{--                        <div class="card card-stats mb-4 mb-xl-0">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col">--}}
{{--                                        <h5 class="card-title text-uppercase text-muted mb-0">Sales</h5>--}}
{{--                                        <span class="h2 font-weight-bold mb-0">924</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-auto">--}}
{{--                                        <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">--}}
{{--                                            <i class="fas fa-users"></i>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <p class="mt-3 mb-0 text-muted text-sm">--}}
{{--                                    <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>--}}
{{--                                    <span class="text-nowrap">Since yesterday</span>--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-3 col-lg-6">--}}
{{--                        <div class="card card-stats mb-4 mb-xl-0">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col">--}}
{{--                                        <h5 class="card-title text-uppercase text-muted mb-0">Performance</h5>--}}
{{--                                        <span class="h2 font-weight-bold mb-0">49,65%</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-auto">--}}
{{--                                        <div class="icon icon-shape bg-info text-white rounded-circle shadow">--}}
{{--                                            <i class="fas fa-percent"></i>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <p class="mt-3 mb-0 text-muted text-sm">--}}
{{--                                    <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>--}}
{{--                                    <span class="text-nowrap">Since last month</span>--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
    <!-- End Navbar -->
    <!-- Header -->
    @yield('content')

</div>


<script src="{{asset('js/plugins/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<!--   Optional JS   -->
<script src="{{asset('js/plugins/chart.js/dist/Chart.min.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="{{asset('js/toast.js')}}"></script>
<script src="{{asset('js/plugins/chart.js/dist/Chart.extension.js')}}"></script>
<!--   Argon JS   -->
<script src="{{asset('js/argon-dashboard.min.js?v=1.1.2')}}"></script>
<script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>$(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            }
        });
    });</script>
@yield('script')
<script>
    window.TrackJS &&
    TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
    });
</script>
</body>

</html>
