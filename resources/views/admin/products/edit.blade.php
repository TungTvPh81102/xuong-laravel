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
                                <li class="breadcrumb-item active">Update</li>
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
                            <form action="{{ route('admin.products.update', $product->id) }}" class="form-steps"
                                autocomplete="off" enctype="multipart/form-data" method="POST">
                                @csrf
                                @method('PUT')
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
                                                    class="form-control">
                                                    <option value="">--- Choose Catalogue ---</option>
                                                    @foreach ($catalogue as $item)
                                                        <option {{ $product->catalogue_id == $item->id ? 'selected' : '' }}
                                                            value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="gen-info-brand-select">Brand</label>
                                                <select name="brand_id" id="gen-info-brand-select" class="form-control">
                                                    <option value="">--- Choose Brand ---</option>
                                                    @foreach ($brand as $item)
                                                        <option {{ $product->brand_id == $item->id ? 'selected' : '' }}
                                                            value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="gen-info-name-input">Name</label>
                                                <input value="{{ $product->name ?? null }}" name="name" type="text"
                                                    class="form-control" id="gen-info-name-input" placeholder="Enter name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="gen-info-sku-input">SKU</label>
                                                <input value="{{ $product->sku ?? null }}" name="sku" type="text"
                                                    class="form-control" id="gen-info-sku-input" placeholder="Enter SKU">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="gen-info-price-regular-input">Price
                                                    Regular</label>
                                                <input value="{{ $product->price_regular ?? null }}" name="price_regular"
                                                    type="number" class="form-control" id="gen-info-price-regular-input"
                                                    placeholder="Enter price">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="gen-info-price-sale-input">Price Sale</label>
                                                <input value="{{ $product->price_sale ?? null }}" name="price_sale"
                                                    type="number" class="form-control" id="gen-info-price-sale-input"
                                                    placeholder="Enter price">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="gen-info-image-thumbnail-input">Image
                                            Thumbnail</label>
                                        <input name="image_thumbnail" type="file" class="form-control"
                                            id="gen-info-image-thumbnail-input">
                                        <img width="80px" class="mt-2"
                                            src="{{ Storage::url($product->image_thumbnail) }}" alt="">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="gen-info-description-input">Description</label>
                                        <textarea placeholder="Enter description" class="form-control" name="description" id="gen-info-description-input"
                                            cols="30" rows="4">{{ $product->description ?? null }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="gen-info-marterial-input">Material</label>
                                        <textarea placeholder="Enter material" class="form-control" name="marterial" id="gen-info-marterial-input"
                                            cols="30" rows="4">{{ $product->marterial ?? null }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="gen-info-user-manval-input">User Manual</label>
                                        <textarea placeholder="Enter user manual" class="form-control ckeditor-classic" name="user_manval"
                                            id="gen-info-user-manval-input" cols="30" rows="4">{{ $product->user_manval ?? null }}</textarea>
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
                                                    <tbody>
                                                        @foreach ($product->variants as $variant)
                                                            <tr>
                                                                <td>
                                                                    <select
                                                                        name="product_variants[{{ $variant->product_size_id }}-{{ $variant->product_color_id }}][size]"
                                                                        class="form-control size-select">
                                                                        <option value="">Select Size</option>
                                                                        @foreach ($sizes as $id => $name)
                                                                            <option value="{{ $id }}"
                                                                                {{ $variant->product_size_id == $id ? 'selected' : '' }}>
                                                                                {{ $name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select
                                                                        name="product_variants[{{ $variant->product_size_id }}-{{ $variant->product_color_id }}][color]"
                                                                        class="form-control color-select" required>
                                                                        <option value="">Select Color</option>
                                                                        @foreach ($colors as $id => $name)
                                                                            <option value="{{ $id }}"
                                                                                {{ $variant->product_color_id == $id ? 'selected' : '' }}>
                                                                                {{ $name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="number"
                                                                        name="product_variants[{{ $variant->product_size_id }}-{{ $variant->product_color_id }}][quantity]"
                                                                        class="form-control quantity-input"
                                                                        value="{{ $variant->quantity }}" required>
                                                                </td>
                                                                <td>
                                                                    <input type="file"
                                                                        name="product_variants[{{ $variant->product_size_id }}-{{ $variant->product_color_id }}][image]"
                                                                        class="form-control image-input">
                                                                    <img width="80px" class="mt-2"
                                                                        src="{{ Storage::url($variant->image) }}"
                                                                        alt="">
                                                                </td>
                                                                <td>
                                                                    <button type="button"
                                                                        class="btn btn-danger removeRow">Remove</button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->

                                <div class="mb-3 row">
                                    <div class="col-lg-3">
                                        <label for="">Gallery 1</label>
                                        <input type="file" name="product_galleries[]" class="form-control">
                                        @if (isset($galleries[0]))
                                            <img width="80px" class="mt-2"
                                                src="{{ Storage::url($galleries[0]->image) }}" alt="">
                                        @endif
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="">Gallery 2</label>
                                        <input type="file" name="product_galleries[]" class="form-control">
                                        @if (isset($galleries[1]))
                                            <img width="80px" class="mt-2"
                                                src="{{ Storage::url($galleries[1]->image) }}" alt="">
                                        @endif
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="">Gallery 3</label>
                                        <input type="file" name="product_galleries[]" class="form-control">
                                        @if (isset($galleries[2]))
                                            <img width="80px" class="mt-2"
                                                src="{{ Storage::url($galleries[2]->image) }}" alt="">
                                        @endif
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="">Gallery 4</label>
                                        <input type="file" name="product_galleries[]" class="form-control">
                                        @if (isset($galleries[3]))
                                            <img width="80px" class="mt-2"
                                                src="{{ Storage::url($galleries[3]->image) }}" alt="">
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="gen-info-status-input">Tags</label>
                                    <select class="js-example-basic-multiple" name="tags[]" multiple="multiple">
                                        @foreach ($tags as $id => $name)
                                            <option
                                                {{ in_array($id, $product->tags->pluck('id')->toArray()) ? 'selected' : '' }}
                                                value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="gen-info-status-input">Status</label>
                                    <select name="status" class="form-control" id="gen-info-status-input">
                                        <option {{ $product->status === 'draft' ? 'selected' : '' }} value="draft">Draft
                                        </option>
                                        <option {{ $product->status === 'pending' ? 'selected' : '' }} value="pending">
                                            Pending</option>
                                        <option {{ $product->status === 'publish' ? 'selected' : '' }} value="publish">
                                            Publish</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <button type="reset" class="btn btn-dark">Reset</button>
                                    <a class="btn btn-info" href="{{ route('admin.products.index') }}">Back to list</a>
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

        function addNewRow(sizeId = '', colorId = '', quantity = '', image = '') {
            var rowHtml = '<tr>' +
                '<td><select class="form-control size-select">' +
                '<option value="">Select Size</option>';
            $.each(sizes, function(id, name) {
                rowHtml += '<option value="' + id + '" ' + (sizeId == id ? 'selected' : '') + '>' + name +
                    '</option>';
            });
            rowHtml += '</select></td>';

            rowHtml += '<td><select class="form-control color-select">' +
                '<option value="">Select Color</option>';
            $.each(colors, function(id, name) {
                rowHtml += '<option value="' + id + '" ' + (colorId == id ? 'selected' : '') + '>' + name +
                    '</option>';
            });
            rowHtml += '</select></td>';

            rowHtml += '<td><input type="number" class="form-control quantity-input" placeholder="Quantity" value="' +
                quantity + '"></td>';
            rowHtml += '<td><input type="file" class="form-control image-input">' +
                (image ? '<img width="80px" class="mt-2" src="' + image + '" alt="">' : '') + '</td>';
            rowHtml += '<td><button type="button" class="btn btn-danger removeRow">Remove</button></td>';
            rowHtml += '</tr>';

            $('#variant-rows tbody').append(rowHtml);
        }

        $('#addRow').on('click', function() {
            addNewRow();
        });

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
        });

        // Pre-fill the existing rows
        // @foreach ($product->variants as $variant)
        //     addNewRow('{{ $variant->product_size_id }}', '{{ $variant->product_color_id }}', '{{ $variant->quantity }}',
        //         '{{ Storage::url($variant->image) }}');
        // @endforeach
    </script>
@endsection
