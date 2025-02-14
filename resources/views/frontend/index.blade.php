@extends('frontend.layouts.layout')
@section('main-content')
<style>
    /* Search Container */
.search-container {
    position: relative;
    max-width: 700px;
    margin: 0 auto 4rem auto;
    display: flex;
    align-items: center;
    background: #fff;
    border-radius: 50px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: all 0.3s ease;
    border: 2px solid black;
}

.search-container:focus-within {
    border-color:#feaa2d;
    box-shadow: 0 6px 25px rgba(0, 123, 255, 0.2);
}

/* Search Input */
.search-input {
    width: 100%;
    padding: 1.2rem 2rem;
    border: none;
    outline: none;
    font-size: 1rem;
    background: transparent;
    transition: all 0.3s ease;
    color: #333;
}

.search-input::placeholder {
    color: #999;
    font-weight: 400;
}

.search-input:focus {
    padding-left: 2.5rem;
}

/* Animation for Search Container */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.search-container {
    animation: slideIn 0.6s ease-out;
}

/* Micro-interaction for Input Focus */
@keyframes inputFocus {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.02);
    }
    100% {
        transform: scale(1);
    }
}

.search-input:focus {
    animation: inputFocus 0.3s ease;
}

/* for the popular destination */
.destination-card {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .destination-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
        }

        .card-image {
            height: 250px;
            background-size: cover;
            background-position: center;
            transition: transform 0.5s ease;
        }

        .destination-card:hover .card-image {
            transform: scale(1.1);
        }

        .card-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0));
            color: white;
            padding: 20px;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }

        .destination-card:hover .card-content {
            transform: translateY(0);
        }

        .destination-name {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }

        .destination-description {
            margin: 5px 0 0;
            font-size: 16px;
        }
        .hotel-item {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hotel-item:hover {
    transform: scale(1.05); /* Scale up the card */
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); /* Add a shadow */
}
</style>
     <!-- Carousel Start -->
     <div class="container-fluid p-0 mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="position: relative; height: 100vh;">
            <img class="w-100" src="{{asset('frontend/img/carosel5.jpeg')}}" alt="Image" style="object-fit: cover; height: 100vh;">
            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.5);">
                <div class="p-3" style="max-width: 700px;">
                    <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown">Unmatched Comfort Awaits</h6>
                    <h1 class="display-3 text-white mb-4 animated slideInDown">Book Your Stay at Exclusive Hotels</h1>
                    <a href="#hotel-container" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Our Hotels</a>
                    <a href="{{url('hotel/list')}}" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Book A Hotel</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Booking Start -->
    <div class="container-fluid booking pb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="bg-white shadow" style="padding: 35px;">
                <form action="{{route('hotel.list')}}">
                <div class="row g-2">
                        <div class="col-md-10">
                            <div class="row g-2">
                                <div class="col-md-3">
                                    <div class="location" id="" data-target-input="">
                                        <input type="text" name="location" class="form-control " placeholder="Location" data-target="" data-toggle=""/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div data-target-input="nearest">
                                        <input type="date" class="form-control "
                                            placeholder="Check in" name="check_in_date" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div>
                                        <input type="date" name="check_out_date" class="form-control" placeholder="Check out" data-target="#date2"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="room" id="" data-target-input="">
                                        <input type="number" name="rooms" class="form-control" min="1" placeholder="No. of Room" data-target="" />
                                    </div>
                                </div>
                                {{-- <div class="col-md-3">
                                    <div class="guest-dropdown" style="position: relative;">
                                        <!-- Input field -->
                                        <input type="text" class="form-control" id="guest-input" placeholder="Select Guests" readonly>
                                        
                                        <!-- Dropdown -->
                                        <div id="guest-dropdown-menu" style="display: none; position: absolute; top: 100%; left: 0; background: #fff; border: 1px solid #ddd; width: 100%; padding: 10px; z-index: 1000;">
                                            <div class="form-group">
                                                <label for="adults">Adults:</label>
                                                <input type="number" id="adults" name="adults" class="form-control" value="1" min="1">
                                            </div>
                                            <div class="form-group">
                                                <label for="children">Children:</label>
                                                <input type="number" id="children" name="children" class="form-control" value="0" min="0">
                                            </div>
                                            <div class="form-group">
                                                <label for="rooms">Rooms:</label>
                                                <input type="number" id="rooms" name="rooms" class="form-control" value="1" min="1">
                                            </div>
                                            <button type="button" id="apply-guest-selection" class="btn btn-primary btn-sm mt-2">Apply</button>
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
    <!-- Booking End -->

    {{-- Popular destination --}}
    <div class="container py-5">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title text-center text-primary text-uppercase mb-5">Popular Destination</h6>
            {{-- <h2 class="mb-5">Explore Our <span class="text-primary text-uppercase">Featured Hotels</span></h2> --}}
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4 wow fadeInUp" data-wow-delay="0.1s">
            <!-- Destination Card 1 -->
            <div class="col">
                <a href="{{ url('hotel/list?location=Kathmandu') }}">
                    <div class="destination-card">
                        <div class="card-image" style="background-image: url('https://assets.traveltriangle.com/blog/wp-content/uploads/2015/10/Swayambhunath-in-Kathmandu-Valley-Swayambhunath-temple-is-among-the-best-Nepal-places-to-visit-near-Kathmandu-valley.jpg');"></div>
                            <div class="card-content">
                              <h3 class="destination-name text-white">Kathmandu</h3>
                              <p class="destination-description">City of Temple</p>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Destination Card 2 -->
            <div class="col">
                <a href="{{ url('hotel/list?location=Pokhara') }}">
                <div class="destination-card">
                    <div class="card-image" style="background-image: url('https://dynamic-media-cdn.tripadvisor.com/media/photo-o/0d/d6/96/36/photo4jpg.jpg?w=1200&h=700&s=1');"></div>
                    <div class="card-content">
                        <h3 class="destination-name text-white">Pokhara</h3>
                        <p class="destination-description">City of Lake</p>
                    </div>
                </div>
                </a>
            </div>
            <!-- Destination Card 3 -->
            <div class="col">
                <div class="destination-card">
                    <div class="card-image" style="background-image: url('https://nepaltraveller.com/images/main/1733741403.sidetrackimagebaglung.png');"></div>
                    <div class="card-content">
                        <h3 class="destination-name text-white">Baglung</h3>
                        <p class="destination-description">Nothing</p>
                    </div>
                </div>
            </div>
            <!-- Add more cards as needed -->
        </div>
    </div>

    {{-- end of the popular destination --}}
      <!-- Feature hotel Start -->
      <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title text-center text-primary text-uppercase">Our Featured Hotels</h6>
                <h2 class="mb-5">Explore Our <span class="text-primary text-uppercase">Featured Hotels</span></h2>
            </div>
                <div class="row g-4">
                    @foreach ($hotels as $hotel)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="hotel-item shadow rounded overflow-hidden animate__animated animate__fadeIn">
                            <div class="position-relative">
                                <img class="w-100" width="100%" src="{{asset($hotel->thumbnail)}}" alt="" style="height:15rem">
                            </div>
                            <div class="p-4 mt-2">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0">{{$hotel->name}}</h5>
                                </div>
                                <p class="text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 10.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 7.5 12 7.5 14.5 8.62 14.5 10s-1.12 2.5-2.5 2.5z"></path>
                                    </svg>
                                    {{$hotel->city}},{{$hotel->address}}
                                </p>
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
    <!-- feature End -->
    <!-- hotel Start -->
    <div class="container-xxl py-5" id="hotel-container">
        <div class="container" style="margin-bottom: 6rem">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="search-container">
                    <input type="text" id="searchInput" class="search-input" placeholder="Search hotels by name, city, or address..." />
                </div>
            </div>
    
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title text-center text-primary text-uppercase">Our Hotels</h6>
                <h2 class="mb-5">Explore Our <span class="text-primary text-uppercase">Hotels</span></h2>
            </div>
            <div class="row g-4">
                @foreach ($hotels as $hotel)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="room-item shadow rounded overflow-hidden">
                        <div class="position-relative">
                            <img class="w-100" width="100%" src="{{asset($hotel->thumbnail)}}" alt="" style="height:15rem">
                        </div>
                        <div class="p-4 mt-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="mb-0">{{$hotel->name}}</h5>
                            </div>
                            <p class="text-muted">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 10.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 7.5 12 7.5 14.5 8.62 14.5 10s-1.12 2.5-2.5 2.5z"></path>
                                </svg>
                                {{$hotel->city}},{{$hotel->address}}
                            </p>
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
    <!-- hotel End -->
@endsection
@section('extra-js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $("#searchInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            
            $(".room-item").each(function () {
                var hotelName = $(this).find("h5").text().toLowerCase();
                var hotelLocation = $(this).find("p.text-muted").text().toLowerCase();
                
                if (hotelName.indexOf(value) > -1 || hotelLocation.indexOf(value) > -1) {
                    $(this).parent().show();
                } else {
                    $(this).parent().hide();
                }
            });
        });
    });
</script>

@endsection

        

       


      