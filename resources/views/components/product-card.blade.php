<a href="{{ route('product.detail', [$product->slug]) }}" class="card product-item">
    <img src="{{ $product->thumbnail_url }}"
        class="card-img-top product-image" alt="...">
        
    <div class="card-body">
        <h5 class="card-title">{{ $product->name }}</h5>

        <div class="card-text d-flex gap-2 align-items-center flex-wrap">
            @if ($product->discount > 0)
                <div class="text-black fw-medium">{{ $product->getFormatedDiscountPrice() }}đ</div>
                <div class="d-flex gap-2 align-items-center">
                    <div class="text-secondary text-decoration-line-through fw-medium">{{ $product->getFormatedPrice() }}đ
                    </div>
                    <div class="text-danger fw-medium">-{{ $product->discount }}%</div>
                </div>
            @else
                <div class="text-black fw-medium">{{ $product->getFormatedPrice() }}đ</div>
            @endif
        </div>
    </div>
</a>