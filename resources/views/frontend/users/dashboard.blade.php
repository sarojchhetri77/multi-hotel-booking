@extends('frontend.hotel.layouts.layout')

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
                 <div class="d-flex justify-content-center align-items-center border-bottom">
                         <div class=" image m-3">
                             <img src="{{Auth::user()->profile_pic ? asset(Auth::user()->profile_pic) : asset('admin/assets/media/avatars/blank.png') }}"
                                 alt="User Profile Picture"
                                 style="width: 50px; height: 50px; border-radius: 50%;">
                         </div>
                     <div class="title p-2 flex-grow-1">
                             <h2 class="fs-6">{{Auth::user()->name}}</h2>
                     </div>
                 </div>
                 <div class="">
                         <div class="tag d-flex flex-row flex-lg-column">
                             <ul class="nav nav-pills m-3 flex-row flex-lg-column" id="pills-tab" role="tablist">
                               <li class="nav-item" role="presentation">
                                 <button class="nav-link tabb" id="pills-askquestion-tab" data-bs-toggle="pill" data-bs-target="#pills-askquestion" type="button" role="tab" aria-controls="pills-askquestion" aria-selected="false">Ask Question</button>
                               </li>
                               <li class="nav-item" role="presentation">
                                 <button class="nav-link tabb active" id="pills-question-tab" data-bs-toggle="pill" data-bs-target="#pills-question" type="button" role="tab" aria-controls="pills-question" aria-selected="false">Your Questions</button>
                               </li>
                               <li class="nav-item" role="presentation">
                                 <button class="nav-link tabb" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Profile Details</button>
                               </li>
                               @if (!Auth::user()->google_id)
                               <li class="nav-item" role="presentation">
                                 <button class="nav-link tabb" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Change Password</button>
                               </li>
                               @endif
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
                                         <img height="100px" width="100px" style="border-radius: 50%"
                                             src="{{Auth::user()->profile_pic ? asset(Auth::user()->profile_pic) : asset('admin/assets/media/avatars/blank.png') }}" />
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
                             <form id="passwordForm" action="{{ route('password.change') }}" method="post">
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
                             <form action="{{route('userDetail.update') }}" method="post" enctype="multipart/form-data">
                                 @csrf
                                 <div class="row mb-4">
                                     <label class="col-lg-4 fw-semibold text-muted">Profile Picture</label>
                                     <div class="col-lg-8 pic">
                                         <div class="">
                                             <img id="profilePicPreview" height="100px" width="100px" style="border-radius: 50%"
                                                 src="{{Auth::user()->profile_pic ? asset(Auth::user()->profile_pic) : asset('admin/assets/media/avatars/blank.png') }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Change image" />
                                                 <input type="file" class="form-control" id="profile_pic" name="profile_pic" aria-describedby="textHelp">
                                         </div>
                                     </div>
                                 </div>
                                 <div class="mb-3">
                                     <label for="name" class="form-label">Name</label>
                                     <input type="text" class="form-control" id="name" name="name" value="{{auth()->user()->name}}">
                                 </div>
                                 {{-- <div class="mb-3">
                                     <label for="email" class="form-label">Email</label>
                                     <input type="text" class="form-control" id="email" name="email" value="{{auth()->user()->email}}">
                                 </div> --}}
                                 <div class="mb-3">
                                     <label for="phone" class="form-label">Phone Number</label>
                                     <input type="number" class="form-control" id="phone" name="phone_number" value="{{auth()->user()->phone_number}}">
                                 </div>
                                 <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                             </form>
                         </div>
                     </div>
                     <div class="tab-pane fade show active " id="pills-question" role="tabpanel" aria-labelledby="pills-question-tab">
                         <div class="p-3 border-bottom">
                             <h5>Your Question List</h5>
                         </div>
                         @foreach ($questions as $question)
                         {{-- <a href="{{route('question.detail',$question->slug)}}" class="text-decoration-none text-dark"> --}}
                             <div class="card m-3 border-0 position-relative bg-light shadow-sm card-hover question" data-category-ids="{{ $question->categories->pluck('id')->implode(',') }}"    data-created-at="{{ $question->created_at }}"
                                 data-watch-count="{{ $question->watch_count }}"
                                 data-likes="{{ $question->likes }}"
                                 data-title="{{$question->title}}">
                                 <div class="d-flex">
                                     <div class="image m-3 d-none d-md-block">
                                         <div class="">
                                             <img src="{{ $question->user->profile_pic ? asset($question->user->profile_pic) : asset('admin/assets/media/avatars/blank.png') }}"
                                                 alt="User Profile Picture"
                                                 style="width: 50px; height: 50px; border-radius: 50%;">
                                         </div>
                                     </div>
                                     <div class="title p-2 flex-grow-1" style= "width: 70%">
                                         <div class="card-content">
                                             <h2 class="fs-6">{{$question->title}}</h2>
                                             <div class="d-flex p-3 position-absolute right-0 end-0">
                                                         @foreach ($question->categories as $category)
                                                             <span class="badge bg-success">{{ $category->title }}</span>
                                                         @endforeach
                                             </div>
                                         </div>
                                         <p style="margin-top: -20px; word-wrap: break-word; overflow-wrap: break-word; white-space: normal;">
                                             {!! Str::words($question->description, 10, '...') !!}
                                         </p>                                        
                                         <p style="margin-top:-8px">Published <small>{{ $question->created_at->diffForHumans() }}</small></p>
                                     </div>
                                 </div>
                                 <div class="d-flex align-items-center px-3 pb-3 w-100 overflow-hidden" style="font-size: 15px">
                                     <span>{{$question->likes}}</span> <span class="ps-2">likes</span>
                                     <span class="ps-3">{{$question->watch_count}}</span> <span class="ps-2">watched</span>
                                    <a href="{{route('question.detail',$question->slug)}}" class="text-dark text-decoration-none"><span class="ps-3">{{$question->answers->count()}}</span> <span class="ps-2">commented</span></a>
                                 </div>
                                 <div class="position-absolute bottom-0 end-0">
                                     {{-- <div class="askquestion"> --}}
                                         <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                         data-bs-target="#exampleModal{{$question->id}}">
                                         Edit
                                     </button>
                                     {{-- model for the discussion --}}
                                         <div class="modal  fade" id="exampleModal{{$question->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                             aria-hidden="true">
                                             <div class="modal-dialog modal-lg modal-dialog-centered">
                                                 <div class="modal-content">
                                                     <div class="modal-header">
                                                         <h5 class="modal-title" id="exampleModalLabel">Edit Question</h5>
                                                         <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                             aria-label="Close"></button>
                                                     </div>
                                                     <form class="discussionFormUpdate" action="{{route('question.update',$question->slug)}}" method="POST" enctype="multipart/form-data">
                                                         @csrf
                                                         @method('put')
                                                     <div class="modal-body text-start">
                                                         <div class="mb-3">
                                                             <label for="title" class="form-label">Title Of Discussion</label>
                                                             <input type="text" name="title" value="{{$question->title}}" class="form-control titless" aria-describedby="textHelp">
                                                             <div id="titleErrorss" class="text-danger"></div>
                                                         </div>
                                                         <div class="input-group mb-3">
                                                             <label class="input-group-text" for="tag">Choose Tags</label>
                                                             <select class="form-select tagss"  name="category[]">
                                                                 @foreach ($categories as $category)
                                                                 <option value="{{ $category->id }}" 
                                                                     {{ isset($question) && $question->categories->pluck('id')->contains($category->id) ? 'selected' : '' }}>
                                                                     {{ $category->title }}
                                                                 </option>                                                              
                                                                  @endforeach
                                                             </select>
                                                             <div id="tagsErrorss" class="text-danger"></div>
                                                         </div>
                                                         <div class="mb-3">
                                                             <label for="description" class="form-label">Description</label>
                                                             <textarea class="form-control ckeditor-editor descriptionss @error('description') is-invalid @endif" name="description" rows="3">{{$question->description}}</textarea>
                                                             <div id="descriptionErrorss" class="text-danger"></div>
                                                             @error('description')
                                                             <span class="invalid-feedback" role="alert">
                                                                 <strong>{{ $message }}</strong>
                                                             </span>
                                                         @enderror
                                                         </div>
                                                     </div>
                                                     <div class="modal-footer">
                                                         <button type="button" class="btn btn-secondary"
                                                             data-bs-dismiss="modal">Close</button>
                                                         <button type="submit" class="btn btn-primary">Save changes</button>
                                                     </div>
                                                 </form>
                                                 </div>
                                             </div>
                                         </div>
                                         {{-- end of the model of discussion --}}
                                     {{-- </div> --}}
                                     {{-- <a href="" class="btn btn-primary btn-sm ms-2">Delete</a> --}}
                                     {{-- to delete the question --}}
                                     <form class="d-inline" action="{{ route('question.destroy', $question->id) }}"
                                         method="POST">
                                         @csrf
                                         @method('delete')
                                         <button type="submit" onclick="return confirm('Are you want to delete')" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                     </form>
 
                                 </div>
                             </div>
                         {{-- </a> --}}
                         @endforeach
                         <div class="p-2">
                             {{$questions->links()}}
                         </div>
                     </div>
                     <div class="tab-pane fade" id="pills-askquestion" role="tabpanel" aria-labelledby="pills-askquestion-tab">
                         <div class="p-3 border-bottom">
                             <h5>Ask Question</h5>
                         </div>
                         <div>
                             <form id="discussionFormss" action="{{route('questions.store')}}" method="POST" enctype="multipart/form-data">
                                 @csrf
                             <div class="modal-body text-start">
                                 <div class="mb-3">
                                     <label for="title" class="form-label">Title Of Discussion</label>
                                     <input type="text" name="title" class="form-control" id="titless" aria-describedby="textHelp">
                                     <div id="titleErrors" class="text-danger"></div>
                                 </div>
                                 <div class="input-group mb-3">
                                     <label class="input-group-text" for="tag">Choose Tags</label>
                                     <select class="form-select" id="tagss" name="category[]">
                                         @foreach ($categories as $category)
                                         <option value="{{$category->id}}">{{$category->title}}</option>
                                         @endforeach
                                     </select>
                                     <div id="tagsErrors" class="text-danger"></div>
                                 </div>
 
                                 <div class="mb-3">
                                     <label for="description" class="form-label">Description</label>
                                     <textarea class="form-control ckeditor-editor" name="description" id="descriptionss" rows="3"></textarea>
                                     <div id="descriptionErrors" class="text-danger"></div>
                                 </div>
                             </div>
                             <div class="p-2">
                                 <button type="submit" class="btn btn-primary">Create</button>
                             </div>
                         </form>
                         </div>
                     </div>
                     <div class="tab-pane fade p-3" id="pills-policy" role="tabpanel" aria-labelledby="pills-policy-tab">
                         @foreach ($usercontents as $content)
                         <a href="{{route('usercontent.edit',$content->id)}}" class="text-decoration-none text-dark">
                         <div class="card cards p-3 mb-3 ">
                             <p class="fw-bold fs-2">Privacy Policy for {{$content->app_name}}</p>
                             <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda, reiciendis.</p>
                         </div>
                       </a>
                         @endforeach
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </main>
    
@endsection