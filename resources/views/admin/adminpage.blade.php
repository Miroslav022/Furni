@extends('AdminLayout')

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                @include('includes.success')
                <div class="card shadow" style="height: 80vh">
                    <div class="card-header border-0">
                        <h3 class="mb-0">User activities</h3>
                    </div>


                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User</th>
                                <th scope="col">Activity</th>
                                <th scope="col">Method</th>
                                <th scope="col">Class</th>
                                <th scope="col">Date</th>

                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($activity) && is_array($activity))
                            @php $index = 1;
                            $numebrOfElements = count($activity)-2;
                            @endphp
                            @for($i =$numebrOfElements; $i>=0; $i--)
                                @php
                                    $logParts = explode('\p', $activity[$i]);
                                    $logPartsToPrint = $logParts[1] ;
                                    $logElements = explode(',', $logPartsToPrint);
                                @endphp
                                <tr>
                                    <td>
                                        <p>{{$index++}}</p>
                                    </td>
                                    <td>
                                        <p>{{$logElements[0]}}</p>
                                    </td>
                                    <td>
                                        <p>{{$logElements[1]}}</p>
                                    </td>
                                    <td>
                                        <p>{{$logElements[2]}}</p>
                                    </td>
                                    <td>
                                        <p>{{$logElements[3]}}</p>
                                    </td>
                                    <td>
                                        <p>{{$logElements[4]}}</p>
                                    </td>
                                </tr>
                            @endfor
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
{{--                        {{$categories->links()}}--}}

                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('admin.fixed.footer')
    </div>
@endsection
