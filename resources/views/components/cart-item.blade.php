<div class="cart-item" data-variantid="{{ $cart->product_variant_id }}" data-productid="{{ $cart->product_id }}">
    <img src="{{ asset($cart->product->thumbnail_url) }}"
        alt="{{ $cart->product->name }}">

    <div class="cart-item-info">
        <a href="{{ route('product.detail', [$cart->product->slug]) }}" class="cart-item-title">{{ $cart->product->name }}</a>
        <div>{{ $cart->productVariant->color->name }} / {{ $cart->productVariant->size }}</div>

        <div class="cart-item-actions">
            <div class="quantity-box loadable-btn">
                <div class="quantity-decrease"><span>-</span></div>
                <div class="loadable-content">
                    <input type="number" min="1" max="50" value="{{ $cart->quantity }}" readonly />
                </div>
                <div class="spinner spinner-border text-dark" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="quantity-increase"><span>+</span></div>
            </div>

            <div class="fw-bold cart-item-price">{{ $cart->getFormatedPrice() }}đ</div>
        </div>
    </div>

    <div class="cart-item-delete">
        <span>&#10005;</span>
    </div>
</div>