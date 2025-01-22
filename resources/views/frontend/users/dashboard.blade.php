@extends('frontend.layouts.layout')

@section('main-content')
<style>
    .tabb.active {
        background-color: #58acf0 !important;
        color: white !important;
        /* width: 300px; */
 }
 .tabb{
    color:black;
 }
 .tabb:hover{
    color: black;
 }
 .filter {
    z-index: 1020; 
    top: 0;
 }
  .navbar {
     z-index: 1030; 
 }
 .sticky-filter {
   position: sticky;
   top: 77px; 
 }
 @media  screen and (max-width:600px) {
  .card{
     /* background: #58acf0!important; */
     width: 100%;
     margin: 0px 0px 10px 0px!important;
     padding: 0px!important;
  }
  .pic{
     margin-top:0px!important;
  }
  
 
 }
 .pic {
             position: relative;
             display: inline-block;
         }
         .pic img {
             border-radius: 50%;
             cursor: pointer; /* Makes the image look clickable */
         }
         #profile_pic {
             display: none; /* Hide the file input */
         }
         .tab-pane {
         background-color: #f8f9fa; /* Light gray background */
         border-radius: 8px;
     }
 
     .cards {
         border: none;
         transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
         background: #ffffff; /* White background */
         border-radius: 10px;
         box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
     }
 
     .cards:hover {
         transform: scale(1.02);
         box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
     }
 
     .cards p.fw-bold {
         color: #007bff;
         margin-bottom: 5px;
     }
 
     .cards p:last-child {
         color: #6c757d; 
         font-size: 1rem;
     }
 
     .text-dark:hover {
         text-decoration: underline;
         color: #0056b3;
     }
   
 </style>
 <main class="container-fluid">
     <div class="row g-2">
         <div class="col-lg-4" style="">
             <div class="card m-4 border-0 shadow filter sticky-filter position-sticky" style="">
                 {{-- <div class="d-flex justify-content-center align-items-center border-bottom">
                         <div class=" image m-3">
                             <img src="{{Auth::user()->profile_pic ? asset(Auth::user()->profile_pic) : asset('admin/assets/media/avatars/blank.png') }}"
                                 alt="User Profile Picture"
                                 style="width: 50px; height: 50px; border-radius: 50%;">
                         </div>
                     <div class="title p-2 flex-grow-1">
                             <h2 class="fs-6">{{Auth::user()->name}}</h2>
                     </div>
                 </div> --}}
                 <div class="">
                         <div class="tag d-flex flex-row flex-lg-column">
                             <ul class="nav nav-pills m-3 flex-row flex-lg-column" id="pills-tab" role="tablist">
                               <li class="nav-item" role="presentation">
                                 <button class="nav-link tabb" id="pills-askquestion-tab" data-bs-toggle="pill" data-bs-target="#pills-askquestion" type="button" role="tab" aria-controls="pills-askquestion" aria-selected="false">Register Hotel</button>
                               </li>
                               <li class="nav-item" role="presentation">
                                 <button class="nav-link tabb active" id="pills-question-tab" data-bs-toggle="pill" data-bs-target="#pills-question" type="button" role="tab" aria-controls="pills-question" aria-selected="false">Your Hotel</button>
                               </li>
                               <li class="nav-item" role="presentation">
                                 <button class="nav-link tabb" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Profile Details</button>
                               </li>
                               {{-- @if (!Auth::user()->google_id) --}}
                               <li class="nav-item" role="presentation">
                                 <button class="nav-link tabb" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Change Password</button>
                               </li>
                               {{-- @endif --}}
                               <li class="nav-item" role="presentation">
                                 <button class="nav-link tabb" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Setting</button>
                               </li>
                               <li class="nav-item" role="presentation">
                                 <button class="nav-link tabb" id="pills-policy-tab" data-bs-toggle="pill" data-bs-target="#pills-policy" type="button" role="tab" aria-controls="pills-policy" aria-selected="false">Policy Generator</button>
                               </li>
                             </ul>
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-lg-8" style="min-height: 100vh">
             <div class="card shadow m-4 border-0" style="min-height: 80vh">
                 <div class="tab-content" id="pills-tabContent">
                     <div class="tab-pane fade  " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                         <div class="p-3 border-bottom">
                             <h5>Profile Details</h5>
                         </div>
                         <div class="card-body p-5">
                             <div class="row mb-4">
                                 <label class="col-lg-4 fw-semibold text-muted">Profile Pic</label>
                                 <div class="col-lg-8 pic" style="margin-top: -20px">
                                     <div class="">
                                         {{-- <img height="100px" width="100px" style="border-radius: 50%"
                                             src="{{Auth::user()->profile_pic ? asset(Auth::user()->profile_pic) : asset('admin/assets/media/avatars/blank.png') }}" /> --}}
                                     </div>
                                 </div>
                             </div>
                             <div class="row mb-4">
                                 <label class="col-lg-4 fw-semibold text-muted">Full Name</label>
                                 <div class="col-lg-8">
                                     <span class="fw-bold fs-6 text-gray-800">{{Auth::user()->name}}</span>
                                 </div>
                             </div>
                             <div class="row mb-4">
                                 <label class="col-lg-4 fw-semibold text-muted">Email</label>
                                 <div class="col-lg-8 fv-row">
                                     <span class="fw-semibold text-gray-800 fs-6">{{Auth::user()->email}}</span>
                                 </div>
                             </div>
                             <div class="row mb-4">
                                 <label class="col-lg-4 fw-semibold text-muted">Contact Phone</label>
                                 <div class="col-lg-8">
                                     <span class="fw-bold fs-6 text-gray-800 me-2">{{Auth::user()->phone_number}}</span>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                         <div class="p-3 border-bottom">
                             <h5>Change Password</h5>
                         </div>
                         <div class="card-body p-5">
                             <form id="passwordForm" action="" method="post">
                                 @csrf
                                 <div class="mb-3">
                                     <label for="oldpassword" class="form-label">Old Password</label>
                                     <input type="password" class="form-control" id="oldpassword" name="old_password" aria-describedby="oldPasswordHelp">
                                     <span id="oldPasswordError" class="text-danger"></span>
                                 </div>
                                 <div class="mb-3">
                                     <label for="newpassword" class="form-label">New Password</label>
                                     <input type="password" class="form-control" id="newpassword" name="new_password" aria-describedby="newPasswordHelp">
                                     <span id="newPasswordError" class="text-danger"></span>
                                 </div>
                                 <div class="mb-3">
                                     <label for="confirmpassword" class="form-label">Confirm Password</label>
                                     <input type="password" class="form-control" id="confirmpassword" name="c_password" aria-describedby="confirmPasswordHelp">
                                     <span id="confirmPasswordError" class="text-danger"></span>
                                 </div>
                                 <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                             </form>
                             
                         </div>
                     </div>
                     <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                         <div class="p-3 border-bottom">
                             <h5>Update Profile Details</h5>
                         </div>
                         <div class="card-body">
                          
                         </div>
                     </div>
                     <div class="tab-pane fade show active " id="pills-question" role="tabpanel" aria-labelledby="pills-question-tab">
                         <div class="p-3 border-bottom">
                             <h5>Manage your hotel</h5>
                         </div>
                         @if (auth()->user()->hotel)
                             
                         <div>
                            <a href="" class="btn btn-primary">Manage Hotel</a>
                         </div>
                         @endif
                        
                     </div>
                     <div class="tab-pane fade" id="pills-askquestion" role="tabpanel" aria-labelledby="pills-askquestion-tab">
                         <div class="p-3 border-bottom">
                             <h5>Enter the details of your hotel</h5>
                         </div>
                         <div class="card-body py-4">
                            <form action="{{ route('hotel.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12  mb-7">
                                        <label class="col-lg-4 fw-semibold text-muted required">Name</label>
                                        <div class="col-lg-12">
                                            <input type="text" name="name"
                                                class="form-control mb-lg-0 @error('name') is-invalid @enderror"
                                                placeholder="Enter Title" value="{{ old('name') }}" />
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12  mb-7">
                                        <label class="col-lg-4 fw-semibold text-muted required">Address</label>
                                        <div class="col-lg-12">
                                            <input type="text" name="address"
                                                class="form-control mb-lg-0 @error('address') is-invalid @enderror"
                                                placeholder="Enter Title" value="{{ old('address') }}" />
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12  mb-7">
                                        <label class="col-lg-4 fw-semibold text-muted required">District</label>
                                        <div class="col-lg-12">
                                            <input type="text" name="district"
                                                class="form-control mb-lg-0 @error('district') is-invalid @enderror"
                                                placeholder="Enter Title" value="{{ old('district') }}" />
                                            @error('district')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12  mb-7">
                                        <label class="col-lg-4 fw-semibold text-muted required">City</label>
                                        <div class="col-lg-12">
                                            <input type="text" name="city"
                                                class="form-control mb-lg-0 @error('city') is-invalid @enderror"
                                                placeholder="Enter Title" value="{{ old('city') }}" />
                                            @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12  mb-7">
                                        <label class="col-lg-4 fw-semibold text-muted required">Street No</label>
                                        <div class="col-lg-12">
                                            <input type="number" name="street_no"
                                                class="form-control mb-lg-0 @error('street_no') is-invalid @enderror"
                                                placeholder="Enter Title" value="{{ old('street_no') }}" />
                                            @error('street_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12  mb-7">
                                        <label class="col-lg-4 fw-semibold text-muted required">Total Rooms</label>
                                        <div class="col-lg-12">
                                            <input type="number" name="room_number"
                                                class="form-control mb-lg-0 @error('room_number') is-invalid @enderror"
                                                placeholder="Enter Title" value="{{ old('room_number') }}" />
                                            @error('room_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12  mb-7">
                                        <label class="col-lg-4 fw-semibold text-muted required">Thumbnail</label>
                                        <div class="col-lg-12">
                                            <input type="file" name="thumbnail"
                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('thumbnail') is-invalid @enderror"
                                                placeholder="Choose Icon" value="{{ old('thumbnail') }}" accept="image/*"/>
                                            @error('thumbnail')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12  mb-7">
                                        <label class="col-lg-4 fw-semibold text-muted"> Hotel Description</label>
                                        <div class="col-lg-12">
                                            <textarea name="description"  id="description"
                                                class="form-control form-control-lg ckeditor-editor  @error('description') is-invalid @endif">{{old('description')}}</textarea>
                                        </div>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}
                                    <div class="col-md-12 mb-7">
                                            <input type="submit" class="btn btn-success" value="Submit">
                                        </div>
                                    </div>
                                </form>
                            </div>
                     </div>
                     <div class="tab-pane fade p-3" id="pills-policy" role="tabpanel" aria-labelledby="pills-policy-tab">
                        
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </main>
    
@endsection