@extends('frontend.layouts.layout')

@section('main-content')
<style>
    .tabb.active {
        background-color: #58acf0 !important;
        color: white !important;
    }
    .tabb {
        color: #333;
        transition: all 0.3s ease;
    }
    .tabb:hover {
        color: #58acf0;
    }
    .filter {
        z-index: 1020;
        top: 0;
    }
    .navbar {
        z-index: 1030;
    }
    .sticky-filter {
        position: sticky;
        top: 77px;
    }
    @media screen and (max-width: 600px) {
        .card {
            width: 100%;
            margin: 0px 0px 10px 0px !important;
            padding: 0px !important;
        }
        .pic {
            margin-top: 0px !important;
        }
    }
    .pic {
        position: relative;
        display: inline-block;
    }
    .pic img {
        border-radius: 50%;
        cursor: pointer;
    }
    #profile_pic {
        display: none;
    }
    .tab-pane {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
    }
    .cards {
        border: none;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    .cards:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }
    .cards p.fw-bold {
        color: #007bff;
        margin-bottom: 5px;
    }
    .cards p:last-child {
        color: #6c757d;
        font-size: 1rem;
    }
    .text-dark:hover {
        text-decoration: underline;
        color: #0056b3;
    }
    .form-control {
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 10px;
    }
    .form-control:focus {
        border-color: #58acf0;
        box-shadow: 0 0 5px rgba(88, 172, 240, 0.5);
    }
    .btn-primary {
        background-color: #58acf0;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #4698d9;
    }
    .card-header {
        background-color: #ffffff;
        border-bottom: 1px solid #eee;
        padding: 15px 20px;
        border-radius: 10px 10px 0 0;
    }
    .card-body {
        padding: 20px;
    }
    .nav-pills .nav-link {
        border-radius: 8px;
        margin: 5px 0;
        padding: 10px 15px;
        transition: all 0.3s ease;
    }
    .nav-pills .nav-link:hover {
        background-color: #f0f0f0;
    }
    .drag-drop-area {
    border: 2px dashed #58acf0;
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    background-color: #f9f9f9;
    cursor: pointer;
    transition: background-color 0.3s ease, border-color 0.3s ease;
    position: relative;
    min-height: 150px; /* Ensure the area has a minimum height */
    display: flex;
    align-items: center;
    justify-content: center;
}

.drag-drop-area:hover {
    background-color: #f0f0f0;
    border-color: #4698d9;
}

.drag-drop-area.dragover {
    background-color: #e0f0ff;
    border-color: #58acf0;
}

.drag-drop-area .default-text {
    margin: 0;
    color: #333;
    font-size: 16px;
}

.drag-drop-area .browse-link {
    color: #58acf0;
    text-decoration: underline;
    cursor: pointer;
}

.drag-drop-area .preview-image {
    max-width: 100%;
    max-height: 150px;
    border-radius: 8px;
    display: none; /* Hidden by default */
}
.actions {
    display: inline-block;
    margin-left: 10px;
}
</style>

