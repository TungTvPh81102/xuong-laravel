@extends('admin.layouts.master')

@section('title')
    Brand List
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
                                <li class="breadcrumb-item active">Show</li>
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
                            <h5 class="card-title mb-0">{{ $title ?? null }}</h5>
                            <a class="btn btn-primary" href="{{ route('admin.brands.create') }}">Create</a>
                        </div>
                        <div class="card-body">
                            <table id="example"
                                class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th data-ordering="false">Key</th>
                                        <th data-ordering="false">Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($silder->toArray() as $key => $value)
                                        @if ($key == 'deleted_at')
                                            @continue
                                        @endif
                                        <tr>
                                            <td>{{ $key }}</td>
                                            <td>
                                                @switch($key)
                                                    @case('image')
                                                        <img width="70px" src="{{ Storage::url($value) }}" alt="">
                                                    @break

                                                    @case('status')
                                                        {!! $value 
                                                            ? '<span class="badge bg-success">Active</span>'
                                                            : '<span class="badge bg-danger">Unactive</span>' !!}
                                                    @break

                                                    @default
                                                        {{ $value }}
                                                @endswitch
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <a class="btn btn-info" href="{{ route('admin.sliders.index') }}">Back to list</a>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div>
    </div>
@endsection
