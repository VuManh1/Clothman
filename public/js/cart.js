$(function () {
    // event click on payment method items
    $(".payment-method-item").click(function () {
        $(".payment-method-item.active").removeClass("active");
        $(this).addClass("active");
    });
});