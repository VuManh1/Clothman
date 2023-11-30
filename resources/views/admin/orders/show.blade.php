@extends('layouts.admin')
@section('title', 'Manage Order #'.$order->code)

@section('content')
    <div class="modal fade" tabindex="-1" id="edit-order-modal">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('admin.orders.update', [$order->code]) }}" method="POST">
                @method('PATCH')
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Cập nhập đơn hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="p-1 mx-1 form-select">
                            <option value="PENDING" @selected($order->status === 'PENDING')>Pending</option>
                            <option value="PROCESSING" @selected($order->status === 'PROCESSING')>Processing</option>
                            <option value="SHIPPING" @selected($order->status === 'SHIPPING')>Shipping</option>
                            <option value="COMPLETED" @selected($order->status === 'COMPLETED')>Completed</option>
                            <option value="CANCELED" @selected($order->status === 'CANCELED')>Canceled</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="address-edit" class="form-label">Chỉnh sửa địa chỉ?</label>
                        <input type="text" name="address" id="address-edit" value="{{ $order->address }}" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Xác nhận</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>

    <div class="container-fluid my-5">
        <div class="tables-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-style mb-30">
                        <h1 class="title mb-4">
                            Thông tin đơn hàng #{{ $order->code }}
                        </h1>
                        <h4 class="title mb-4">
                            Trạng thái: 
                            @switch($order->status)
                                @case('PENDING')
                                    <span class="fw-bold">{{ $order->status }}</span>
                                    @break
                                @case('PROCESSING')
                                    <span class="fw-bold">{{ $order->status }}</span>
                                    @break
                                @case('SHIPPING')
                                    <span class="fw-bold">{{ $order->status }}</span>
                                    @break
                                @case('COMPLETED')
                                    <span class="fw-bold text-success">{{ $order->status }}</span>
                                    @break
                                @case('CANCELED')
                                    <span class="fw-bold text-danger">{{ $order->status }}</span>
                                    @break
                                @default
                                    
                            @endswitch
                        </h4>
                    
                        <div class="mb-4">
                            <button class="btn btn-primary" @disabled($order->status === 'CANCELED' || $order->status === 'COMPLETED')
                                data-bs-toggle="modal" data-bs-target="#edit-order-modal">
                                Cập nhập đơn hàng
                            </button>
                        </div>
                    
                        <div class="d-flex flex-column gap-3 mb-4">
                            <div class="row">
                                <div class="col col-4 fw-bolder">Ngày đặt hàng: </div>
                                <div class="col col-8">{{ $order->getFormatedCreatedAt() }}</div>
                            </div>
                            <div class="row">
                                <div class="col col-4 fw-bolder">Tên người nhận: </div>
                                <div class="col col-8">{{ $order->customer_name }}</div>
                            </div>
                            <div class="row">
                                <div class="col col-4 fw-bolder">Email: </div>
                                <div class="col col-8">{{ $order->email }}</div>
                            </div>
                            <div class="row">
                                <div class="col col-4 fw-bolder">Số điện thoại: </div>
                                <div class="col col-8">{{ $order->phone_number }}</div>
                            </div>
                            <div class="row">
                                <div class="col col-4 fw-bolder">Địa chỉ giao hàng: </div>
                                <div class="col col-8">{{ $order->address }}</div>
                            </div>
                            <div class="row">
                                <div class="col col-4 fw-bolder">Ghi chú: </div>
                                <div class="col col-8">{{ $order->note ?? "NULL" }}</div>
                            </div>
                            @if ($order->status === 'CANCELED')
                                <div class="row">
                                    <div class="col col-4 fw-bolder">Cancel reason: </div>
                                    <div class="col col-8">{{ $order->cancel_reason ?? "NULL" }}</div>
                                </div>  
                            @endif
                        </div>   

                        <div class="mb-4">
                            <h4 class="title">Thanh toán: </h4>
                            <div class="d-flex flex-column gap-3 ">
                                <div class="row">
                                    <div class="col col-4 fw-bolder">Phương thức thanh toán: </div>
                                    <div class="col col-8">{{ $order->payment->payment_method }}</div>
                                </div>
                                <div class="row">
                                    <div class="col col-4 fw-bolder">Trạng thái: </div>
                                    <div class="col col-8">{{ $order->payment->status }}</div>
                                </div>
                            </div>
                        </div>
                    
                        <h4 class="title">Các sản phẩm: </h4>
                        <div class="d-flex flex-column gap-3 my-3">
                            @foreach ($order->orderItems as $item)
                                <x-order-item :item="$item" />
                            @endforeach
                        </div>
                    
                        <div>Tổng cộng: <span class="fw-bold">{{ $order->getFormatedTotal() }}đ</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const editOrderModal = new bootstrap.Modal('#edit-order-modal', {
            keyboard: false
        });

        $(function () {
            $('#edit-order-modal').submit(function (e) {
                e.preventDefault();

                const url = $(this).attr('action');
                const address = $('#address-edit').val();
                const status  = $('#edit-order-modal select[name="status"]').val();

                $.ajax({
                    url: url,
                    data: {
                        _token: '{{ csrf_token() }}',
                        address,
                        status 
                    },
                    type: "PATCH",
                    success(result) {
                        toastr.success("Đã cập nhập đơn hàng!");
                        location.reload();
                    },
                    error(xhr, status, error) {
                        toastr.error(xhr.responseJSON.message);
                    }
                });

                editOrderModal.hide();
                toastr.info('Đang cập nhập...')
            });
        });
    </script>
@endsection