<div class="order-item">
    <img src="{{ asset($item->product->thumbnail_url) }}" alt="{{ $item->product->name }}">

    <div class="order-item-info">
        <a href="{{ route('product.detail', [$item->product->slug]) }}" class="order-item-title">{{ $item->product->name }}</a>
        <div>{{ $item->productVariant->color->name }} / {{ $item->productVariant->size }}</div>

        <div class="order-item-actions">
            <div>x{{ $item->quantity }}</div>

            <div class="fw-bold">{{ $item->getFormatedPrice() }}đ</div>
        </div>
    </div>
</div>