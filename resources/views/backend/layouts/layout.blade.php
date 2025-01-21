<!DOCTYPE html>
<html lang="en">

<head>
    <title>Hotel Booking</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- <link rel="shortcut icon" href="{{asset('admin/assets/media/logos/favicon.ico')}}" /> --}}
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{asset('admin/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
    {{-- <link rel="stylesheet" href="{{asset('admin/assets/plugins/custom/ckeditor/style2.css')}}"> --}}
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.2/ckeditor5.css">
    <link rel="stylesheet" href="{{asset('plugins/ckeditor/style.css')}}">  


</head>

<body id="kt_app_body" data-kt-app-header-fixed="true" data-kt-app-header-fixed-mobile="true"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
    data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true"
    data-kt-app-aside-enabled="true" data-kt-app-aside-fixed="true" data-kt-app-aside-push-toolbar="true"
    data-kt-app-aside-push-footer="true" class="app-default">
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            @include('backend.layouts.navbar')
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                @include('backend.layouts.sidebar')
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    @yield('content')
                    <div id="kt_app_footer"
                        class="app-footer align-items-center justify-content-center justify-content-md-between flex-column flex-md-row py-3">
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted fw-semibold me-1">2024&copy;</span>
                            <a href="https://neptechpal.com.np" target="_blank"
                                class="text-gray-800 text-hover-primary">Nep Tech Pal Pvt. Ltd</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-duotone ki-arrow-up">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </div>
    
    <script src="{{asset('admin/assets/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{asset('admin/assets/js/scripts.bundle.js')}}"></script>
    <script src="{{asset('admin/assets/js/custom/toast.js')}}"></script>
    <script>
        $(document).ready(function(){
            
            var successMessage = @json(Session::get('success'));
            var errorMessage = @json(Session::get('error'));
            console.log(successMessage);
            if(successMessage){
                showSuccessToast(successMessage);
            }
            if(errorMessage){
                showErrorToast(errorMessage);
            }
            
        });
    </script>
    <script type="importmap">
        {
            "imports": {
                "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.2/ckeditor5.js",
                "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.2/"
            }
        }
        </script>
 {{-- <script type="module" src="{{asset('admin/assets/plugins/custom/ckeditor/main2.js')}}"></script> --}}
 <script type="module" src="{{asset('plugins/ckeditor/main.js')}}"></script>
    @yield('extra-js')
</body>

</html>