<main class="container-fluid">
    <div class="row g-2">
        <div class="col-lg-4">
            <div class="card m-4 border-0 shadow filter sticky-filter">
                <div class="tag d-flex flex-row flex-lg-column">
                    <ul class="nav nav-pills m-3 flex-row flex-lg-column" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link tabb" id="pills-askquestion-tab" data-bs-toggle="pill" data-bs-target="#pills-askquestion" type="button" role="tab" aria-controls="pills-askquestion" aria-selected="false">Register Hotel</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link tabb active" id="pills-question-tab" data-bs-toggle="pill" data-bs-target="#pills-question" type="button" role="tab" aria-controls="pills-question" aria-selected="false">Your Hotel</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link tabb" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Profile Details</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link tabb" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Change Password</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link tabb" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Setting</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link tabb" id="pills-booking-tab" data-bs-toggle="pill" data-bs-target="#pills-booking" type="button" role="tab" aria-controls="pills-booking" aria-selected="false">Booking</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-8" style="min-height: 100vh">
            <div class="card shadow m-4 border-0" style="min-height: 80vh">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="card-header">
                            <h5>Profile Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <label class="col-lg-4 fw-semibold text-muted">Profile Pic</label>
                                <div class="col-lg-8 pic">
                                    <img height="100px" width="100px" style="border-radius: 50%" src="{{Auth::user()->profile_pic ? asset(Auth::user()->profile_pic) : asset('admin/assets/media/avatars/blank.png') }}" />
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-lg-4 fw-semibold text-muted">Full Name</label>
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">{{Auth::user()->name}}</span>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-lg-4 fw-semibold text-muted">Email</label>
                                <div class="col-lg-8">
                                    <span class="fw-semibold text-gray-800 fs-6">{{Auth::user()->email}}</span>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-lg-4 fw-semibold text-muted">Contact Phone</label>
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">{{Auth::user()->phone_number}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="card-header">
                            <h5>Change Password</h5>
                        </div>
                        <div class="card-body">
                            <form id="passwordForm" action="" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="oldpassword" class="form-label">Old Password</label>
                                    <input type="password" class="form-control" id="oldpassword" name="old_password">
                                    <span id="oldPasswordError" class="text-danger"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="newpassword" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="newpassword" name="new_password">
                                    <span id="newPasswordError" class="text-danger"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="confirmpassword" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirmpassword" name="c_password">
                                    <span id="confirmPasswordError" class="text-danger"></span>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="card-header">
                            <h5>Update Profile Details</h5>
                        </div>
                        <div class="card-body">
                            <!-- Update profile form here -->
                        </div>
                    </div>
                    <div class="tab-pane fade show active" id="pills-question" role="tabpanel" aria-labelledby="pills-question-tab">
                        <div class="card-header">
                            <h5>Manage your hotel</h5>
                        </div>
                        <div class="card-body">
                            @if (auth()->user()->hotel)
                                <a href="{{route('manage.hotel')}}" class="btn btn-primary">Manage Hotel</a>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-askquestion" role="tabpanel" aria-labelledby="pills-askquestion-tab">
                        <div class="card-header">
                            <h5>Enter the details of your hotel</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('hotel.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label required">Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Hotel Name" value="{{ old('name') }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label required">Address</label>
                                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Enter Address" value="{{ old('address') }}">
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label required">District</label>
                                        <input type="text" name="district" class="form-control @error('district') is-invalid @enderror" placeholder="Enter District" value="{{ old('district') }}">
                                        @error('district')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label required">City</label>
                                        <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" placeholder="Enter City" value="{{ old('city') }}">
                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label required">Street No</label>
                                        <input type="number" name="street_no" class="form-control @error('street_no') is-invalid @enderror" placeholder="Enter Street No" value="{{ old('street_no') }}">
                                        @error('street_no')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label required">Total Rooms</label>
                                        <input type="number" name="room_number" class="form-control @error('room_number') is-invalid @enderror" placeholder="Enter Total Rooms" value="{{ old('room_number') }}">
                                        @error('room_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label required">Thumbnail</label>
                                        <div class="drag-drop-area" id="dragDropArea">
                                            <p class="default-text">Drag & drop your image here or <span class="browse-link">browse</span></p>
                                            <img src="" alt="Image Preview" class="preview-image" style="display: none; max-width: 100px; max-height: 100px;">
                                            <input type="file" name="thumbnail" id="thumbnailInput" class="form-control @error('thumbnail') is-invalid @enderror" accept="image/*" style="display: none;">
                                            @error('thumbnail')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <input type="submit" class="btn btn-primary" value="Submit">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-booking" role="tabpanel" aria-labelledby="pills-booking-tab">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Your Booking Details</h5>
                            </div>
                            <div class="card-body p-0">
                                @if($bookings->isEmpty())
                                    <div class="alert alert-info m-3" role="alert">
                                        You have no bookings yet.
                                    </div>
                                @else
                                    <!-- Add table-responsive here -->
                                    <div class="table-responsive" style="min-height: 500px;">
                                        <table class="table table-bordered table-hover table-striped mb-0">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Room</th>
                                                    <th>Check-In Date</th>
                                                    <th>Check-Out Date</th>
                                                    <th>Guest Name</th>
                                                    <th>Guest Phone</th>
                                                    <th>Arrival Time</th>
                                                    <th>Payment Status</th>
                                                    <th>Booking Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($bookings as $index => $booking)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $booking->room->name }}</td>
                                                        <td>{{ $booking->check_in_date }}</td>
                                                        <td>{{ $booking->check_out_date }}</td>
                                                        <td>{{ $booking->guest_name }}</td>
                                                        <td>{{ $booking->guest_phone }}</td>
                                                        <td>{{ $booking->arrival_time }}</td>
                                                        <td>
                                                            @switch($booking->payment_status)
                                                                @case('Not Paid')
                                                                    <span class="badge bg-primary">Not Paid</span>
                                                                @break
                                                                @case('Paid')
                                                                    <span class="badge bg-success">Paid</span>
                                                                @break
                                                                @default
                                                                    <span class="badge bg-danger">Not Paid</span>
                                                            @endswitch
                                                        </td>
                                                        <td>
                                                            @switch($booking->booking_status)
                                                                @case('booked')
                                                                    <span class="badge bg-primary">booked</span>
                                                                @break
                                                                @case('cancelled')
                                                                    <span class="badge bg-success">cancelled</span>
                                                                @break
                                                                @default
                                                                    <span class="badge bg-danger">procesed</span>
                                                            @endswitch
                                                        </td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $booking->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    Action
                                                                </button>
                                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $booking->id }}">
                                                                    <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i>View</a></li>
                                                                    <li>
                                                                        <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#cancelModal{{ $booking->id }}">
                                                                            <i class="fas fa-times me-2"></i>Cancel Booking
                                                                        </button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                    
                                                    <!-- Cancel Booking Modal for Each Booking -->
                                                    <div class="modal fade" id="cancelModal{{ $booking->id }}" tabindex="-1" aria-labelledby="cancelModalLabel{{ $booking->id }}" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="cancelModalLabel{{ $booking->id }}">Cancel Booking</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    @if ($booking->payment_status = 'Payed')
                                                                    <p>You Should Contact to the hotel for Refund</p>
                                                                    @endif
                                                                    Are you sure you want to cancel this booking for <strong>{{ $booking->room->name }}</strong>?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <form action="{{ route('booking.cancel') }}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="booking_id" value="{{$booking->id}}">
                                                                        <button type="submit" class="btn btn-danger">Confirm Cancel</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('extra-js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        const dragDropArea = $('#dragDropArea');
        const thumbnailInput = $('#thumbnailInput');
        const defaultText = $('.default-text');
        const previewImage = $('.preview-image');

        dragDropArea.on('dragenter dragover', function (e) {
            e.preventDefault();
            e.stopPropagation();
            dragDropArea.addClass('dragover');
        });

        dragDropArea.on('dragleave', function () {
            dragDropArea.removeClass('dragover');
        });

        dragDropArea.on('drop', function (e) {
            e.preventDefault();
            e.stopPropagation();
            dragDropArea.removeClass('dragover');

            const files = e.originalEvent.dataTransfer.files;
            if (files.length > 0) {
                let file = files[0];

                // Use DataTransfer to assign files to input
                let dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                thumbnailInput[0].files = dataTransfer.files;

                showImagePreview(file);
            }
        });

        thumbnailInput.on('change', function () {
            if (this.files && this.files[0]) {
                showImagePreview(this.files[0]);
            }
        });

        $(".browse-link").on('click', function (e) {
            e.stopPropagation();
            thumbnailInput.click();
        });

        function showImagePreview(file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImage.attr('src', e.target.result);
                previewImage.show();
                defaultText.hide();
            };
            reader.readAsDataURL(file);
        }

        previewImage.on('click', function (e) {
            e.stopPropagation();
            thumbnailInput.click();
        });
    });
</script>   
@endsection