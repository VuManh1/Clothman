$(function () {
    $('.quantity-decrease').on('click', function(e) {
        const box = $(e.target).closest('.quantity-box');

        if (box.attr('disabled')) return;

        const input = box.find('input');
        const oldValue = input.val();

        input[0].stepDown(1);

        const newValue = input.val();

        if (newValue !== oldValue) input.trigger("change");
    });

    $('.quantity-increase').on('click', function(e) {
        const box = $(e.target).closest('.quantity-box');

        if (box.attr('disabled')) return;

        const input = box.find('input');
        const oldValue = input.val();

        input[0].stepUp(1);

        const newValue = input.val();

        if (newValue !== oldValue) input.trigger("change");
    });
});