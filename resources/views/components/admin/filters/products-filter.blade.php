<form class="filter-form mb-2" method="GET" action="{{ $action }}">
    <select name="category" class="p-1 ml-1 select">
        <option disabled selected value>Category</option>
        @foreach ($categories as $category)
            <option value="{{ $category->slug }}">{{ $category->name }}</option>
        @endforeach
    </select>
    <select name="sort" class="p-1 mx-1 select">
        <option disabled selected value>Sort By</option>
        <option value="price.desc">Price</option>
        <option value="sold.desc">Sold</option>
    </select>

    <button type="submit" class="btn btn-dark m-1">Filter</button>
</form>
