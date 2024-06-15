@extends('admin.layouts.master')

@section('title')
    Product Trash
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
                                <li class="breadcrumb-item active">Trash</li>
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="d-flex items-center">
                                <h5 class="card-title mb-0 me-4">{{ $title ?? null }}</h5>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="example"
                                class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th data-ordering="false">ID</th>
                                        <th data-ordering="false">SKU</th>
                                        <th data-ordering="false">Name</th>
                                        <th>Image</th>
                                        <th>Deleted Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->sku }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <img width="80px" src="{{ Storage::url($item->image_thumbnail) }}"
                                                    alt="">
                                            </td>
                                            <td>
                                                <span
                                                    class="badge bg-info-subtle text-danger">{{ $item->deleted_at ?? 'updating' }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a onclick="return confirm('Are you sure?')"
                                                        href="{{ route('admin.products.restore', $item->id) }}"
                                                        class="btn btn-success me-2">Restore</a>
                                                    <form action="{{ route('admin.products.destroy', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="return confirm('Are you sure?')"
                                                            href="" class="btn btn-danger me-2">Destroy</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <a class="btn btn-info" href="{{ route('admin.products.index') }}">Back to list</a>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div>
    </div>
@endsection

@section('style-libs')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="{{ asset('backend/assets/js/pages/datatables.init.js') }}"></script>
@endsection

@section('scripts')
    <script>
        $('#example').DataTable({
            columnDefs: [{
                type: 'date',
                'targets': [3]
            }],
            order: [
                [3, 'desc']
            ],
        });
    </script>
@endsection
