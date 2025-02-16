@extends('frontend.hotel.layouts.layout')

@section('main-content')
<style>
    .product-image {
        max-height: 500px;
        object-fit: cover;
        border-radius: 10px;
        transition: transform 0.3s ease;
    }
    .product-image:hover {
        transform: scale(1.02);
    }
    .thumbnail {
        width: 80px;
        height: 80px;
        object-fit: cover;
        cursor: pointer;
        opacity: 0.6;
        transition: opacity 0.3s ease, transform 0.3s ease;
        border-radius: 8px;
        border: 2px solid transparent;
    }
    .thumbnail:hover, .thumbnail.active {
        opacity: 1;
        border-color: #007bff;
        transform: scale(1.1);
    }
    .room-details {
        background: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }
    .room-details h2 {
        font-size: 2rem;
        font-weight: 700;
        color: #333;
    }
    .price {
        font-size: 1.5rem;
        font-weight: 600;
        color: #007bff;
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 12px 24px;
        font-size: 1rem;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .key-features {
        list-style: none;
        padding: 0;
    }
    .key-features li {
        padding: 8px 0;
        font-size: 1rem;
        color: #555;
    }
    .key-features li::before {
        content: "✔";
        color: #007bff;
        margin-right: 10px;
    }
    .product-description {
        margin-top: 40px;
        padding: 30px;
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }
    .product-description p {
        font-size: 1rem;
        line-height: 1.8;
        color: #555;
    }
</style>

<div class="container mt-5">
    <div class="row">
        <!-- Room Images -->
        <div class="col-md-6 mb-4">
            <img src="{{ asset($room->thumbnail) }}" alt="Room Image" class="img-fluid rounded product-image" id="mainImage">
            <div class="d-flex justify-content-start mt-3">
                <img src="{{ asset($room->thumbnail) }}" alt="Thumbnail" class="thumbnail rounded me-2 active" onclick="changeImage(event, this.src)">
                @foreach ($room->images as $image)
                    <img src="{{ asset($image->url) }}" alt="Thumbnail" class="thumbnail rounded me-2" onclick="changeImage(event, this.src)">
                @endforeach
            </div>
        </div>

        <!-- Room Details -->
        <div class="col-md-6">
            <div class="room-details">
                <h2>{{ $room->name }}</h2>
                <div class="price mb-4">RS. {{ $room->price_per_night }} per night</div>
                <button class="btn btn-primary btn-lg mb-4">
                    <i class="bi bi-house"></i> Select Room
                </button>
                <div class="mt-4">
                    <h5>Key Features:</h5>
                    <ul class="key-features">
                        <li>Spacious and comfortable design</li>
                        <li>Free high-speed Wi-Fi</li>
                        <li>Air conditioning and heating</li>
                        <li>Flat-screen TV with premium channels</li>
                        <li>Private bathroom with luxury amenities</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Room Description -->
    <div class="product-description mt-5">
        <h3>Room Description</h3>
        <p>{!! $room->description !!}</p>
    </div>
</div>
@endsection

@section('extra-js')
<script>
    function changeImage(event, src) {
        document.getElementById('mainImage').src = src;
        document.querySelectorAll('.thumbnail').forEach(thumb => thumb.classList.remove('active'));
        event.target.classList.add('active');
    }
</script>
@endsection