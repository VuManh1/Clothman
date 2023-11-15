@extends('layouts.admin')
@section('title', 'Create Product')

@section('css')
    
@endsection

@section('content')
    {{-- Modal --}}
    <div class="modal fade" id="colorsModal" tabindex="-1" aria-labelledby="colorsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="colorsModalLabel">Select a color: <span class="modal-color-name"></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="d-flex flex-wrap gap-2">
                            @foreach ($colors as $color)
                                <div class="color-select" style="background-color: {{ $color->hex_code }};" role="button" 
                                    data-colorid="{{ $color->id }}" data-colorname="{{ $color->name }}" data-colorcode="{{ $color->hex_code }}"></div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="onClickColorsModal()">OK</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                        <h2>Create Product</h2>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-md-6">
                    <div class="breadcrumb-wrapper">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.products.index') }}">Products</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Create Product
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- ========== title-wrapper end ========== -->

        <!-- ========== tables-wrapper start ========== -->
        <div class="tables-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.errors')

                    <div class="card-style mb-30">
                        <form action="{{ route('admin.products.store') }}" method="POST" id="create-product-form"
                            enctype="multipart/form-data">
                            @csrf

                            <ul class="nav nav-tabs" id="product-tabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="main-infor-tab" data-bs-toggle="tab"
                                        data-bs-target="#main-infor-tab-pane" type="button" role="tab"
                                        aria-controls="main-infor-tab-pane" aria-selected="true">Main</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="images-tab" data-bs-toggle="tab"
                                        data-bs-target="#images-tab-pane" type="button" role="tab"
                                        aria-controls="images-tab-pane" aria-selected="false">Images</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="variants-tab" data-bs-toggle="tab"
                                        data-bs-target="#variants-tab-pane" type="button" role="tab"
                                        aria-controls="variants-tab-pane" aria-selected="false">Variants</button>
                                </li>
                            </ul>
                            <div class="tab-content py-5" id="myTabContent">
                                <div class="tab-pane fade show active" id="main-infor-tab-pane" role="tabpanel"
                                    aria-labelledby="main-infor-tab" tabindex="0">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="material" class="form-label">Material</label>
                                        <input type="text" class="form-control" id="material" name="material" value="{{ old('material') }}">
                                    </div>
                                    <div class="d-flex gap-2 mb-3">
                                        <div class="form-group">
                                            <label for="price" class="form-label">Price</label>
                                            <input type="number" min="0" class="form-control" id="price" name="price" value="{{ old('price') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="discount" class="form-label">Discount</label>
                                            <input type="number" min="0" class="form-control" id="discount" name="discount" value="0" value="{{ old('discount') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Select category</label>
                                        <select class="mb-3 form-select" name="category_id" id="category_id"
                                            value="{{ old('category_id') }}">
                                            <option selected value="">NULL</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @selected($category->id === old('category_id'))>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="images-tab-pane" role="tabpanel"
                                    aria-labelledby="images-tab" tabindex="0">
                                    <div class="form-group mb-3">
                                        <label for="thumbnail" class="form-label">Attach a thumbnail image: </label>
                                        <input class="form-control" type="file" name="thumbnail" id="thumbnail">
                                    </div>

                                    <div class="form-group">
                                        <label for="size_guild" class="form-label">Attach a size guild image: </label>
                                        <input class="form-control" type="file" name="size_guild" id="size_guild">
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="variants-tab-pane" role="tabpanel"
                                    aria-labelledby="variants-tab" tabindex="0">
                                    <button type="button" class="btn btn-dark mb-3" data-bs-toggle="modal" data-bs-target="#colorsModal">
                                        Add a product color variant
                                    </button>

                                    <div id="colors-container" class="d-flex flex-column gap-3">
                                        
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success">Create</button>
                        </form>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- ========== tables-wrapper end ========== -->
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.20.0/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        let selectedColors = [];
        const colorsModal = new bootstrap.Modal('#colorsModal', {
            keyboard: false
        });

        $().ready(function() {
            // jQuery.validator.setDefaults({
            //     debug: true,
            //     success: "valid"
            // });

            // validate form submit
            $("#create-product-form").validate({
                rules: {
                    "name": {
                        required: true,
                    },
                    "category_id": {
                        required: true
                    },
                    "thumbnail": {
                        required: true,
                        extension: "png|jpg|jpeg|webp"
                    },
                    "size_guild": {
                        extension: "png|jpg|jpeg|webp"
                    },
                    'price': {
                        required: true,
                        digits: true
                    },
                    'discount': {
                        digits: true
                    }
                },
                messages: {
                    "name": {
                        required: "Name không được để trống",
                    },
                    "category_id": {
                        required: "Chưa chọn thể loại"
                    }
                },
                submitHandler: function(form) {
                    // Check if have at least 1 product variant
                    if ($("#colors-container").children().length > 0) {
                        form.submit();
                    } else {
                        toastr.error("Product variants is required!"); 
                    }
                },
                invalidHandler: function(form, validator) {
                    toastr.error("Some information is incorrect or incomplete!"); 
                }
            }).settings.ignore = [];

            // Event click on color select button on modal
            $(".color-select").click(function () {
                $(".color-select.selected").removeClass("selected");
                $(this).addClass("selected");
    
                const colorName = $(this).data("colorname");
                $(".modal-color-name").html(colorName);
            });
        });

        // Event click on OK button of colors modal
        function onClickColorsModal(e) {
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
    </script>
@endsection
