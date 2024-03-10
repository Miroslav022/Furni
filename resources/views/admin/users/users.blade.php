@extends('AdminLayout')

@section('content')
    <div class="container-fluid mt--7">
        <!-- Table -->
        <div class="row">
            <div class="col">
                @include('includes.success')
                <div class="card shadow">
                    <div class="card-header border-0">
                        <h3 class="mb-0">User table</h3>
                    </div>
                    <div class="card-header"><a href="{{route('users.create')}}" class="btn btn-primary text-white">Add user</a></div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First name</th>
                                <th scope="col">Last name</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $index=>$user)
                                <tr>
                                    <td>
                                        <p>{{$index+1}}</p>
                                    </td>
                                    <td>
                                        <p>{{$user->first_name}}</p>
                                    </td>
                                    <td>
                                        <p>{{$user->last_name}}</p>
                                    </td>
                                    <td>
                                        <p>{{$user->username}}</p>
                                    </td>
                                    <td>
                                        <p>{{$user->email}}</p>
                                    </td>
                                    <td>
                                        <p>{{$user->role->role}}</p>
                                    </td>
                                    <td>
                                        <a href="{{route('users.edit',['user'=>$user->id])}}" class="btn btn-warning">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{route('users.destroy',[$user->id])}}" method="POST">
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
                    {{--                    <div class="card-footer py-4">--}}
                    {{--                        {{$roles->links()}}--}}

                    {{--                    </div>--}}
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('admin.fixed.footer')
    </div>
@endsection
