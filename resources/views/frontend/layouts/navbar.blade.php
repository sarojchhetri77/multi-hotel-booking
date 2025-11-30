 <!-- Header Start -->
 <div class="container-fluid bg-dark px-0">
    <div class="row gx-0">
        <div class="col-lg-3 bg-dark d-none d-lg-block">
            <a href="{{url('/')}}" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                <h1 class="m-0 text-light text-uppercase">Roomix</h1>
            </a>
        </div>
        <div class="col-lg-9">
            {{-- <div class="row gx-0 bg-white d-none d-lg-flex">
                <div class="col-lg-7 px-5 text-start">
                    <div class="h-100 d-inline-flex align-items-center py-2 me-4">
                        <i class="fa fa-envelope text-primary me-2"></i>
                        <p class="mb-0">info@example.com</p>
                    </div>
                    <div class="h-100 d-inline-flex align-items-center py-2">
                        <i class="fa fa-phone-alt text-primary me-2"></i>
                        <p class="mb-0">+012 345 6789</p>
                    </div>
                </div>
                <div class="col-lg-5 px-5 text-end">
                    <div class="d-inline-flex align-items-center py-2">
                        <a class="me-3" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="me-3" href=""><i class="fab fa-twitter"></i></a>
                        <a class="me-3" href=""><i class="fab fa-linkedin-in"></i></a>
                        <a class="me-3" href=""><i class="fab fa-instagram"></i></a>
                        <a class="" href=""><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div> --}}
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark p-3 p-lg-0">
                <a href="{{url('/')}}" class="navbar-brand d-block d-lg-none">
                    <h1 class="m-0 text-primary text-uppercase">Roomix</h1>
                </a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="{{url('/')}}" class="nav-item nav-link active">Home</a>
                        {{-- <a href="about.html" class="nav-item nav-link">About</a> --}}
                        {{-- <a href="service.html" class="nav-item nav-link">Services</a> --}}
                        <a href="{{url('hotel/list')}}" class="nav-item nav-link">Hotels</a>
                        {{-- <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="booking.html" class="dropdown-item">Booking</a>
                                <a href="team.html" class="dropdown-item">Our Team</a>
                                <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                            </div>
                        </div> --}}
                        {{-- <a href="contact.html" class="nav-item nav-link">Contact</a> --}}
                    </div>
                    {{-- <a href="https://htmlcodex.com/hotel-html-template-pro" class="btn btn-primary rounded-0 py-4 px-md-5 d-none d-lg-block">Booking<i class="fa fa-arrow-right ms-3"></i></a> --}}
                    <div class="nav-item dropdown" style="margin-right: 30px">
                        {{-- <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">User</a>
                        <div class="dropdown-menu rounded-0 me-5">
                            <a href="{{route('user.dashboard')}}" class="dropdown-item">Dashboard</a>
                            <a href="team.html" class="dropdown-item">Our Team</a>
                            <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                        </div> --}}
                        @auth
                        {{-- <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a> --}}
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="{{ Auth::user()->profile_pic ? asset(Auth::user()->profile_pic) : asset('admin/assets/media/avatars/blank.png') }}"
                                alt="user"
                                style="width: 40px; height: 40px; border-radius: 50%; margin-right:4rem;" />
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0" aria-labelledby="navbarDropdown">
                            <li class="nav-item border-bottom">
                               <p class="text-center">{{Auth::user()->name}}</p> 
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.dashboard') }}" class="nav-link btn text-dark">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-5 text-dark" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Sign Out') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary ms-2" type="submit">Register</a>
                        @endif
                    @endauth
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Header End -->