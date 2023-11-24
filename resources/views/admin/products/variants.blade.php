@extends('layouts.admin')
@section('title', 'Manage Product Variants - '.$product->name)

@section('content')
    {{-- Create size variant modal --}}
    <div class="modal fade" id="createSizeVariantModal" tabindex="-1" aria-labelledby="createSizeVariantModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="{{ route('admin.products.variants.store') }}" data-colorid="">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Create size</h1>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group mb-3">
                            <label class="form-label">Size</label>
                            <input class="form-control me-2" type="text" name="size">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Quantity</label>
                            <input class="form-control me-2" type="number" min="0" value="0" name="quantity">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="">Create</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Delete variant modal --}}
    <x-modals.delete-modal id="delete-variant-modal" title="Delete this variant?"
        body="Are you sure you want to delete this variant?" action="" />

    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                        <h2>Manage Product Variants: {{ $product->name }}</h2>
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
                                    Manage Product Variants
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
                        <h3 class="title mb-3">Variants</h3>

                        <div class="d-flex flex-column gap-3">
                            @foreach ($product->productVariants->unique('color_id') as $variant)
                                <div data-colorid="{{ $variant->color_id }}" class="color-variant"
                                    style="border: 1px solid {{ $variant->color->hex_code }}; box-shadow: 0 0 8px 0 rgba(0, 0, 0, 0.3);">

                                    <div style="background-color: {{ $variant->color->hex_code }};"
                                        class="p-3">
                                    </div>

                                    <div class="p-3">
                                        <h3 class="mb-3">Màu: <strong>{{ $variant->color->name }}</strong>
                                        </h3>

                                        <div class="form-group">
                                            <label class="form-label">Change images for this color: </label>
                                            <input type="file" multiple class="form-control mb-3">
                                            <button type="button" class="btn btn-success change-images-btn">Apply</button>
                                        </div>
                                        <div class="d-flex overflow-auto gap-3 my-3">
                                            @foreach ($product->images->where('color_id', $variant->color_id) as $image)
                                                <img src="{{ asset($image->image_url) }}" alt="img"
                                                    height="150px" width="100px" class="object-fit-cover">
                                            @endforeach
                                        </div>

                                        <hr>
                                        <div class="mt-4">
                                            Sizes:
                                            <button type="button" class="btn btn-success ms-2"
                                                data-colorid="{{ $variant->color_id }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#createSizeVariantModal">Add a size</button>
                                        </div>

                                        <div class="row gy-2 my-3">
                                            @foreach ($product->productVariants->where('color_id', $variant->color_id) as $sizeVariant)
                                                <div class="col-lg-3 size-variant">
                                                    <div class="border">
                                                        <div class="m-2">
                                                            <table>
                                                                <tr>
                                                                    <td class="p-1">Size:
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <strong>{{ $sizeVariant->size }}</strong>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="p-1">Quantity</td>
                                                                    <td class="p-1">
                                                                        <input type="number"
                                                                            class="form-control"
                                                                            min="0"
                                                                            value="{{ $sizeVariant->quantity }}">
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <div class="d-flex gap-2 my-2">
                                                                <button type="button"
                                                                    data-variantid="{{ $sizeVariant->id }}"
                                                                    data-update-url="{{ route('admin.products.variants.quantity.update', [$sizeVariant->id]) }}"
                                                                    class="btn btn-primary btn-sm edit-variant-btn">
                                                                    Update
                                                                </button>
                                                                <button type="button"
                                                                    data-variantid="{{ $sizeVariant->id }}"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete-variant-modal"
                                                                    data-delete-url="{{ route('admin.products.variants.destroy', [$sizeVariant->id]) }}"
                                                                    class="delete-variant-btn btn btn-danger btn-sm">
                                                                    Delete
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
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
    <script>
        const productId = '{{ $product->id }}';
        const updateColorImagesUrl = '{{ route("admin.products.images.update") }}';
        const deleteVariantModal = new bootstrap.Modal('#delete-variant-modal', {
            keyboard: false
        });
        const createSizeModal = new bootstrap.Modal('#createSizeVariantModal', {
            keyboard: false
        });

        $(function () {
            $('.edit-variant-btn').click(function() {
                const url = $(this).data('update-url');
                const quantity = $(this).closest('.size-variant').find('input').val();

                updateVariantQuantity(url, quantity, $(this));
            });

            $('#delete-variant-modal').on('show.bs.modal', function(e) {
                // Button that triggered the modal
                const button = e.relatedTarget;
                const url = $(button).data('delete-url');
                $('#delete-variant-modal form').attr('action', url);
            });

            $('#delete-variant-modal form').on('submit', function(e) {
                e.preventDefault();
                const url = $(this).attr('action');
                const elementToRemove = $(`.delete-variant-btn[data-delete-url='${url}']`).closest('.size-variant');

                deleteVariant(url, elementToRemove);
                deleteVariantModal.hide();
            });

            $('#createSizeVariantModal').on('show.bs.modal', function(e) {
                // Button that triggered the modal
                const button = e.relatedTarget;
                const colorId = $(button).data('colorid');

                $('#createSizeVariantModal form').attr('data-colorid', colorId);
            });

            $('#createSizeVariantModal form').on('submit', function(e) {
                e.preventDefault();
                const url = $(this).attr('action');
                const colorId = $(this).attr('data-colorid');
                const size = $(this).find('input[name="size"]').val();
                const quantity = $(this).find('input[name="quantity"]').val();

                createSizeVariant(url, productId, colorId, size, quantity);
                createSizeModal.hide();
            });

            // Event click on change images button
            $('.change-images-btn').click(function () {
                const files = $(this).prev('input').prop('files');
                const colorId = $(this).closest('.color-variant').data('colorid');

                if (files.length > 0) changeColorImages(updateColorImagesUrl, productId, colorId, files, $(this));
            });
        });

        function createSizeVariant(url, productId, colorId, size, quantity) {
            $.ajax({
                url: url,
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId,
                    color_id: colorId,
                    size,
                    quantity,
                },
                type: "POST",
                success(result) {
                    toastr.success("Thêm biến thể thành công!");
                    location.reload();
                },
                error(xhr, status, error) {
                    toastr.error(xhr.responseJSON.message);
                }
            });
        }

        function changeColorImages(url, productId, colorId, images, button) {
            button.attr("disabled", true);
            const csrf = '{{ csrf_token() }}';

            let formData = new FormData();
            formData.append('_token', csrf);
            formData.append('product_id', productId);
            formData.append('color_id', colorId);

            if (images.length > 0) {
                Array.from(images).forEach(i => {
                    formData.append('images[]', i);
                });
            }

            $.ajax({
                url: url,
                data: formData,
                type: "POST",
                processData: false,
                contentType: false,
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': csrf,
                },
                success(result) {
                    toastr.success("Cập nhập hình ảnh thành công!");
                    location.reload();
                },
                error(xhr, status, error) {
                    button.attr("disabled", false);
                    toastr.error(xhr.responseJSON.message);
                }
            });
        }

        function updateVariantQuantity(url, quantity, button) {
            button.attr("disabled", true);

            $.ajax({
                url: url,
                data: {
                    _token: '{{ csrf_token() }}',
                    quantity: quantity,
                },
                type: "PATCH",
                success(result) {
                    toastr.success("Đã cập nhập số lượng biến thể!");
                    button.attr("disabled", false);
                },
                error(xhr, status, error) {
                    toastr.error(xhr.responseJSON.message);
                    button.attr("disabled", false);
                }
            });
        }

        function deleteVariant(url, elementToRemove) {
            $.ajax({
                url: url,
                data: {
                    _token: '{{ csrf_token() }}',
                },
                type: "DELETE",
                success(result) {
                    toastr.success("Đã xóa biến thể!");
                    elementToRemove.remove();
                },
                error(xhr, status, error) {
                    toastr.error(xhr.responseJSON.message);
                }
            });
        }
    </script>
@endsection