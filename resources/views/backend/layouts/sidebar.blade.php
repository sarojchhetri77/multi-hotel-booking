<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <div class="d-flex flex-column justify-content-between h-100 hover-scroll-overlay-y my-2 d-flex flex-column"
        id="kt_app_sidebar_main" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="#kt_app_header" data-kt-scroll-wrappers="#kt_app_main" data-kt-scroll-offset="5px">
        <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false"
            class="flex-column-fluid menu menu-sub-indention menu-column menu-rounded menu-active-bg mb-7">
            <div class="menu-item">
                <a class="menu-link {{ Request::segment(0) === 'admin' || Request::segment(1) === 'home' ? 'active' : '' }}"
                    href="{{ url('admin/home') }}">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-element-11 fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                        </i>
                    </span>
                    <span class="menu-title">Dashboard</span>
                </a>
            </div>
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::segment(1) === 'admin' &&Request::segment(2) === 'users' ? 'show' : '' }}">
                <span class="menu-link {{ Request::segment(1) === 'admin' &&Request::segment(2) === 'users' ? 'active' : '' }}">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-some-files fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <span class="menu-title">Users</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Request::segment(1) === 'admin' && Request::segment(2) === 'users' && Request::segment(3) === 'by-status' ? 'show' : '' }}">
                        <span class="menu-link {{Request::segment(1) === 'admin' && Request::segment(2) === 'users' && Request::segment(3) === 'by-status' ? 'active' : '' }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Users By Status</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ Request::segment(1) === 'admin' && Request::segment(2) === 'users' && Request::segment(3) === 'by-status' && Request::segment(4) === 'active' ? 'active' : '' }}" href="{{url('admin/users/by-status/active')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Active Users</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{Request::segment(1) === 'admin' && Request::segment(2) === 'users' && Request::segment(3) === 'by-status' && Request::segment(4) === 'block' ? 'active' : '' }}" href="{{url('admin/users/by-status/block')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Block Users</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ==========for discussion forum------------- --}}
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-some-files fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Discussion Forum</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link {{ Request::segment(1) === 'admin' &&Request::segment(2) === 'category' ? 'active' : '' }}"
                                href="{{ url('admin/category') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-some-files fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Categories</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{Request::segment(1) === 'questions' ? 'active' : '' }}"
                                href="{{ url('questions') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-some-files fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Questions</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{Request::segment(1) === 'report' ? 'active' : '' }}"
                                href="{{ url('admin/report/list') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-some-files fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Question Report</span>
                            </a>
                        </div>
                       
                            {{-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::segment(1) === 'properties' && Request::segment(2) === 'by-category' ? 'show' : '' }}">
                                <span class="menu-link {{ Request::segment(1) === 'properties' && Request::segment(2) === 'by-category' ? 'active' : '' }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">By Status</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <div class="menu-sub menu-sub-accordion">
                                        <div class="menu-item">
                                            <a class="menu-link {{ Request::segment(1) === 'properties' && Request::segment(2) === 'by-status' ? 'active' : '' }}" href="{{url('properties/by-status/archived')}}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Archived</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a class="menu-link {{ Request::segment(1) === 'properties' && Request::segment(2) === 'by-status' ? 'active' : '' }}" href="{{url('properties/by-status/verified')}}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Verified</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a class="menu-link {{ Request::segment(1) === 'properties' && Request::segment(2) === 'by-status' ? 'active' : '' }}" href="{{url('properties/by-status/rejected')}}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Rejected</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a class="menu-link {{ Request::segment(1) === 'properties' && Request::segment(2) === 'by-status' ? 'active' : '' }}" href="{{url('properties/by-status/unverified')}}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Unverified</span>
                                            </a>
                                        </div>
                                </div>
                            </div> --}}
                    </div>
                </div>
                {{-- ---------end of the discussion forum --------------- --}}

                {{-- for blogs --}}
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-some-files fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Blogs</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link"
                                href="{{ url('admin/blogcategory/') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-some-files fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Categories</span>
                            </a>
                        </div>
                     </div>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ Request::segment(1) === 'admin' &&Request::segment(2) === 'blogs' ? 'active' : '' }}"
                                    href="{{ url('admin/blogs') }}">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-some-files fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title">All Blogs List</span>
                                </a>
                            </div>
                    </div>
                </div>
                {{-- end for the blogs --}}
                {{-- for documentation --}}
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-some-files fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Documentation</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link"
                                href="{{ url('admin/doccategory/') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-some-files fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Categories</span>
                            </a>
                        </div>
                     </div>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ Request::segment(1) === 'admin' &&Request::segment(2) === 'blogs' ? 'active' : '' }}"
                                    href="{{ url('admin/document') }}">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-some-files fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title">All Document Title</span>
                                </a>
                            </div>
                    </div>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ Request::segment(1) === 'admin' &&Request::segment(2) === 'blogs' ? 'active' : '' }}"
                                    href="{{ url('admin/content') }}">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-some-files fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title">All Contents</span>
                                </a>
                            </div>
                    </div>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ Request::segment(1) === 'admin' &&Request::segment(2) === 'quizz' ? 'active' : '' }}"
                                    href="{{ url('admin/quizz') }}">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-some-files fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>    
                                    </span>
                                    <span class="menu-title">All Quiz</span>
                                </a>
                            </div>
                    </div>
                </div>
                {{-- end for the documentation --}}
                {{-- Overall Exam --}}
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-some-files fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Exams</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link" href="{{url('admin/exam-question')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Questions</span>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- job section  --}}
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-some-files fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Jobs</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link" href="{{url('admin/job')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">All Jobs</span>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- end of job section  --}}
                {{-- orther utilities --}}
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-some-files fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Others Utilities</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link" href="{{url('admin/policies')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Policies</span>
                            </a>
                        </div>
                    </div>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link" href="{{url('admin/exam-setting')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Exam Setting</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
