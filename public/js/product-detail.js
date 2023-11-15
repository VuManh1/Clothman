$(function () {
    // event click on select color buttons
    $(".color-select").click(function () {
        resetColorSelect();
        $(this).addClass("selected");

        const colorId = $(this).data("colorid");
        const variant = variants.find((v) => v.color_id === colorId);

        if (!variant) return;

        changeColorName(variant.color.name);
        changeProductImages(colorId);
        changeColorSizes(variant.color.id);
    });

    $('.color-select.selected').click();

    // collapse events
    $(".collapse").on("show.bs.collapse", function () {
        $(this).siblings(".collapse-title").addClass("active");
    });

    $(".collapse").on("hide.bs.collapse", function () {
        $(this).siblings(".collapse-title").removeClass("active");
    });

    // related products carousel
    new MultiItemCarousel("#relatedProductsCarousel");
});

function resetColorSelect() {
    $(".color-select.selected").removeClass("selected");
}

function resetSizeSelect() {
    $(".size-select.selected").removeClass("selected");
}

function changeColorName(colorName) {
    $(".color-name").html(colorName);
}

function changeProductImages(colorId) {
    const imagesToChange = images.filter(i => i.color_id === colorId);
    let html = "";
    
    imagesToChange.forEach((image, index) => {
        html += `
            <div class="carousel-item ${index === 0 ? "active" : ""} h-100">
                <img
                    src="${domain}${image.image_url}"
                    class="d-block w-100 h-100 object-fit-cover"
                    alt="..."
                />
            </div>
        `;
    });

    $("#productImageCarousel .carousel-inner").html(html);
}

function changeColorSizes(colorId) {
    const variantsToChange = variants.filter(v => v.color_id === colorId);

    let html = "";
    
    variantsToChange.forEach((variant) => {
        let text = "";

        if (variant.size !== "NONE") {
            if (variant.quantity > 0) {
                text = `<div data-size="${variant.size}" class="size-select">${variant.size}</div>`;
            } else {
                text = `<div data-size="${variant.size}" class="size-select disabled">${variant.size}</div>`;
            }
        }

        html += text;
    });

    $(".sizes-container").html(html);

    $(".size-select").click(function () {
        if ($(this).hasClass('disabled')) return;

        resetSizeSelect();
        $(this).addClass("selected");

        const size = $(this).data("size");

        changeSizeName(size);
    });

    changeSizeName("");
}

function changeSizeName(sizeName) {
    $(".size-name").html(sizeName);
}