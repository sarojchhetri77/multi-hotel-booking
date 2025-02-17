@extends('frontend.hotel.layouts.layout')

@section('main-content')
<style>
.contact-section {
    padding: 100px 0;
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    color: white;
  }
  .contact-section h2 {
    font-size: 3rem;
    font-weight: bold;
    margin-bottom: 20px;
    animation: fadeInDown 1s ease-in-out;
  }
  .contact-section p {
    font-size: 1.2rem;
    margin-bottom: 40px;
    animation: fadeInUp 1s ease-in-out;
  }
  .contact-form {
    background: rgba(255, 255, 255, 0.9);
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    animation: fadeIn 1.5s ease-in-out;
  }
  .contact-form .form-control {
    border: none;
    border-bottom: 2px solid #ddd;
    border-radius: 0;
    padding: 10px 0;
    margin-bottom: 20px;
    background: transparent;
    transition: all 0.3s ease;
  }
  .contact-form .form-control:focus {
    border-bottom-color: #6a11cb;
    box-shadow: none;
  }
  .contact-form textarea {
    resize: none;
  }
  .contact-form .btn {
    background: #6a11cb;
    color: white;
    padding: 10px 30px;
    border: none;
    border-radius: 25px;
    transition: all 0.3s ease;
  }
  .contact-form .btn:hover {
    background: #2575fc;
    transform: translateY(-3px);
  }
  .contact-info {
    margin-top: 40px;
    animation: fadeInUp 1s ease-in-out;
  }
  .contact-info h4 {
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 20px;
  }
  .contact-info p {
    font-size: 1rem;
    margin-bottom: 10px;
  }
  .contact-info i {
    font-size: 1.5rem;
    margin-right: 10px;
    color: #6a11cb;
  }

  /* Animations */
  @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
  }
  @keyframes fadeInDown {
    from {
      opacity: 0;
      transform: translateY(-20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
</style>

        <!-- Page Header Start -->
        <div class="container-fluid page-header mb-5 p-0" style="background-image: url('{{ asset('frontend/img/carousel-1.jpg') }}');">
            <div class="container-fluid page-header-inner py-5">
                <div class="container text-center pb-5">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Contact Us</h1>
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
      
          <!-- Description Section -->
        
                    <section class="contact-section">
                        <div class="container"> 
                          <div class="row">
                            <div class="col-lg-6 mx-auto">
                              <!-- Contact Form -->
                              <div class="contact-form">
                                <form method="POST" action="{{route('contact-us.store')}}">
                                    @csrf
                                  <div class="mb-3">
                                     <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                                  </div>
                                  <div class="mb-3">
                                    <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                                  </div>
                                  <div class="mb-3">
                                    <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                                  </div>
                                  <div class="mb-3">
                                    <textarea class="form-control" rows="5" name="message" placeholder="Your Message" required></textarea>
                                  </div>
                                  <input type="hidden" value="{{$hotel->id}}" name="hotel_id">
                                  <div class="text-center">
                                    <button type="submit" class="btn">Send Message</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                          <!-- Contact Info -->
                          <div class="row contact-info text-center mt-5">
                            <div class="col-md-4">
                              <h4><i class="bi bi-geo-alt"></i>Address</h4>
                              <p>123 Main Street, City, Country</p>
                            </div>
                            <div class="col-md-4">
                              <h4><i class="bi bi-envelope"></i>Email</h4>
                              <p>info@example.com</p>
                            </div>
                            <div class="col-md-4">
                              <h4><i class="bi bi-phone"></i>Phone</h4>
                              <p>+1 (123) 456-7890</p>
                            </div>
                          </div>
                        </div>
                      </section>
    
@endsection
