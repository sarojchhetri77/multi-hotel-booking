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
                            <li class="breadcrumb-item text-gray-700 fw-bold lh-1">About Us</li>
                            <li class="breadcrumb-item">
                                <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
                            </li>
                            <li class="breadcrumb-item text-gray-700 fw-bold lh-1">Create</li>
                        </ul>
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">
                            Add About Us Details</h1>
                    </div>
                </div>
                <div class="action-btn">
                    <a href="{{ url('hotelaboutus') }}" class="btn btn-sm btn-primary p-4">
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
                        <form action="{{ route('hotelaboutus.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6  mb-7">
                                    <label class="col-lg-4 fw-semibold text-muted required">Number of Client</label>
                                    <div class="col-lg-12">
                                        <input type="number" name="num_clients"
                                            class="form-control mb-lg-0 @error('num_clients') is-invalid @enderror"
                                            placeholder="Enter Title" value="{{ old('num_clients') }}" />
                                        @error('num_clients')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6  mb-7">
                                    <label class="col-lg-4 fw-semibold text-muted required">Number of Staff</label>
                                    <div class="col-lg-12">
                                        <input type="number" name="num_staff"
                                            class="form-control mb-lg-0 @error('num_staff') is-invalid @enderror"
                                            placeholder="Enter Title" value="{{ old('num_staff') }}" />
                                        @error('num_staff')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6  mb-7">
                                    <label class="col-lg-4 fw-semibold text-muted required">Number of Rooms</label>
                                    <div class="col-lg-12">
                                        <input type="number" name="num_rooms"
                                            class="form-control mb-lg-0 @error('num_rooms') is-invalid @enderror"
                                            placeholder="Enter Title" value="{{ old('num_rooms') }}" />
                                        @error('num_rooms')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6  mb-7">
                                    <label class="col-lg-4 fw-semibold text-muted required">Images</label>
                                    <div class="col-lg-10">
                                        <input type="file" name="images[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('images') is-invalid @enderror" placeholder="Choose Icon" value="{{ old('images') }}" multiple />
                                        @error('images')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6  mb-7">
                                    <label class="col-lg-4 fw-semibold text-muted">Short Description</label>
                                    <div class="col-lg-12">
                                        <textarea name="small_description"  id="small_description"
                                            class="form-control form-control-lg   @error('small_description') is-invalid @endif">{{old('small_description')}}</textarea>
                                    </div>
                                    @error('small_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12  mb-7">
                                    <label class="col-lg-4 fw-semibold text-muted">Description</label>
                                    <div class="col-lg-12">
                                        <textarea name="long_description"  id="long_description"
                                            class="form-control form-control-lg ckeditor-editor  @error('long_description') is-invalid @endif">{{old('long_description')}}</textarea>
                                    </div>
                                    @error('long_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-7">
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
