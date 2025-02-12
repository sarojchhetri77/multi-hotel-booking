@extends('frontend.layouts.layout')
@section('main-content')


<!-- Carousel Start -->
<div class="container-fluid p-0 mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="position: relative; height: 40vh;">
        <img class="w-100" src="{{ asset('frontend/img/carosel5.jpeg') }}" alt="Image"
            style="object-fit: cover; height: 40vh;">
        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center"
            style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.5);">
            <div class="shadow" style="padding: 35px; background-color: transparent;">
                <form action="{{route('hotel.list')}}" method="get">
                <div class="row g-2">
                    <div class="col-md-10">
                        <div class="row g-2">
                            <div class="col-md-3">
                                <div class="location" id="" data-target-input="">
                                    <input type="text" class="form-control " name="location" value="{{ old('location', $location) }}"
                                        placeholder="Location" data-target="" data-toggle="" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="" data-target-input="nearest">
                                    <input type="date" class="form-control" name="check_in_date"
                                        placeholder="Check in" value="{{ old('checkin', $checkin) }}" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class=""  data-target-input="nearest">
                                    <input type="date" value="{{ old('checkout', $checkout) }}" name="check_out_date"
                                        class="form-control" placeholder="Check out" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="room" id="" data-target-input="">
                                    <input type="number" name="rooms" class="form-control" min="1" value="{{old('rooms',$rooms)}}" placeholder="No. of Room" data-target="" />
                                </div>
                            </div>
                            {{-- <div class="col-md-3">
                                <div class="guest-dropdown" style="position: relative;">
                                    <!-- Input field -->
                                    <input type="text" class="form-control" value="" id="guest-input"
                                        placeholder="Select Guests" readonly>

                                    <!-- Dropdown -->
                                    <div id="guest-dropdown-menu"
                                        style="display: none; position: absolute; top: 100%; left: 0; background: #fff; border: 1px solid #ddd; width: 100%; padding: 10px; z-index: 1000;">
                                        <div class="form-group">
                                            <label for="adults">Adults:</label>
                                            <input type="number" id="adults" name="adults" class="form-control"
                                                value="{{ old('adults', $adults) }}" min="1">
                                        </div>
                                        <div class="form-group">
                                            <label for="children">Children:</label>
                                            <input type="number" id="children" name="children" class="form-control"
                                                value="0" min="0">
                                        </div>
                                        <div class="form-group">
                                            <label for="rooms">Rooms:</label>
                                            <input type="number" id="rooms" name="rooms" class="form-control"
                                                value="1" min="1">
                                        </div>
                                        <button type="button" id="apply-guest-selection"
                                            class="btn btn-primary btn-sm mt-2">Apply</button>
                                    </div>
                                </div>
                            </div> --}}

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
</div>
<div class="container-fluid booking pb-5 wow fadeIn mt-5" data-wow-delay="0.1s">
    <div class="container">

    </div>
</div>
<!-- Carousel End -->
<!-- Room Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title text-center text-primary text-uppercase">Our Hotels</h6>
            {{-- <h1 class="mb-5">Explore Our <span class="text-primary text-uppercase">Hotels</span></h1> --}}
        </div>
        <div class="row g-4">
            @foreach ($hotels as $hotel)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="room-item shadow rounded overflow-hidden">
                        <div class="position-relative">
                            <img class=" w-100" src="{{ asset($hotel->thumbnail) }}" alt="" style="height:15rem">
                            {{-- <small class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">{{$hotel->price}}/Night</small> --}}
                        </div>
                        <div class="p-4 mt-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="mb-0">{{ $hotel->name }}</h5>
                                <div class="ps-2">
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                </div>
                            </div>
                            <p class="text-muted">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 10.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 7.5 12 7.5 14.5 8.62 14.5 10s-1.12 2.5-2.5 2.5z">
                                    </path>
                                </svg>

                                {{ $hotel->city }},{{ $hotel->address }}
                            </p>

                            <div class="d-flex mb-3">
                                {{-- <small class="border-end me-3 pe-3"><i class="fa fa-bed text-primary me-2"></i>3 Bed</small>
                                    <small class="border-end me-3 pe-3"><i class="fa fa-bath text-primary me-2"></i>2 Bath</small>
                                    <small><i class="fa fa-wifi text-primary me-2"></i>Wifi</small> --}}
                            </div>
                            {{-- <p class="text-body mb-3">Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem sed diam stet diam sed stet lorem.</p> --}}
                            <div class="d-flex justify-content-between">
                                <a class="btn btn-sm btn-primary rounded py-2 px-4" href="{{route('hotel.detail',$hotel->slug)}}" target="_blank">View Detail</a>
                                <a class="btn btn-sm btn-dark rounded py-2 px-4" href="{{route('hotelroom.list',$hotel->slug)}}" target="_blank">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Room End -->


@endsection
