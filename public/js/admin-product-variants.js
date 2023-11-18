const colorsModal = new bootstrap.Modal('#colorsModal', {
    keyboard: false
});
let getColorId = '';

$(function () {
    // Get colors from Api and display to colors modal
    $.get(`${getColorsApiUrl}?limit=100`, function (data, status) {
        if (status === 'success') {
            changeColors(data.data);
        }
    });

    // when search colors input change, call Api to get new colors
    $('#search-colors-input').on('keyup', function () {
        const value = $(this).val();

        if (getColorId) {
            clearTimeout(getColorId);
            getColorId = '';
        }

        getColorId = setTimeout(function () {
            $('#color-select-container').html(`
                <div class="spinner-border text-dark" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            `);

            $.get(`${getColorsApiUrl}?limit=100&q=${value}`, function (data, status) {
                if (status === 'success') {
                    changeColors(data.data);
                }
            });

            getColorId = '';
        }, 1000);
    });
});

function changeColors(colors) {
    let html = '';

    colors.forEach(color => {
        html += `
            <div class="color-select" style="background-color: ${color.hex_code};" role="button" 
                data-colorid="${color.id}" data-colorname="${color.name}" data-colorcode="${color.hex_code}"></div>
        `;
    });

    if (!html) html = "Không có kết quả";

    $('#color-select-container').html(html);

    // Event click on color select button on modal
    $(".color-select").click(function () {
        $(".color-select.selected").removeClass("selected");
        $(this).addClass("selected");

        const colorName = $(this).data("colorname");
        $(".modal-color-name").html(colorName);
    });
}

// Event click on OK button of colors modal
function onClickColorsModal() {
    if ($(".color-select.selected").length === 0) return;

    // Get color infor from selected color button
    const selectingColor = $(".color-select.selected").data("colorid");
    const selectingColorCode = $(".color-select.selected").data("colorcode");
    const selectingColorName = $(".color-select.selected").data("colorname");

    if (selectedColors.includes(selectingColor)) {
        toastr.error("Màu này đã được chọn!");
        return;
    }
    
    selectedColors.push(selectingColor);
    colorsModal.hide();

    // Prepend color variant html
    prependColorVariant(selectingColor, selectingColorName, selectingColorCode);
}

// Event click on remove button of color variants
function onClickRemoveColorVariant() {
    const id = $(this).parents('.color-variant').data("colorid");
    selectedColors = selectedColors.filter(c => c !== id);
    $(this).parents('.color-variant').remove();
}

// Event click on add size button of color variants
function onClickAddSize() {
    const colorId = $(this).parents('.color-variant').data('colorid');
    const sizeInput = $(this).prev('input');
    const size = sizeInput.val();

    if (!size || !size.trim()) {
        toastr.error("Chưa nhập size");
        sizeInput.css('border', '1px solid red');
        return;
    }

    appendSizeToColorVariant(colorId, size);

    sizeInput.css('border', '1px solid black');
    sizeInput.val("");
}

// Prepend color variant to #colors-container
function prependColorVariant(colorId, colorName, colorCode) {
    $('#colors-container').prepend(`
        <div class="color-variant" data-colorid="${colorId}" style="border: 1px solid ${colorCode}; box-shadow: 0 0 8px 0 rgba(0, 0, 0, 0.3);">
            <div style="background-color: ${colorCode};" class="p-3">
            </div>
            
            <input type="text" name="colors[]" value="${colorId}" hidden>
            
            <div class="p-3">
                <h3 class="mb-3">Màu: <strong>${colorName}</strong></h3>

                <button type="button" class="btn btn-danger mb-3 remove-color-btn">
                    Remove
                </button>

                <div class="form-group mb-3">
                    <label class="form-label">Attach images for this color: </label>
                    <input type="file" multiple name="color_images[${colorId}][]" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Quantity: <small>Ignore this if product have sizes</small></label>
                    <td class="p-1"><input type="number" name="color_quantity[${colorId}]" class="form-control" min="0"></td>
                </div>

                <div class="mb-1">Sizes: </div>
                <div class="mb-2 d-flex gap-2">
                    <input type="text" class="px-2 color-input" placeholder="Enter size">
                    <button type="button" class="btn btn-success ml-3 add-size-btn">Add Size</button>    
                </div>
                <div class="row gy-2 sizes-container">

                </div>
            </div>
        </div>
    `);

    $('.remove-color-btn').off('click');
    $('.add-size-btn').off('click');
    $(".color-input").off('keydown');
    
    // Set event click on remove button of new color variant
    $('.remove-color-btn').on('click', onClickRemoveColorVariant);
    $('.add-size-btn').on('click', onClickAddSize);

    // Disable submit form if press enter on color input
    $(".color-input").keydown(function (e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            $(this).next().click();
        }
    });
}

function appendSizeToColorVariant(colorId, size) {
    const sizesContainer = $(`.color-variant[data-colorid="${colorId}"]`).find('.sizes-container');

    sizesContainer.append(`
        <div class="col-lg-3">
            <div class="border">
                <div class="m-2">
                    <table>
                        <tr>
                            <td class="p-1">Size: <strong>${size}</strong></td>
                            <td class="p-1">
                                <div class="form-check checkbox-style">
                                    <input type="checkbox" name="color_sizes[${colorId}][]" value="${size}" class="form-check-input" checked>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">Quantity</td>
                            <td class="p-1"><input type="number" name="color_size_quantity[${colorId}][${size}]" class="form-control" min="0" value="0"></td>
                        </tr>
                    </table>
                </div>
            </div>  
        </div>
    `);
}