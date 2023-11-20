<div class="order-item">
    <img src="{{ asset($item->product->thumbnail_url) }}" alt="{{ $item->product->name }}">

    <div class="order-item-info">
        <a href="#" class="order-item-title">{{ $item->product->name }}</a>
        <div>Đen / 2XL</div>
        <div>{{ $item->productVariant->color->name }} / {{ $item->productVariant->size }}</div>

        <div class="order-item-actions">
            <div>x{{ $item->quantity }}</div>

            <div class="fw-bold">{{ $item->getFormatedPrice() }}đ</div>
        </div>
    </div>
</div>