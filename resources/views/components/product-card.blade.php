<a href="{{ route('product.detail', [$product->slug]) }}" class="product-item" title="{{ $product->name }}">
    <div class="product-image">
        <img src="{{ asset($product->thumbnail_url) }}" alt="{{ $product->name }}">
    </div>
        
    <div class="product-item-body">
        <h5 class="product-item-title">{{ $product->name }}</h5>

        @if ($product->discount > 0)
            <div class="product-item-price">{{ $product->getFormatedDiscountPrice() }}đ</div>
            <div class="d-flex gap-2 align-items-center">
                <div class="product-item-old-price">{{ $product->getFormatedPrice() }}đ
                </div>
                <div class="product-item-discount">-{{ $product->discount }}%</div>
            </div>
        @else
            <div class="product-item-price">{{ $product->getFormatedPrice() }}đ</div>
        @endif
    </div>
</a>