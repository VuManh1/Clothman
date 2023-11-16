$(function () {
    $('#add-to-cart-btn').click(onClickAddToCart);
});

function onClickAddToCart() {
    const sizeSelectBtn = $('.size-select');
    const colorId = $('.color-select.selected').data('colorid');
    const quantity = $('.quantity-box input').val();

    if (sizeSelectBtn.length > 0) {
        const selectedSize = $('.size-select.selected');

        if (selectedSize.length > 0) {
            addToCart(productId, colorId, selectedSize.data('size'), quantity);
        } else {
            toastr.error("Bạn chưa chọn kích thước sản phẩm!");
        }
    } else {
        addToCart(productId, colorId, "NONE", quantity);
    }
}

function addToCart(productId, colorId, size, quantity) {
    $('#add-to-cart-btn').addClass('loading').attr("disabled", true);

    $.ajax({
        url: addToCartUrl, 
        data: {
            _token: csrf,
            product_id: productId,
            color_id: colorId,
            size: size,
            quantity: quantity,
        },
        type: "POST",
        success(result) {
            toastr.success("Đã thêm sản phẩm vào giỏ hàng!");
            $('#add-to-cart-btn').removeClass('loading').attr("disabled", false);
            updateCartQuantityInHeader();
        },
        error(xhr, status, error) {
            toastr.error(xhr.responseJSON.message);
            $('#add-to-cart-btn').removeClass('loading').attr("disabled", false);
        }
    });
}