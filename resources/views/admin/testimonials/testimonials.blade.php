@extends('AdminLayout')

@section('content')
    <div class="container-fluid mt--7">
        <!-- Table -->
        <div class="row">
            <div class="col">
                @include('includes.success')
                <div class="card shadow">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Testimonial table</h3>
                    </div>
                    <div class="card-header"><a href="{{route('testimonials.create')}}" class="btn btn-primary text-white">Add testimonial</a></div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Position</th>
                                <th scope="col">Testimonial</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($testimonials as $index=>$testimonial)
                                <tr>
                                    <td>
                                        <p>{{$index+1}}</p>
                                    </td>
                                    <td>
                                        <p>{{$testimonial->name}}</p>
                                    </td>
                                    <td>
                                        <p>{{$testimonial->function}}</p>
                                    </td>
                                    <td>
                                        <p>{{$testimonial->testimonial}}</p>
                                    </td>
                                    <td>
                                        <a href="{{route('testimonials.edit',['testimonial'=>$testimonial->id])}}" class="btn btn-warning">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{route('testimonials.destroy',[$testimonial->id])}}" method="POST">
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
                        {{$testimonials->links()}}

                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
       @include('admin.fixed.footer')
    </div>
@endsection
