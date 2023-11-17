$(function () {
    $('.cart-item-delete').click(function () {
        const cartItem = $(this).parents('.cart-item');
        const productId = cartItem.data('productid');
        const variantId = cartItem.data('variantid');

        removeCart(productId, variantId, cartItem);
    });
});

function removeCart(productId, variantId, cartItem) {
    $.ajax({
        url: removeCartUrl, 
        data: {
            _token: csrf,
            product_id: productId,
            variant_id: variantId,
        },
        type: "DELETE",
        success(result) {
            toastr.success("Đã xóa sản phẩm khỏi giỏ hàng!");
            $('#total-price').html(result.data.formated_total + 'đ');
            cartItem.remove();
            updateCartQuantityInHeader();
        },
        error(xhr, status, error) {
            toastr.error(xhr.responseJSON.message);
        }
    });
}