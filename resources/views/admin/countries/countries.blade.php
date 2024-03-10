@extends('AdminLayout')

@section('content')
    <div class="container-fluid mt--7">
        <!-- Table -->
        <div class="row">
            <div class="col">
                @include('includes.success')
                <div class="card shadow">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Country tables</h3>
                    </div>
                    <div class="card-header"><a href="{{route('countries.create')}}" class="btn btn-primary text-white">Add country</a></div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Country</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($countries as $index=>$country)
                                <tr>
                                    <td>
                                        <p>{{$index+1}}</p>
                                    </td>
                                    <td>
                                        <p>{{$country->country}}</p>
                                    </td>
                                    <td>
                                        <a href="{{route('countries.edit',['country'=>$country->id])}}" class="btn btn-warning">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{route('countries.destroy',[$country->id])}}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        {{$countries->links()}}

                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
       @include('admin.fixed.footer')
    </div>
@endsection
