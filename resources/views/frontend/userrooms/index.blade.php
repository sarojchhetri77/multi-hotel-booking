@extends('frontend.hotel.layouts.layout')

@section('main-content')
<style>
    .cart-item {
        border-bottom: 1px solid #e0e0e0;
        padding-bottom: 20px;
        margin-bottom: 20px;
    }

    .cart-summary {
        border: 1px solid #e0e0e0;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .cart-summary .total-price {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .btn-checkout {
        background-color: #28a745;
        color: white;
    }

    .btn-checkout:hover {
        background-color: #218838;
    }

    .product-img {
        max-width: 100px;
        object-fit: cover;
    }

    /* Modal Styling */
    .modal-content {
        border-radius: 10px;
    }

    .modal-header {
        border-bottom: 1px solid #e0e0e0;
    }

    .modal-footer {
        border-top: 1px solid #e0e0e0;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        font-weight: bold;
    }

    .form-group input {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
    }

    .hidden {
        display: none;
    }
</style>

<div class="container mt-5">
    <div class="row">
        <!-- Shopping Cart Items -->
        <div class="col-lg-8">
            <h3>Your Selected Room</h3>

            <!-- Loop through selected rooms -->
            @forelse($selectedRooms as $room)
            <div class="cart-item d-flex justify-content-between" id="room-{{ $room['room_id'] }}">
                <div class="d-flex">
                    <img src="{{ asset($room['thumbnail']) }}" alt="Room Image" class="product-img me-3">
                    <div>
                        <h5>{{ $room['name'] }}</h5>
                    </div>
                </div>
                <div class="d-flex flex-column justify-content-between">
                    <span class="price">${{ $room['price_per_night'] }}</span>
                    <button class="btn btn-sm btn-danger" id="remove-room-{{ $room['room_id'] }}">Remove</button>
                </div>
            </div>
            @empty
            <p>No rooms selected yet.</p>
            @endforelse
        </div>

        <!-- Cart Summary -->
        <div class="col-lg-4">
            <div class="cart-summary">
                <h4>Payment Summary</h4>
                <ul class="list-unstyled">
                    <!-- Calculate the total dynamically -->
                    @php
                    $totalPrice = 0;
                    foreach ($selectedRooms as $room) {
                        $totalPrice += $room['price_per_night'];
                    }
                    // $totalPrice = 0;  // Initialize the total price

// $checkin = session('checkin');
// $checkout = session('checkout');

// $check_in = \Carbon\Carbon::parse($checkin);
// $check_out = \Carbon\Carbon::parse($checkout);

// $stayDays = $check_out->diffInDays($check_in);
// // echo $stayDays;

// foreach ($selectedRooms as $room) {
//     $roomTotalPrice = $room['price_per_night'] * $stayDays;
//     $totalPrice += $roomTotalPrice;
// }
                    @endphp
                    {{-- {{$stayDays}} --}}
                    <li class="d-flex justify-content-between">
                        <span>Subtotal:</span>
                        <span>${{ $totalPrice }}</span>
                    </li>
                    <li class="d-flex justify-content-between">
                        <span class="total-price">Total:</span>
                        <span class="total-price">${{ $totalPrice }}</span> <!-- Adding a $5.00 booking fee -->
                    </li>
                </ul>
                <!-- Button to trigger modal -->
                <button type="button" class="btn btn-checkout w-100" data-bs-toggle="modal" data-bs-target="#bookingModal">
                    Proceed to Booking
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Booking Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLabel">Booking Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Who is this booking for?</p>
                <div class="d-flex gap-3 mb-4">
                    <button type="button" class="btn btn-outline-primary flex-grow-1" id="forMyself">For Myself</button>
                    <button type="button" class="btn btn-outline-secondary flex-grow-1" id="forSomeoneElse">For Someone Else</button>
                </div>

                <!-- Form for "For Someone Else" -->
                <form id="guestForm" method="post" class="hidden">
                    @csrf
                    <div class="form-group">
                        <label for="guestName">Guest Name</label>
                        <input type="text" id="guestName" name="guestName" required>
                    </div>
                    <div class="form-group">
                        <label for="guestPhone">Phone Number</label>
                        <input type="tel" id="guestPhone" name="guestPhone" required>
                    </div>
                    <div class="form-group">
                        <label for="arrivalTime">Arrival Time</label>
                        <input type="time" id="arrivalTime" name="arrivalTime" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="bookWithoutPayment">Book Without Payment</button>
                {{-- <button type="button" class="btn btn-primary" id="bookWithPayment">Book With Payment</button> --}}
                <a href="{{route('esewa.pay')}}" class="btn btn-primary"> Book With Payment</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        // On click of remove button
        $(".btn-danger").click(function() {
            var roomId = $(this).attr('id').split('-')[2];  // Get the room ID from button id

            $.ajax({
                url: "{{ url('remove-room') }}/" + roomId,
                method: 'GET',
                success: function(data) {
                    if (data.success) {
                        $(`#room-${roomId}`).remove();
                        updateTotalPrice();
                    }
                }
            });
        });

        // Show/hide form based on selection
        $("#forSomeoneElse").click(function() {
            $("#guestForm").removeClass("hidden");
        });

        $("#forMyself").click(function() {
            $("#guestForm").addClass("hidden");
        });

        // Confirm booking
        // $("#confirmBooking").click(function() {
        //     const isForSomeoneElse = !$("#guestForm").hasClass("hidden");
        //     const guestName = $("#guestName").val();
        //     const guestPhone = $("#guestPhone").val();
        //     const arrivalTime = $("#arrivalTime").val();

        //     if (isForSomeoneElse && (!guestName || !guestPhone || !arrivalTime)) {
        //         alert("Please fill out all guest details.");
        //         return;
        //     }

        //     // Redirect to payment page
        // });
    });

    function updateTotalPrice() {
        let total = 0;
        $(".cart-item").each(function() {
            let price = $(this).find('.price').text().replace('$', '');
            total += parseFloat(price);
        });
        $(".total-price").text('$' + total);
    }

    const guestForm = $('#guestForm');

// Book Without Payment
$('#bookWithoutPayment').on('click', function () {
    guestForm.attr('action', "{{ route('room.book') }}"); // Set form action
    guestForm.submit(); // Submit the form
});

// Book With Payment
// $('#bookWithPayment').on('click', function () {
//     guestForm.attr('action', "{{ route('payment.book') }}"); // Set form action
//     guestForm.submit(); // Submit the form
// });
</script>
@endsection