@foreach ($orders as $order)
    <x-order :order="$order" />
@endforeach