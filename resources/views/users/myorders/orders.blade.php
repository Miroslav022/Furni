@extends('Layout')

@section('content')
    <div class="container">
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
                   <td>Processing</td>
               </tr>
           @endforeach
            </tbody>
        </table>
    </div>
@endsection
