@extends('AdminLayout')

@section('content')
    <div class="container-fluid mt--7">
        <!-- Table -->
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                @include('includes.success')
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
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Edit status</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('status.update',['status'=>$status->id])}}" method="POST">
                            @csrf
                            @method("PATCH")
                            <h6 class="heading-small text-muted mb-4">Country table</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Status</label>
                                            <input type="text" name="status" id="input-username"
                                                   class="form-control form-control-alternative" value="{{$status->status}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-success">Edit status</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.fixed.footer')
    </div>
@endsection
