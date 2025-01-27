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
                    @endphp
                    <li class="d-flex justify-content-between">
                        <span>Subtotal:</span>
                        <span>${{ $totalPrice }}</span>
                    </li>
                    <li class="d-flex justify-content-between">
                        <span class="total-price">Total:</span>
                        <span class="total-price">${{ $totalPrice + 5.00 }}</span> <!-- Adding a $5.00 booking fee -->
                    </li>
                </ul>
                <a href="{{route('esewa.pay')}}" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">Proceed to Booking</a>
            </div>
        </div>
    </div>
</div>    
@endsection
@section('extra-js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // On click of remove button
        $(".btn-danger").click(function() {
            var roomId = $(this).attr('id').split('-')[2];  // Get the room ID from button id

            $.ajax({
                url: "{{url('remove-room')}}/" + roomId,
                method: 'GET',
                success: function(data) {
                    console.log(data);
                    if (data.success) {
                        // Remove the room item from the UI
                        $(`#room-${roomId}`).remove();
                        // Optionally, update the total price or other dynamic content
                        updateTotalPrice();
                    }
                }
            });
        });
    });

    function updateTotalPrice() {
        let total = 0;
        $(".cart-item").each(function() {
            let price = $(this).find('.price').text().replace('$', '');
            total += parseFloat(price);
        });
        $(".total-price").text('$' + total);
    }
</script>

@endsection
