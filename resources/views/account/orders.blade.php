@extends('layouts.account')
@section('title', 'Đơn hàng của bạn')

@section('account-content')
    <h1 class="title mb-3">Lịch sử đơn hàng</h1>
    <div class="mb-3 fs-5 text-secondary">Đơn hàng của bạn</div>

    <div class="d-flex flex-column gap-3 mb-3" id="orders-container">
        @forelse ($orders as $order)
            <x-order :order="$order" />
        @empty
            <div class="w-auto mx-auto fw-bold">Bạn chưa có đơn hàng nào...</div>
        @endforelse
    </div>

    @if ($orders->hasMorePages())
        <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-dark loadable-btn w-100" id="load-more-orders-btn" style="max-width: 400px;">
                <div class="loadable-content">
                    Tải thêm...
                </div>
                <div class="spinner spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </button>
        </div>
    @endif
@endsection

@section('scripts')
    <script>
        const fetchOrdersUrl = '{{ route("account.orders.more") }}';
        let currentPage = 1;
        const lastPage = {{ $orders->lastPage() }};

        $(function() {
            $("#load-more-orders-btn").click(function() {
                const button = $(this);
                button.addClass('loading').attr('disabled', true);

                currentPage += 1;

                $.get(`${fetchOrdersUrl}?page=${currentPage}`, function(data, status) {
                    if (status === 'success') {
                        $('#orders-container').append(data);
                    }

                    button.removeClass('loading').attr('disabled', false);

                    if (currentPage >= lastPage) button.remove();
                });
            });
        });
    </script>
@endsection
