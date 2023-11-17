$(function () {
    $('.quantity-box input').on('change', function () {
        const cartItem = $(this).parents('.cart-item');
        const productId = cartItem.data('productid');
        const variantId = cartItem.data('variantid');
        const quantity = $(this).val();
        
        updateCart(productId, variantId, quantity, cartItem);
    });
});

function updateCart(productId, variantId, quantity, cartItem) {
    const quantityBox = $(cartItem).find('.quantity-box');
    quantityBox.addClass('loading').attr("disabled", true);

    $.ajax({
        url: updateCartUrl, 
        data: {
            _token: csrf,
            product_id: productId,
            variant_id: variantId,
            quantity: quantity,
        },
        type: "PATCH",
        success(result) {
            toastr.success("Đã cập nhập giỏ hàng!");
            $('#total-price').html(result.data.formated_total + 'đ');

            const item = result.data.items.find(i => i.product_id === productId && i.product_variant_id === variantId);

            if (item) {
                $(cartItem).find('.cart-item-price').html(item.formated_price + 'đ');
            }

            quantityBox.removeClass('loading').attr("disabled", false);
        },
        error(xhr, status, error) {
            toastr.error(xhr.responseJSON.message);
            quantityBox.removeClass('loading').attr("disabled", false);
        }
    });
}