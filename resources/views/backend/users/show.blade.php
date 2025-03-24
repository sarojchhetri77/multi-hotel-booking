@extends('backend.layouts.layout')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar pt-5">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
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
                            <li class="breadcrumb-item text-gray-700 fw-bold lh-1">User</li>
                            <li class="breadcrumb-item">
                                <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
                            </li>
                            <li class="breadcrumb-item text-gray-700 fw-bold lh-1"></li>
                            {{-- <li class="breadcrumb-item">
                                <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
                            </li> --}}
                            <li class="breadcrumb-item text-gray-700">View</li>
                        </ul>
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">
                            {{$user->name}}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-detail" type="button" role="tab" aria-controls="pills-detail" aria-selected="true">User Details</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-question-tab" data-bs-toggle="pill" data-bs-target="#pills-question" type="button" role="tab" aria-controls="pills-question" aria-selected="false">Questions</button>
                    </li>
                  </ul>
                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-detail" role="tabpanel" aria-labelledby="pills-detail-tab">
                        <div class="row">
                            <div class="card col-md-12 col-lg-6" style="min-height: 50vh">
                                <div class="row g-1 ps-3 pt-2">
                                    <div class="col-sm-12 d-flex">
                                        <div class="fw-semibold fs-3 text-gray-600">User Name:
                                        </div>
                                        <div class="fw-bold fs-2 text-gray-800  ps-3 ms-1">{{ $user->name }}
                                        </div>
                                    </div>
                                    <div class="col-sm-12 d-flex">
                                        <div class="fw-semibold fs-3 text-gray-600">Email:
                                        </div>
                                        <div class="fw-bold fs-2 text-gray-800  ps-3 ms-1">{{ $user->email }}
                                        </div>
                                    </div>
                                    <div class="col-sm-12 d-flex">
                                        <div class="fw-semibold fs-3 text-gray-600">phone Number:
                                        </div>
                                        <div class="fw-bold fs-2 text-gray-800  ps-3 ms-1">{{ $user->phone_number }}
                                        </div>
                                    </div>
                                    <div class="col-sm-12 d-flex">
                                        <div class="fw-semibold fs-3 text-gray-600">Address:
                                        </div>
                                        <div class="fw-bold fs-2 text-gray-800  ps-3 ms-1">{{ $user->address }}
                                        </div>
                                    </div>
                                    <div class="col-sm-12 d-flex">
                                        <div class="fw-semibold fs-3 text-gray-600">Register At:
                                        </div>
                                        <div class="fw-bold fs-2 text-gray-800  ps-3 ms-1">{{ $user->created_at }}
                                        </div>
                                    </div>
                                    <div class="col-sm-12 d-flex">
                                        <div class="fw-semibold fs-3 text-gray-600">Last Updated at:
                                        </div>
                                        <div class="fw-bold fs-2 text-gray-800  ps-3 ms-1">{{ $user->updated_at }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <h2>Profile Picture</h2>
                                <div class="image">
                                    <img src="{{ $user->profile_pic ? asset($user->profile_pic) : asset('admin/assets/media/avatars/blank.png') }}" alt="Profile image">
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- content for tab question --}}
                    <div class="tab-pane fade" id="pills-question" role="tabpanel" aria-labelledby="pills-question-tab">
                        <div class="card" style="min-height: 50vh">
                            <div class="card-header border-0 pt-6">
                                <div class="card-title">
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <input type="text" data-kt-table-filter="search"
                                            class="form-control form-control-solid w-250px ps-13" placeholder="Search Questions" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-body py-4">
                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="table">
                                    <thead>
                                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                            <th class="w-10px pe-2">S.N</th>
                                            <th class="min-w-125px">Title</th>
                                            <th class="text-end min-w-100px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-600 fw-semibold">
                                        @foreach ($user->questions as $question)
                                            <tr>
                                                <td></td>
                                                <td class="d-flex align-items-center">
                                                    <p class="text-gray-800 text-hover-primary mb-1">{{ $question->title }}
                                                    </p>
                                                </td>
                                                <td class="text-end">
                                                    <a href="#"
                                                        class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                        <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                        data-kt-menu="true">
                                                        {{-- <div class="menu-item px-3">
                                                            <a href="{{route('questions.edit',$question->id)}}" class="menu-link px-3">Edit</a>
                                                        </div> --}}
                                                        <div class="menu-item px-3">
                                                            <a href="{{route('questions.show',$question->id)}}" class="menu-link px-3">View</a>
                                                        </div>
                                                        <div class="menu-item px-3">
                                                            {{-- <form action="{{route('questions.destroy',$question->id)}}" method="post">
                                                                @csrf
                                                                @method('delete')
                                                            <button class="menu-link px-3 border-0 w-100 btn btn-white btn-sm" onclick="return confirm('Are you want to delete this property')"  type="submit">Delete</button>
                                                            </form> --}}
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                  </div>
                  
            </div>
        </div>
    </div>
@endsection
@section('extra-js')
    <script src="{{ asset('admin/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        var table = document.getElementById('table');
        $(document).ready(function() {
            var datatable;
            if (!table) {
                return;
            }

            initUserTable();
            handleSearchDatatable();
        })
        var initUserTable = function() {
            datatable = $(table).DataTable({
                "info": false,
                'order': [],
                "pageLength": 10,
                "lengthChange": false,
                "columnDefs": [{
                    "targets": 0,
                    "orderable": false
                }],
                "createdRow": function(row, data, dataIndex) {
                    $('td:eq(0)', row).html(dataIndex + 1);
                }
            });

        }
        var handleSearchDatatable = () => {
            const filterSearch = document.querySelector('[data-kt-table-filter="search"]');
            filterSearch.addEventListener('keyup', function(e) {
                datatable.search(e.target.value).draw();
            });
        }
    </script>