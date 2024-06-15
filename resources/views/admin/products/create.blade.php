@extends('admin.layouts.master')

@section('title')
    Product Create
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{ $title ?? null }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $title ?? null }}</a></li>
                                <li class="breadcrumb-item active">Create</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            {{-- <div class="alert alert-danger" role="alert">
                This is <strong>Datatable</strong> page in wihch we have used <b>jQuery</b> with cnd link!
            </div> --}}

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">{{ $title ?? null }}</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <form action="{{ route('admin.products.store') }}" class="form-steps" autocomplete="off"
                                enctype="multipart/form-data" method="POST">
                                @csrf
                                <div>
                                    <div class="mb-4">
                                        <div>
                                            <h5 class="mb-1">Product Information</h5>
                                            <p class="text-muted">Fill all Information as below</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="gen-info-catalogue-select">Catalogue</label>
                                                <select name="catalogue_id" id="gen-info-catalogue-select"
                                                    class="form-control" required>
                                                    <option value="">--- Choose Catalogue ---</option>
                                                    @foreach ($catalogue as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="gen-info-brand-select">Brand</label>
                                                <select name="brand_id" id="gen-info-brand-select" class="form-control"
                                                    required>
                                                    <option value="">--- Choose Brand ---</option>
                                                    @foreach ($brand as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="gen-info-name-input">Name</label>
                                                <input name="name" type="text" class="form-control"
                                                    id="gen-info-name-input" placeholder="Enter name" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="gen-info-sku-input">SKU</label>
                                                <input value="{{ strtoupper(Str::random(8)) }}" name="sku"
                                                    type="text" class="form-control" id="gen-info-sku-input"
                                                    placeholder="Enter SKU" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="gen-info-price-regular-input">Price
                                                    Regular</label>
                                                <input value="0" name="price_regular" type="number"
                                                    class="form-control" id="gen-info-price-regular-input"
                                                    placeholder="Enter price" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="gen-info-price-sale-input">Price Sale</label>
                                                <input value="0" name="price_sale" type="number" class="form-control"
                                                    id="gen-info-price-sale-input" placeholder="Enter price" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="gen-info-image-thumbnail-input">Image
                                            Thumbnail</label>
                                        <input name="image_thumbnail" type="file" class="form-control"
                                            id="gen-info-image-thumbnail-input" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="gen-info-description-input">Description</label>
                                        <textarea placeholder="Enter description" class="form-control" name="description" id="gen-info-description-input"
                                            cols="30" rows="4" required></textarea>
                                        <div class="invalid-feedback">Please enter description</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="gen-info-marterial-input">Material</label>
                                        <textarea placeholder="Enter material" class="form-control" name="marterial" id="gen-info-marterial-input"
                                            cols="30" rows="4" required></textarea>
                                        <div class="invalid-feedback">Please enter material</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="gen-info-user-manval-input">User Manual</label>
                                        <textarea placeholder="Enter user manual" class="form-control ckeditor-classic" name="user_manval"
                                            id="gen-info-user-manval-input" cols="30" rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header d-flex align-items-center">
                                                <h5 class="card-title mb-0 flex-grow-1">Product Variant</h5>
                                                <div>
                                                    <div id="addRow" class="btn btn-primary">Add New Row</div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <table id="variant-rows" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Size</th>
                                                            <th>Color</th>
                                                            <th>Quantity</th>
                                                            <th>Image</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->

                                <div class="mb-3 row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Gallery</h4>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="addImageGallery()">Add Gallery</button>
                                            </div><!-- end card header -->
                                            <div class="card-body">
                                                <div class="live-preview">
                                                    <div class="row gy-4" id="gallery_list">
                                                        <div class="col-md-4" id="gallery_default_item">
                                                            <label for="gallery_default" class="form-label">Image</label>
                                                            <div class="d-flex">
                                                                <input type="file" class="form-control"
                                                                    name="product_galleries[]" id="gallery_default">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="gen-info-status-input">Tags</label>
                                        <select class="js-example-basic-multiple" name="tags[]" multiple="multiple">
                                            @foreach ($tags as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="gen-info-status-input">Status</label>
                                        <select name="status" class="form-control" id="gen-info-status-input">
                                            <option value="draft">Draft</option>
                                            <option value="pending">Pending</option>
                                            <option value="publish">Publish</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Create</button>
                                        <button type="reset" class="btn btn-dark">Reset</button>
                                        <a class="btn btn-info" href="{{ route('admin.products.index') }}">Back to
                                            list</a>
                                    </div>
                            </form>
                        </div>

                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
    </div>
    </div>
@endsection

@section('style-libs')
    <!-- ckeditor -->
    <link rel="stylesheet"
        href="{{ asset('backend/assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('backend/assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>

    <script src="{{ asset('backend/assets/js/pages/select2.init.js') }}"></script>
@endsection

@section('scripts')
    <script>
        var sizes = @json($sizes);
        var colors = @json($colors);

        console.log(sizes, colors);

        function addNewRow() {
            var rowHtml = '<tr>' +
                '<td><select class="form-control size-select">' +
                '<option value="">Select Size</option>';
            $.each(sizes, function(id, name) {
                rowHtml += '<option value="' + id + '">' + name + '</option>';
            });
            rowHtml += '</select></td>';

            rowHtml += '<td><select class="form-control color-select">' +
                '<option value="">Select Color</option>';
            $.each(colors, function(id, name) {
                rowHtml += '<option value="' + id + '">' + name + '</option>';
            });
            rowHtml += '</select></td>';

            rowHtml += '<td><input type="number" class="form-control quantity-input" placeholder="Quantity"></td>';
            rowHtml += '<td><input type="file" class="form-control image-input"></td>';
            rowHtml += '<td><button type="button" class="btn btn-danger removeRow">Remove</button></td>';
            rowHtml += '</tr>';

            // Append the new row to the table body
            $('#variant-rows tbody').append(rowHtml);
        }

        // Add event listener to the 'Add New Row' button
        $('#addRow').on('click', function() {
            addNewRow();
        });

        // Event delegation for removing row
        $('#variant-rows tbody').on('click', '.removeRow', function() {
            $(this).closest('tr').remove();
        });

        $('#variant-rows tbody').on('change', '.size-select, .color-select', function() {
            var row = $(this).closest('tr');
            var sizeId = row.find('.size-select').val();
            var colorId = row.find('.color-select').val();
            var quantityInput = row.find('.quantity-input');
            var imageInput = row.find('.image-input');

            if (sizeId && colorId) {
                quantityInput.attr('name', 'product_variants[' + sizeId + '-' + colorId + '][quantity]');
                imageInput.attr('name', 'product_variants[' + sizeId + '-' + colorId + '][image]');
            } else {
                quantityInput.removeAttr('name');
                imageInput.removeAttr('name');
            }

            console.log(sizeId, colorId);
        });

        function addImageGallery() {
            let id = 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();
            let html = `
                <div class="col-md-4" id="${id}_item">
                    <label for="${id}" class="form-label">Image</label>
                    <div class="d-flex">
                        <input type="file" class="form-control" name="product_galleries[]" id="${id}">
                        <button type="button" class="btn btn-danger" onclick="removeImageGallery('${id}_item')">
                            <span class="bx bx-trash"></span>
                        </button>
                    </div>
                </div>
            `;

            $('#gallery_list').append(html);
        }

        function removeImageGallery(id) {
            if (confirm('Chắc chắn xóa không?')) {
                $('#' + id).remove();
            }
        }
    </script>
@endsection
