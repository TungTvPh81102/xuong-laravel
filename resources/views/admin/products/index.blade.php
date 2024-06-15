@extends('admin.layouts.master')

@section('title')
    Product List
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
                                <li class="breadcrumb-item active">List</li>
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
                                @if ($trash)
                                    <a href="{{ route('admin.products.trash') }}" class="">
                                        <i class="las la-trash-alt btn btn-danger"></i>
                                    </a>
                                @endif
                            </div>
                            <a class="btn btn-primary" href="{{ route('admin.products.create') }}">Create</a>
                        </div>
                        <div class="card-body">
                            <table id="example"
                                class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th data-ordering="false">ID</th>
                                        <th data-ordering="false">Name</th>
                                        <th data-ordering="false">Sku</th>
                                        <th data-ordering="false">Catalogue</th>
                                        <th>Brand</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Create Date</th>
                                        <th>Update Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->sku }}</td>
                                            <td>{{ $item->catalogue->name }}</td>
                                            <td>{{ $item->brand->name }}</td>
                                            <td>
                                                {!! $item->status
                                                    ? '<span class="badge bg-success">Publish</span>'
                                                    : '<span class="badge bg-danger">Draft</span>' !!}</td>
                                            </td>
                                            <td>
                                                <img width="80px" src="{{ Storage::url($item->image_thumbnail) }}"
                                                    alt="{{ $item->name }}">
                                            </td>
                                            <td>
                                                {{ $item->created_at ?? 'Updating' }}
                                            </td>
                                            <td>
                                                {{ $item->updated_at ?? 'Updating' }}
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a class="btn btn-info me-2" href="">Show</a>
                                                    <a class="btn btn-warning me-2" href="{{ route('admin.products.edit', $item->id) }}">Edit</a>
                                                    <form action="{{ route('admin.products.delete', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button onclick="return confirm('Are you sure?')" type="submit"
                                                            class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
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