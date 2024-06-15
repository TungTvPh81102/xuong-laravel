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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">{{ $title ?? null }}</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="firstNameinput" class="form-label">Name</label>
                                            <input name="name" type="text" class="form-control" placeholder="Enter name..."
                                                id="firstNameinput">
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="lastNameinput" class="form-label">Cover</label>
                                            <input type="file" class="form-control" name="cover" id="lastNameinput">
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="ForminputState" class="form-label">Status</label>
                                            <select name="status" id="ForminputState" class="form-select">
                                                <option selected>--- Choose status ---</option>
                                                <option value="draft">Draft</option>
                                                <option value="publish">Publish</option>
                                            </select>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary">Create</button>
                                        <button type="reset" class="btn btn-dark">Reset</button>
                                        <a href="{{ route('admin.brands.index') }}" class="btn btn-info">Back to list</a>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </form>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div>
    </div>
@endsection
