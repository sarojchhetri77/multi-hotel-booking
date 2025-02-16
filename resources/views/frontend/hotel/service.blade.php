@extends('frontend.hotel.layouts.layout')

@section('main-content')

        <!-- Page Header Start -->
        <div class="container-fluid page-header mb-5 p-0" style="background-image: url('{{ asset('frontend/img/carousel-1.jpg') }}');">
            <div class="container-fluid page-header-inner py-5">
                <div class="container text-center pb-5">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Our Services</h1>
                    {{-- <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Rooms</li>
                        </ol>
                    </nav> --}}
                </div>
            </div>
        </div>
        <!-- Page Header End -->
        <style>
            .description-section {
              font-family: 'Arial', sans-serif;
              line-height: 1.8;
              color: #333;
            }
            .description-section h2 {
              font-size: 2rem;
              font-weight: bold;
              margin-top: 2rem;
              margin-bottom: 1rem;
            }
            .description-section h3 {
              font-size: 1.75rem;
              font-weight: bold;
              margin-top: 1.5rem;
              margin-bottom: 1rem;
            }
            .description-section p {
              font-size: 1.1rem;
              margin-bottom: 1.5rem;
            }
            .description-section img {
              max-width: 100%;
              height: auto;
              border-radius: 8px;
              margin: 1rem 0;
            }
            .description-section ul, .description-section ol {
              margin-bottom: 1.5rem;
              padding-left: 1.5rem;
            }
            .description-section a {
              color: #0d6efd;
              text-decoration: none;
            }
            .description-section a:hover {
              text-decoration: underline;
            }
          </style>
        </head>
        <body>
        
          <!-- Description Section -->
          <section class="description-section py-5">
            <div class="container">
              <div class="row">
                <div class="col-lg-8 mx-auto">
                  <p>
                    {!! $services->long_description !!}
                  </p>
        
                  
                </div>
              </div>
            </div>
          </section>
    
@endsection
