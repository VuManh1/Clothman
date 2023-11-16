<div class="cart-item">
    <img src="{{ asset($cart->product->thumbnail_url) }}"
        alt="{{ $cart->product->name }}">

    <div class="cart-item-info">
        <a href="#" class="cart-item-title">{{ $cart->product->name }}</a>
        <div>{{ $cart->productVariant->color->name }} / {{ $cart->productVariant->size }}</div>

        <div class="cart-item-actions">
            <div class="quantity-box">
                <div class="quantity-decrease"><span>-</span></div>
                <input type="number" name="quantity" min="1" max="50" value="{{ $cart->quantity }}"
                    readonly />
                <div class="quantity-increase"><span>+</span></div>
            </div>

            <div class="fw-bold">{{ $cart->getFormatedPrice() }}đ</div>
        </div>
    </div>

    <div class="cart-item-delete">
        <span>&#10005;</span>
    </div>
</div>