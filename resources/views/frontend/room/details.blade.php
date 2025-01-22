@extends('frontend.hotel.layouts.layout')

@section('main-content')
<style>
    .product-image {
            max-height: 400px;
            object-fit: cover;
        }
        .thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            cursor: pointer;
            opacity: 0.6;
            transition: opacity 0.3s ease;
        }
        .thumbnail:hover, .thumbnail.active {
            opacity: 1;
        }
</style>
<div class="container mt-5">
    <div class="row">
        <!-- Product Images -->
        <div class="col-md-6 mb-4">
            <img src="{{asset($room->thumbnail)}}" alt="Product" class="img-fluid rounded mb-3 product-image" id="mainImage">
            <div class="d-flex justify-content-between">
                <img src="{{asset($room->thumbnail)}}" alt="Thumbnail 1" class="thumbnail rounded active" onclick="changeImage(event, this.src)">
                @foreach ($room->images as $image)
                <img src="{{asset($image->url)}}" alt="Thumbnail 1" class="thumbnail rounded" onclick="changeImage(event, this.src)">
                @endforeach
                
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <h2 class="mb-3">{{$room->name}}</h2>
            {{-- <p class="text-muted mb-4">SKU: WH1000XM4</p> --}}
            <div class="mb-3">
                <span class="h4 me-2"> RS.  {{$room->price_per_night}} per night</span>
                {{-- <span class="text-muted"><s>$399.99</s></span> --}}
            </div>
            {{-- <p class="mb-4">{!! $room->description !!}</p> --}}
            <button class="btn btn-primary btn-lg mb-3 me-2">
                    <i class="bi bi-house"></i> Select Room
                </button>
            <div class="mt-4">
                <h5>Key Features:</h5>
                <ul>
                    <li>Industry-leading noise cancellation</li>
                    <li>30-hour battery life</li>
                    <li>Touch sensor controls</li>
                    <li>Speak-to-chat technology</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="product-desciption">
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