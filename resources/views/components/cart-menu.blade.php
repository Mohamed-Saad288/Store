<div class="cart-items">
    <a href="javascript:void(0)" class="main-btn">
        <i class="lni lni-cart"></i>
        <span class="total-items">{{ $items->count() }}</span>
    </a>
    <!-- Shopping Item -->
    <div class="shopping-item">
        <div class="dropdown-cart-header">
            <span>{{ $items->count() }} Items</span>
            <a href="{{ route('cart.index') }}">View Cart</a>
        </div>
        <ul class="shopping-list">
            @foreach($items as $item)
            <li>
                <a href="javascript:void(0)" class="remove remove-item" data-id="{{$item->id}}" title="Remove this item"><i
                        class="lni lni-close"></i></a>
                <div class="cart-img-head">
                    <a class="cart-img" href="{{ route('products.show',$item->product->slug) }}"><img
                            src="{{ $item->product->image_url }}" alt="#"></a>
                </div>
                <div class="content">
                    <h4><a href="">{{ $item->product->name }}</a></h4>
                    <p class="quantity">{{ $item->quantity }}<span class="amount">{{ Currency::format($item->product->price )}}</span></p>
                </div>
            </li>
            @endforeach
        </ul>
        <div class="bottom">
            <div class="total">
                <span>Total</span>
                <span class="total-amount">{{ Currency::format($total) }}</span>
            </div>
            <div class="button">
                <a href="{{ route('checkout') }}" class="btn animate">Checkout</a>
            </div>
        </div>
    </div>
    <!--/ End Shopping Item -->
</div>

@push('scripts')
    <script>
        const csrf_token="{{csrf_token()}}";
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{--        <script src="{{asset('/js/cart.js')}}"></script>--}}
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/js/cart.js'])
@endpush

