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
                            <h5 class="card-title mb-0">{{ $title ?? null }} : {{ $slider->title ?? null }}</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="firstNameinput" class="form-label">Title</label>
                                            <input value="{{ $slider->title }}" name="title" type="text"
                                                class="form-control" placeholder="Enter title..." id="firstNameinput">
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="lastNameinput" class="form-label">Image</label>
                                            <input class="form-control" type="file" name="image" id="">
                                            <img class="mt-3" width="80" src="{{ Storage::url($slider->image) }}"
                                                alt="">
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="lastNameinput" class="form-label">Description</label>
                                            <textarea class="form-control" name="description" id="" cols="30" rows="2">{{ $slider->description }}</textarea>
                                        </div>
                                    </div><!- <div class="col-12">
                                        <div class="mb-3">
                                            <label for="ForminputState" class="form-label">Status</label>
                                            <select name="status" id="ForminputState" class="form-select">
                                                <option selected>--- Choose status ---</option>
                                                <option {{ !$slider->status ? 'selected' : '' }} value="0">No</option>
                                                <option {{ $slider->status ? 'selected' : '' }} value="1">Yes</option>
                                            </select>
                                        </div>
                                </div><!--end col-->
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <button type="reset" class="btn btn-dark">Reset</button>
                                    <a href="{{ route('admin.sliders.index') }}" class="btn btn-info">Back to
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
