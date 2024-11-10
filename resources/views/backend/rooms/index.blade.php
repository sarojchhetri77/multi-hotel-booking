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
                            <li class="breadcrumb-item text-gray-700 fw-bold lh-1">Rooms</li>
                            <li class="breadcrumb-item">
                                <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
                            </li>
                            <li class="breadcrumb-item text-gray-700 fw-bold lh-1">List</li>
                        </ul>
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">
                            All Rooms</h1>
                    </div>
                </div>
                <div class="action-btn">
                    <a href="{{url('room/create')}}" class="btn btn-sm btn-primary p-4">
                        Add New
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
                                    class="form-control form-control-solid w-250px ps-13" placeholder="Search Room" />
                            </div>
                        </div>
                    </div>
                    <div class="card-body py-4">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="table">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">S.N</th>
                                    <th class="min-w-125px">Title</th>
                                    <th class="min-w-125px">Thumbnail</th>
                                    <th class="min-w-125px">Status</th>
                                    <th class="text-end min-w-100px">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @foreach ($rooms as $room)
                                    <tr>
                                        <td></td>
                                        <td class="">
                                            <p class="text-gray-800 text-hover-primary mb-1">{{ $room->name }}
                                            </p>
                                        </td>
                                        <td>
                                            <img class="symbol" height="50%" width="50%" src="{{asset($room->thumbnail)}}" alt="room thumbnail">
                                        </td>
                                        <td class="text-end">
                                            <a href="#"
                                                class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                data-kt-menu="true">
                                                <div class="menu-item px-3">
                                                    <a href="{{route('room.edit',$room->id)}}" class="menu-link px-3">Edit</a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a href="{{route('room.show',$room->id)}}" class="menu-link px-3">View</a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('room.status', [$room->id, 'verified']) }}" class="menu-link px-3">Verify</a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a href="" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#rejectModel_{{$room->id}}">Rejected</a>
                                                    {{-- <a href="{{ route('room.status', [$room->id, 'rejected']) }}" class="menu-link px-3">Rejected</a> --}}
                                                </div>
                                                <div class="menu-item px-3">
                                                    <form action="{{route('room.destroy',$room->id)}}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                    <button class="menu-link px-3 border-0 w-100 btn btn-white btn-sm" onclick="return confirm('Are you want to delete this room')"  type="submit">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="rejectModel_{{$room->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="rejectModelLabel_{{$room->id}}">Write reason to reject this room</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{route('room.reject',$room->id)}}" method="post">
                                                @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="reject" class="form-label">Reason</label>
                                                    <textarea class="form-control" name="reason" id="reject" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                              <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                          </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
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