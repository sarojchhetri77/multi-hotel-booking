@extends('backend.layouts.layout')

@section('content')
<style>
.bg-custom-primary {
    background: linear-gradient(135deg, #6a11cb, #2575fc);
}

.bg-custom-secondary {
    background: linear-gradient(135deg, #9affff, #a2aee6);
}
</style>
    <div class="d-flex flex-column flex-column-fluid">
        <!-- Toolbar -->
        <div id="kt_app_toolbar" class="app-toolbar pt-5">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex justify-content-between">
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4">
                    <!-- Breadcrumb -->
                    <div class="page-title d-flex flex-column gap-1 me-3 mb-2">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-separatorless fw-semibold mb-6">
                                <li class="breadcrumb-item text-gray-700 fw-bold lh-1">
                                    <a href="{{ url('/') }}" class="text-gray-500 text-hover-primary">
                                        <i class="ki-duotone ki-home fs-3 text-gray-400 me-n1"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
                                </li>
                                <li class="breadcrumb-item text-gray-700 fw-bold lh-1">{{ $hotel->name }}</li>
                                <li class="breadcrumb-item">
                                    <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
                                </li>
                                <li class="breadcrumb-item text-gray-700 fw-bold lh-1">Dashboard</li>
                            </ol>
                        </nav>
                        <h1 class="page-heading text-dark fw-bolder fs-3 mb-0">{{ $hotel->name }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!-- Card Section -->
                <div class="card shadow-sm mb-6">
                    <div class="card-header border-0 pt-6">
                        {{-- <h2 class="card-title fw-bolder fs-2">Manage {{ $hotel->name }}</h2> --}}
                    </div>
                    <div class="card-body py-4">
                        <div class="container-fluid">
                            <div class="row g-4">
                                <!-- Category Card -->
                                <div class="col-lg-4 col-md-6 col-sm-12 ">
                                    <a href="{{ url('category') }}" class="text-decoration-none ">
                                        <div class="card h-100 shadow-sm hover-scale bg-custom-primary">
                                            <div class="card-body d-flex flex-column justify-content-center align-items-center text-white rounded-3">
                                                <i class="ki-duotone ki-category fs-2x mb-2"></i>
                                                <p class="fs-5 fw-semibold mb-0">Category</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <!-- Rooms Card -->
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <a href="{{ url('room') }}" class="text-decoration-none">
                                        <div class="card h-100 shadow-sm hover-scale bg-custom-secondary">
                                            <div class="card-body d-flex flex-column justify-content-center align-items-center text-white rounded-3">
                                                <i class="ki-duotone ki-bed fs-2x mb-2"></i>
                                                <p class="fs-5 fw-semibold mb-0">Rooms</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <!-- Bookings Card -->
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <a href="{{ url('booking') }}" class="text-decoration-none">
                                        <div class="card h-100 shadow-sm hover-scale bg-custom-primary">
                                            <div class="card-body d-flex flex-column justify-content-center align-items-center text-white rounded-3">
                                                <i class="ki-duotone ki-bed fs-2x mb-2"></i>
                                                <p class="fs-5 fw-semibold mb-0">Bookings</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking Details Table -->
                <div class="card shadow-sm">
                    <div class="card-header border-0 pt-6">
                        <h2 class="card-title fw-bolder fs-2">Booking Details</h2>
                    </div>
                    <div class="card-body py-4">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-row-bordered gy-5">
                                <thead>
                                    <tr class="fw-bold fs-6 text-gray-800">
                                        <th>Booking ID</th>
                                        <th>Guest Name</th>
                                        <th>Room Type</th>
                                        <th>Check-In Date</th>
                                        <th>Check-Out Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Example Data -->
                                    <tr>
                                        <td>#12345</td>
                                        <td>John Doe</td>
                                        <td>Deluxe Room</td>
                                        <td>2023-10-15</td>
                                        <td>2023-10-20</td>
                                        <td><span class="badge badge-success">Confirmed</span></td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-primary">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>#12346</td>
                                        <td>Jane Smith</td>
                                        <td>Standard Room</td>
                                        <td>2023-10-18</td>
                                        <td>2023-10-22</td>
                                        <td><span class="badge badge-warning">Pending</span></td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-primary">View</a>
                                        </td>
                                    </tr>
                                    <!-- Add more rows dynamically from your database -->
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
    <script>
        // Add hover effect to cards
        document.querySelectorAll('.hover-scale').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'scale(1.05)';
                card.style.transition = 'transform 0.2s ease-in-out';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'scale(1)';
            });
        });
    </script>
@endsection