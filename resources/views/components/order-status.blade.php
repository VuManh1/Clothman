@switch($status)
    @case('PENDING')
        <span class="fw-bold">Đang chờ xác nhận</span>
        @break
    @case('PROCESSING')
        <span class="fw-bold">Đang xử lý</span>
        @break
    @case('SHIPPING')
        <span class="fw-bold">Đang giao hàng</span>
        @break
    @case('COMPLETED')
        <span class="fw-bold text-success">Đã hoàn tất</span>
        @break
    @case('CANCELED')
        <span class="fw-bold text-danger">Đã hủy</span>
        @break
    @default
        
@endswitch