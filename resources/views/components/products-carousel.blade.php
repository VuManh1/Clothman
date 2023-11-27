<div id="{{ $id }}" class="carousel multi-item-carousel">
    <div class="carousel-inner">
        @foreach ($products as $product)
            <div class="carousel-item">
                <x-product-card :product="$product" />
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#{{ $id }}"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#{{ $id }}"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>