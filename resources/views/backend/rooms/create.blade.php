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
                            <li class="breadcrumb-item text-gray-700 fw-bold lh-1">Room</li>
                            <li class="breadcrumb-item">
                                <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
                            </li>
                            <li class="breadcrumb-item text-gray-700 fw-bold lh-1">Create</li>
                        </ul>
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">
                            Create New Room</h1>
                    </div>
                </div>
                <div class="action-btn">
                    <a href="{{ url('room') }}" class="btn btn-sm btn-primary p-4">
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
                        <form action="{{ route('room.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6  mb-7">
                                    <label class="col-lg-4 fw-semibold text-muted required">Title</label>
                                    <div class="col-lg-12">
                                        <input type="text" name="name"
                                            class="form-control mb-lg-0 @error('name') is-invalid @enderror"
                                            placeholder="Enter Title" value="{{ old('name') }}" />
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6  mb-7">
                                    <label class="col-lg-4 fw-semibold text-muted required">Category</label>
                                    <div class="col-lg-10">
                                        <select name="category_id" id="category" class="form-select form-select-sm form-select-solid @error('category_id') is-invalid @enderror" data-control="select2" data-close-on-select="true" data-placeholder="Select an option" data-allow-clear="true">
                                            <option></option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{old('category_id') == $category->id ? 'selected' : ''}}>{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6  mb-7">
                                    <label class="col-lg-4 fw-semibold text-muted required">Thumbnail</label>
                                    <div class="col-lg-10">
                                        <input type="file" name="thumbnail" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('thumbnail') is-invalid @enderror" placeholder="Choose Icon" value="{{ old('thumbnail') }}" />
                                        @error('thumbnail')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6  mb-7">
                                    <label class="col-lg-4 fw-semibold text-muted required">Images</label>
                                    <div class="col-lg-10">
                                        <input type="file" name="images[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('images') is-invalid @enderror" multiple />
                                        @error('images')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6  mb-7">
                                    <label class="col-lg-4 fw-semibold text-muted required">Capacity</label>
                                    <div class="col-lg-12">
                                        <input type="number" name="capacity"
                                            class="form-control mb-lg-0 @error('capacity') is-invalid @enderror"
                                            placeholder="Enter Title" value="{{ old('capacity') }}" />
                                        @error('capacity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6  mb-7">
                                    <label class="col-lg-4 fw-semibold text-muted required">Room Number</label>
                                    <div class="col-lg-12">
                                        <input type="number" name="room_number"
                                            class="form-control mb-lg-0 @error('room_number') is-invalid @enderror"
                                            placeholder="Enter Title" value="{{ old('room_number') }}" />
                                        @error('room_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6  mb-7">
                                    <label class="col-lg-4 fw-semibold text-muted required">Total Beds</label>
                                    <div class="col-lg-12">
                                        <input type="number" name="beds"
                                            class="form-control mb-lg-0 @error('beds') is-invalid @enderror"
                                            placeholder="Enter Title" value="{{ old('beds') }}" />
                                        @error('beds')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6  mb-7">
                                    <label class="col-lg-4 fw-semibold text-muted required">Bed Type</label>
                                    <div class="col-lg-12">
                                        <input type="text" name="bed_type"
                                            class="form-control mb-lg-0 @error('bed_type') is-invalid @enderror"
                                            placeholder="Enter Title" value="{{ old('bed_type') }}" />
                                        @error('bed_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6  mb-7">
                                    <label class="col-lg-4 fw-semibold text-muted required">Price Per Night</label>
                                    <div class="col-lg-12">
                                        <input type="number" name="price_per_night"
                                            class="form-control mb-lg-0 @error('price_per_night') is-invalid @enderror"
                                            placeholder="Enter Title" value="{{ old('price_per_night') }}" />
                                        @error('price_per_night')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6  mb-7">
                                    <label class="col-lg-4 fw-semibold text-muted required">Room View</label>
                                    <div class="col-lg-12">
                                        <input type="text" name="room_view"
                                            class="form-control mb-lg-0 @error('room_view') is-invalid @enderror"
                                            placeholder="Enter Title" value="{{ old('room_view') }}" />
                                        @error('room_view')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12  mb-7">
                                    <label class="col-lg-4 fw-semibold text-muted"> Room Description</label>
                                    <div class="col-lg-12">
                                        <textarea name="description"  id="description"
                                            class="form-control form-control-lg ckeditor-editor  @error('description') is-invalid @endif">{{old('description')}}</textarea>
                                    </div>
                                    @error('description')
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
