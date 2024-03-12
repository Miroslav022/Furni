@extends('Layout')

@section('content')
    <div class="container mt-5 mb-5">
        @if(count($orders))
        <table class="table overflow-scroll">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Date</th>
                <th scope="col">Number of products</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>

                @foreach($orders as $key=>$order)
                    {{--               @php dd($order->orderitems) @endphp--}}
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$order->created_at}}</td>
                        <td>{{count($order->orderitems)}}</td>
                        <td><span class="{{$order->status->status}}">{{$order->status->status}}</span></td>
                    </tr>
                @endforeach



            </tbody>
        </table>
        @else
        <div class="alert alert-danger">
            You don't have any orders yet
        </div>
        @endif

    </div>
@endsection
