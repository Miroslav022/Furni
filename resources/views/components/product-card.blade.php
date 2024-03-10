<div class="{{$cardStyle}} product-item">
    <a class="link-product" href="{{route('product.show',[$productId])}}" id="{{$productId}}">
        <img src="{{asset("products/".$src)}}" class="img-fluid product-thumbnail">
        <h3 class="product-title">{{$productName}}</h3>
        <strong class="product-price">${{$price}}</strong>

    </a>
    <div class="icons-block">
        <a href="{{route('product.show',[$productId])}}" class="icon-cross">
			<img src="images/eye.svg" class="img-fluid">
        </a>
        @if(session()->has('user'))
            <a class="icon-cross addToCart" data-id="{{$productId}}">
                <img src="images/cart.svg" class="img-fluid">
            </a>
        @endif
    </div>
</div>

