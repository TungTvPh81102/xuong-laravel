@extends('admin.layouts.master')

@section('title')
    Update Catalogue
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{ $title ?? null }} </h4>

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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">{{ $title ?? null }} : {{ $catalogue->name ?? null }}</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.catalogues.update', $catalogue->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="firstNameinput" class="form-label">Name</label>
                                            <input value="{{ $catalogue->name ?? null }}" name="name" type="text"
                                                class="form-control" placeholder="Enter name..." id="firstNameinput">
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="ForminputState" class="form-label">Level</label>
                                            <select name="parent_id" id="ForminputState" class="form-select">
                                                <option selected>--- Choose status ---</option>
                                                <option {{ !$catalogue->parent_id ? 'selected' : '' }} value="0">
                                                    Dad</option>
                                                <option {{ $catalogue->parent_id ? 'selected' : '' }} value="1">
                                                    Child</option>
                                            </select>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="ForminputState" class="form-label">Status</label>
                                            <select name="status" id="ForminputState" class="form-select">
                                                <option selected>--- Choose status ---</option>
                                                <option {{ $catalogue->status == 'draft' ? 'selected' : '' }}
                                                    value="draft">
                                                    Draft</option>
                                                <option {{ $catalogue->status == 'publish' ? 'selected' : '' }}
                                                    value="publish">
                                                    Publish</option>
                                            </select>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <button type="reset" class="btn btn-dark">Reset</button>
                                        <a href="{{ route('admin.catalogues.index') }}" class="btn btn-info">Back to
                                            list</a>
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
