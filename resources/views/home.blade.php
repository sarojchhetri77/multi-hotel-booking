@extends('backend.layouts.layout')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar pt-5">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
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
                            <li class="breadcrumb-item text-gray-700 fw-bold lh-1">Dashboard</li>
                        </ul>
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">
                            Dashboard</h1>
                    </div>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="card shadow-sm">
                    <div class="card-header border-0 pt-6">
                        <h2 class="card-title fw-bolder fs-2">Booking Details</h2>
                    </div>
                    <div class="card-body py-4">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-row-bordered gy-5">
                                <thead>
                                    <tr class="fw-bold fs-6 text-gray-800">
                                        <th>ID</th>
                                        <th>Hotel Name</th>
                                        <th>Room price</th>
                                        <th>Total price</th>
                                        <th>Check-In Date</th>
                                        <th>Check-Out Date</th>
                                        <th>Payment Status</th>
                                        <th>Booking Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Example Data -->
                                    @foreach ($bookings as $booking)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$booking->hotel->name}}</td>
                                        <td> RS.{{$booking->room->price_per_night}}</td>
                                            @php
                                                $check_in = \Carbon\Carbon::parse($booking->check_in_date);
                                                $check_out = \Carbon\Carbon::parse($booking->check_out_date);
                                                $stay_days = $check_out->diffInDays($check_in);
                                            @endphp
                                            {{-- {{$stay_days}} days --}}
                                        
                                        <td>
                                            @php
                                                $total_payment = $booking->room->price_per_night * $stay_days;
                                            @endphp
                                            RS.{{$total_payment}}
                                        </td>
                                        <td>{{$booking->check_in_date}}</td>
                                        <td>{{$booking->check_out_date}}</td>
                                        <td>  <span class="badge {{ $booking->payment_status == 'paid' ? 'badge-success' : 'badge-danger' }}">
                                            {{ $booking->payment_status }}
                                        </span></td>
                                        <td>  <span class="badge {{ $booking->booking_status == 'booked' ? 'badge-success' : 'badge-danger' }}">
                                            {{ $booking->booking_status }}
                                        </span></td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-primary">View</a>
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
@endsection

@section('extra-js')
    <script src="{{ asset('admin/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
    <script src="{{ asset('admin/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('admin/assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('admin/assets/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('admin/assets/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('admin/assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('admin/assets/js/custom/utilities/modals/create-account.js') }}"></script>
    <script src="{{ asset('admin/assets/js/custom/utilities/modals/create-app.js') }}"></script>
    <script src="{{ asset('admin/assets/js/custom/utilities/modals/users-search.js') }}"></script>
@endsection
