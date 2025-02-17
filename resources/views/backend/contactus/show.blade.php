@extends('backend.layouts.layout')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar pt-5">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex justify-content-between">
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4">
                    <div class="page-title d-flex flex-column gap-1 me-3 mb-2">
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold mb-6">
                            <li class="breadcrumb-item text-gray-700 fw-bold lh-1">
                                <a href="{{url('/')}}" class="text-gray-500">
                                    <i class="ki-duotone ki-home fs-3 text-gray-400 me-n1"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
                            </li>
                            <li class="breadcrumb-item text-gray-700 fw-bold lh-1">Contact Message</li>
                            <li class="breadcrumb-item">
                                <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
                            </li>
                            <li class="breadcrumb-item text-gray-700 fw-bold lh-1">List</li>
                        </ul>
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">
                            All Contact Message</h1>
                    </div>
                </div>
                <div class="action-btn">
                    <a href="{{url('contact-us')}}" class="btn btn-sm btn-primary p-4">
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
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <input type="text" data-kt-table-filter="search"
                                    class="form-control form-control-solid w-250px ps-13" placeholder="Search message" />
                            </div>
                        </div>
                    </div>
                    <div class="card-body py-4">
                        <div class="container">
                            <h1>Contact Details</h1>
                            <p><strong>Name:</strong> {{ $contact->name }}</p>
                            <p><strong>Email:</strong> {{ $contact->email }}</p>
                            <p><strong>Subject:</strong> {{ $contact->subject }}</p>
                            <p><strong>Message:</strong> {{ $contact->message }}</p>
                            {{-- <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Back</a> --}}
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
@endsection