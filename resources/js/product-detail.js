// example data
const product = {
    id: "abc",
    colors: [
        {
            id: "1",
            name: "Đen",
            hexColor: "#000000",
            images: [
                "https://media.coolmate.me/cdn-cgi/image/quality=100/uploads/October2023/com2ST002.1_64_2.jpg",
                "https://media.coolmate.me/cdn-cgi/image/quality=100/uploads/October2023/DT003.2_56.jpg",
                "https://media.coolmate.me/cdn-cgi/image/quality=100/uploads/October2023/DT003.3.jpg",
            ]
        },
        {
            id: "2",
            name: "Trắng",
            hexColor: "#ffffff",
            images: [
                "https://media.coolmate.me/cdn-cgi/image/quality=100/uploads/October2023/DT003.16.jpg",
                "https://media.coolmate.me/cdn-cgi/image/quality=100/uploads/October2023/DT003.17.jpg",
                "https://media.coolmate.me/cdn-cgi/image/quality=100/uploads/October2023/DT003.15.jpg",
            ]
        },
        {
            id: "3",
            name: "Xám đậm",
            hexColor: "#363735",
            images: [
                "https://media.coolmate.me/cdn-cgi/image/quality=100/uploads/October2023/DT003.XD1.1.jpg",
                "https://media.coolmate.me/cdn-cgi/image/quality=100/uploads/October2023/DT003.XD1.2.jpg",
                "https://media.coolmate.me/cdn-cgi/image/quality=100/uploads/October2023/DT003.XD.2.jpg",
            ]
        },
    ]
};

$(function () {
    // event click on select color buttons
    $(".color-select").click(function () {
        resetColorSelect();
        $(this).addClass("selected");

        const colorId = $(this).data("colorid");
        const color = product.colors.find((color) => color.id == colorId);

        if (!color) return;

        changeColorName(color.name);
        changeProductImages(color.id)
    });

    // event click on select size buttons
    $(".size-select").click(function () {
        resetSizeSelect();
        $(this).addClass("selected");

        const size = $(this).data("size");

        changeSizeName(size);
    });

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
    const color = product.colors.find((color) => color.id == colorId);
    let html = "";
    
    color.images.forEach((image, index) => {
        html += `
            <div class="carousel-item ${index === 0 ? "active" : ""} h-100">
                <img
                    src="${image}"
                    class="d-block w-100 h-100 object-fit-cover"
                    alt="..."
                />
            </div>
        `;
    });

    $("#productImageCarousel .carousel-inner").html(html);
}

function changeSizeName(sizeName) {
    $(".size-name").html(sizeName);
}