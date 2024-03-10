@extends('AdminLayout')

@section('content')
    <div class="container-fluid mt--7">
        <!-- Table -->
        <div class="row">
            <div class="col">
                @include('includes.success')
                <div class="card shadow">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Inventories table</h3>
                    </div>
                    <div class="card-header"><a href="{{route('inventories.create')}}" class="btn btn-primary text-white">Add inventory</a></div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Address</th>
                                <th scope="col">City</th>
                                <th scope="col">Country</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($inventories as $index=>$inventory)
                                <tr>
                                    <td>
                                        <p>{{$index+1}}</p>
                                    </td>
                                    <td>
                                        <p>{{$inventory->location->address}}</p>
                                    </td>
                                    <td>
                                        <p>{{$inventory->location->city->city}}</p>
                                    </td>
                                    <td>
                                        <p>{{$inventory->location->city->country->country}}</p>
                                    </td>
                                    <td>
                                        <a href="{{route('inventories.edit',['inventory'=>$inventory->location->id])}}" class="btn btn-warning">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{route('inventories.destroy',[$inventory->id])}}" method="POST">
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
                        {{$inventories->links()}}

                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('admin.fixed.footer')
    </div>
@endsection
