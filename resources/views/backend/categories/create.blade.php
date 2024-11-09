@extends('backend.layouts.layout')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar pt-5">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex justify-content-between">
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4">
                    <div class="page-title d-flex flex-column gap-1 me-3 mb-2">
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold mb-6">
                            <li class="breadcrumb-item text-gray-700 fw-bold lh-1">
                                <a href="{{ url('/') }}" class="text-gray-500">
                                    <i class="ki-duotone ki-home fs-3 text-gray-400 me-n1"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
                            </li>
                            <li class="breadcrumb-item text-gray-700 fw-bold lh-1">Categories</li>
                            <li class="breadcrumb-item">
                                <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
                            </li>
                            <li class="breadcrumb-item text-gray-700 fw-bold lh-1">Create</li>
                        </ul>
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">
                            Create New Category</h1>
                    </div>
                </div>
                <div class="action-btn">
                    <a href="{{ url('category') }}" class="btn btn-sm btn-primary p-4">
                        Back
                    </a>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="card">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <small class="text-danger">Fields labeled with * are required</small>
                        </div>
                    </div>
                    <div class="card-body py-4">
                        <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6  mb-7">
                                    <label class="col-lg-4 fw-semibold text-muted required">Title</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="title"
                                            class="form-control mb-lg-0 @error('title') is-invalid @enderror"
                                            placeholder="Enter Title" value="{{ old('title') }}" />
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="col-md-12  mb-7">
                                    <label class="col-lg-4 fw-semibold text-muted">Description</label>
                                    <div class="col-lg-12">
                                        <textarea name="description" id="description"
                                            class="form-control form-control-lg @error('description') is-invalid @endif">{{old('description')}}</textarea>
                                    </div>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> --}}
                                <div class="col-md-12
                                            mb-7">
                                        <input type="submit" class="btn btn-success" value="Submit">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection