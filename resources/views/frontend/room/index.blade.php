@extends('frontend.hotel.layouts.layout')

@section('main-content')

        <!-- Page Header Start -->
        <div class="container-fluid page-header mb-5 p-0" style="background-image: url('{{ asset('frontend/img/carousel-1.jpg') }}');">
            <div class="container-fluid page-header-inner py-5">
                <div class="container text-center pb-5">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Rooms</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Rooms</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Page Header End -->
       <!-- Booking Start -->
       <div class="container-fluid booking pb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="bg-white shadow" style="padding: 35px;">
                <form action="{{route('hotelroom.list',$hotel->slug)}}" method="get">
                <div class="row g-2">
                    <div class="col-md-10">
                        <div class="row g-2">
                            <div class="col-md-3">
                                <div data-target-input="nearest">
                                    <input type="date" name="check_in_date" class="form-control"
                                        placeholder="Check_in_date"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div>
                                    <input type="date" class="form-control" name="check_out_date"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select">
                                    <option selected>Adult</option>
                                    <option value="1">Adult 1</option>
                                    <option value="2">Adult 2</option>
                                    <option value="3">Adult 3</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select">
                                    <option selected>Child</option>
                                    <option value="1">Child 1</option>
                                    <option value="2">Child 2</option>
                                    <option value="3">Child 3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary w-100">Submit</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- Booking End -->


    <!-- Room Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title text-center text-primary text-uppercase">Our Rooms</h6>
                <h1 class="mb-5">Explore Our <span class="text-primary text-uppercase">Rooms</span></h1>
            </div>
            <form action="" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                
                <div class="row g-4">
                    @foreach ($rooms as $room)
                    <div class="col-lg-4 col-md-6 wow fadeInUp room-card" data-room-id="{{ $room->id }}" data-wow-delay="0.1s">
                        <div class="room-item shadow rounded overflow-hidden border border-light">
                            <div class="position-relative">
                                <img class="w-100" src="{{ asset($room->thumbnail) }}" alt="" data-thumbnails="{{ asset($room->thumbnail) }}"  style="height:15rem">
                                <small class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">{{ $room->price_per_night }}</small>
                            </div>
                            <div class="p-4 mt-2">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0" id="name">{{ $room->name }}</h5>
                                    <div class="ps-2">
                                        @for ($i = 0; $i < 5; $i++)
                                            <small class="fa fa-star text-primary"></small>
                                        @endfor
                                    </div>
                                </div>
                                <div class="d-flex mb-3">
                                    <small class="border-end me-3 pe-3"><i class="fa fa-bed text-primary me-2"></i>{{ $room->beds }} Bed</small>
                                    <small class="border-end me-3 pe-3"><i class="fa fa-bath text-primary me-2"></i>{{ $room->baths }} Bath</small>
                                    <small><i class="fa fa-wifi text-primary me-2"></i>Wifi</small>
                                </div>
                                <p class="text-body mb-3">{!! $room->description !!}</p>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-sm btn-info rounded py-2 px-4" href="{{route('room.details',$room->id)}}">View Detail</a>
                                    <button type="button" class="btn btn-sm btn-primary rounded py-2 px-4 select-room-btn">Select Room</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            
                <!-- Hidden input field to store selected room IDs -->
                <input type="hidden" name="selected_rooms" id="selected_rooms">
                <div class="text-center mt-4">
                    {{-- <button type="submit" class="btn btn-success btn-lg" id="proceed_booking" disabled>Proceed to Booking</button> --}}
                    <a href="{{route('userselect.room',$hotel->slug)}}" class="btn btn-success btn-lg">Proceed To Booking</a>
                </div>
            </form>
            
        </div>
    </div>
    <!-- Room End -->
    
@endsection

@section('extra-js')
<script>
   $(document).ready(function () {
    let selectedRooms = [];

    $('.select-room-btn').click(function () {
        let card = $(this).closest('.room-card');
        let roomId = card.data('room-id');
        let name = card.find('#name').text();
        let thumbnail = card.find('img').data('thumbnails');
        let pricePerNight = card.find('.position-absolute').text().split('/')[0].trim(); // Extract price from the text
        let hotelId = $('input[name="hotel_id"]').val(); // Get hotel ID from the hidden input

        if (selectedRooms.some(room => room.room_id === roomId)) {
            // Deselect room
            selectedRooms = selectedRooms.filter(room => room.room_id !== roomId);
            card.removeClass('border-primary').addClass('border-light');
            $(this).text("Select Room").removeClass('btn-danger').addClass('btn-primary');
        } else {
            // Select room
            selectedRooms.push({
                room_id: roomId,
                name: name,
                price_per_night: pricePerNight,
                hotel_id: hotelId,
                thumbnail: thumbnail
            });
            card.removeClass('border-light').addClass('border-primary');
            $(this).text("Deselect Room").removeClass('btn-primary').addClass('btn-danger');
        }

        // Update hidden input field
        $('#selected_rooms').val(selectedRooms.map(room => room.room_id).join(','));

        // Enable or disable the proceed button
        $('#proceed_booking').prop('disabled', selectedRooms.length === 0);

        // Store selected room data in the session via AJAX
        $.ajax({
            url: '{{ route('store.selected.rooms') }}',
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
                selected_rooms: selectedRooms
            },
            success: function(response) {
                // Handle success if needed
            },
            error: function(error) {
                // Handle error if needed
                console.error(error);
            }
        });
    });
});

</script>

    
@endsection