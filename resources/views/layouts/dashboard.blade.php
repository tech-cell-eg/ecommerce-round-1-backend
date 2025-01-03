<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Stellar Admin</title>
    
    <!-- CSS links -->
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMFZL8436JM8V0cE82WTSK5tPHkH6E6D1A4L8T" crossorigin="anonymous">
    
    <!-- Simple Line Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    
    <!-- Flag Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icons.min.css') }}">
    
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    
    <!-- Plugin CSS for specific plugins -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/chartist/chartist.min.css') }}">
    
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/vertical-light-layout/style.css') }}">
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
</head>

<body>


    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="#">
                <img src="{{asset('assets/images/logo.svg')}}" alt="logo" class="logo-dark" />
                <img src="{{asset('assets/images/logo-light.svg')}}" alt="logo-light" class="logo-light">
            </a>
            <a class="navbar-brand brand-logo-mini" href="#"><img src="{{asset('assets/images/logo-mini.svg')}}" alt="logo" /></a>
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
            <h5 class="mb-0 font-weight-medium d-none d-lg-flex">Welcome dashboard!</h5>
            <ul class="navbar-nav navbar-nav-right">
                <form class="search-form d-none d-md-block" action="#">
                    <i class="icon-magnifier"></i>
                    <input type="search" class="form-control" placeholder="Search Here" title="Search here">
                </form>
                <li class="nav-item"><a href="#" class="nav-link"><i class="icon-basket-loaded"></i></a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="icon-chart"></i></a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link count-indicator message-dropdown" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="icon-speech"></i>
                        <span class="count">7</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
                        <a class="dropdown-item py-3">
                            <p class="mb-0 font-weight-medium float-start me-2">You have 7 unread mails </p>
                            <span class="badge badge-pill badge-primary float-end">View all</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <img src="{{asset('assets/images/faces/face10.jpg')}}" alt="image" class="img-sm profile-pic">
                            </div>
                            <div class="preview-item-content flex-grow py-2">
                                <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                                <p class="font-weight-light small-text"> The meeting is cancelled </p>
                            </div>
                        </a>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <img src="{{asset('assets/images/faces/face12.jpg')}}" alt="image" class="img-sm profile-pic">
                            </div>
                            <div class="preview-item-content flex-grow py-2">
                                <p class="preview-subject ellipsis font-weight-medium text-dark">David Grey </p>
                                <p class="font-weight-light small-text"> The meeting is cancelled </p>
                            </div>
                        </a>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <img src="{{asset('assets/images/faces/face1.jpg')}}" alt="image" class="img-sm profile-pic">
                            </div>
                            <div class="preview-item-content flex-grow py-2">
                                <p class="preview-subject ellipsis font-weight-medium text-dark">Travis Jenkins </p>
                                <p class="font-weight-light small-text"> The meeting is cancelled </p>
                            </div>
                        </a>
                    </div>
                </li>

            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="icon-menu"></span>
            </button>
        </div>
    </nav>




    </div>
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="#">
                <img src="{{asset('assets/images/logo.svg')}}" alt="logo" class="logo-dark" />
                <img src="{{ asset('assets/images/logo-light.svg') }}" alt="logo-light" class="logo-light">
            </a>
            <a class="navbar-brand brand-logo-mini" href="#"><img src="{{ asset('assets/images/logo-mini.svg')}}" alt="logo" /></a>
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
            <h5 class="mb-0 font-weight-medium d-none d-lg-flex">Welcome dashboard!</h5>
            <ul class="navbar-nav navbar-nav-right">
                <form class="search-form d-none d-md-block" action="#">
                    <i class="icon-magnifier"></i>
                    <input type="search" class="form-control" placeholder="Search Here" title="Search here">
                </form>
                <li class="nav-item"><a href="#" class="nav-link"><i class="icon-basket-loaded"></i></a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="icon-chart"></i></a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link count-indicator message-dropdown" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="icon-speech"></i>
                        <span class="count">7</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
                        <a class="dropdown-item py-3">
                            <p class="mb-0 font-weight-medium float-start me-2">You have 7 unread mails </p>
                            <span class="badge badge-pill badge-primary float-end">View all</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <img src="{{asset('assets/images/faces/face10.jpg')}}" alt="image" class="img-sm profile-pic">
                            </div>
                            <div class="preview-item-content flex-grow py-2">
                                <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                                <p class="font-weight-light small-text"> The meeting is cancelled </p>
                            </div>
                        </a>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <img src="{{asset('assets/images/faces/face12.jpg')}}" alt="image" class="img-sm profile-pic">
                            </div>
                            <div class="preview-item-content flex-grow py-2">
                                <p class="preview-subject ellipsis font-weight-medium text-dark">David Grey </p>
                                <p class="font-weight-light small-text"> The meeting is cancelled </p>
                            </div>
                        </a>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <img src="{{asset('assets/images/faces/face1.jpg')}}" alt="image" class="img-sm profile-pic">
                            </div>
                            <div class="preview-item-content flex-grow py-2">
                                <p class="preview-subject ellipsis font-weight-medium text-dark">Travis Jenkins </p>
                                <p class="font-weight-light small-text"> The meeting is cancelled </p>
                            </div>
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown language-dropdown d-none d-sm-flex align-items-center">
                    <a class="nav-link d-flex align-items-center dropdown-toggle" id="LanguageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="d-inline-flex">
                            <i class="flag-icon flag-icon-us"></i>
                        </div>
                        <span class="profile-text font-weight-normal">English</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left navbar-dropdown py-2" aria-labelledby="LanguageDropdown">
                        <a class="dropdown-item">
                            <i class="flag-icon flag-icon-us"></i> English </a>
                        <a class="dropdown-item">
                            <i class="flag-icon flag-icon-fr"></i> French </a>
                        <a class="dropdown-item">
                            <i class="flag-icon flag-icon-ae"></i> Arabic </a>
                        <a class="dropdown-item">
                            <i class="flag-icon flag-icon-ru"></i> Russian </a>
                    </div>
                </li>
                <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
                    <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="img-xs rounded-circle ms-2" src="{{asset('storage/' .Auth::user()->image)}}" alt="Profile image"> <span class="font-weight-normal"> {{Auth::user()->name}} </span></a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                        <div class="dropdown-header text-center">
                            <!-- <img class="img-md rounded-circle" src="{{asset('assets/images/faces/face8.jpg')}}" alt="Profile image"> -->
                            <img class="img-md rounded-circle" src="{{asset('storage/' .Auth::user()->image)}}" alt="Profile image" width="100" height="100">
                            <p class="mb-1 mt-3">{{Auth::user()->name}}</p>
                            <p class="font-weight-light text-muted mb-0">{{Auth::user()->email}}</p>
                        </div>
                        <a class="dropdown-item"><i class="dropdown-item-icon icon-user text-primary"></i> My Profile <span class="badge badge-pill badge-danger">1</span></a>
                        <a class="dropdown-item"><i class="dropdown-item-icon icon-speech text-primary"></i> Messages</a>
                        <a class="dropdown-item"><i class="dropdown-item-icon icon-energy text-primary"></i> Activity</a>
                        <a class="dropdown-item"><i class="dropdown-item-icon icon-question text-primary"></i> FAQ</a>
                        <a href="{{route('admin.logout')}}" class="dropdown-item"><i class="dropdown-item-icon icon-power text-primary"></i>Sign Out</a>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="icon-menu"></span>
            </button>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item navbar-brand-mini-wrapper">
                    <a class="nav-link navbar-brand brand-logo-mini" href="#"><img src="{{asset('assets/images/logo-mini.svg')}}" alt="logo" /></a>
                </li>
                <li class="nav-item nav-profile">
                    <a href="#" class="nav-link">
                        <div class="profile-image">
                            <img class="img-xs rounded-circle" src="{{asset('storage/' .Auth::user()->image)}}" alt="profile image">
                            <div class="dot-indicator bg-success"></div>
                        </div>
                        <div class="text-wrapper">
                            <p class="profile-name">{{Auth::user()->name}}</p>
                            <p class="designation">{{ strtoupper( Auth::user()->getRoleNames()->first() )}}</p>
                        </div>
                        <div class="icon-container">
                            <i class="icon-bubbles"></i>
                            <div class="dot-indicator bg-danger"></div>
                        </div>
                    </a>
                </li>
                <li class="nav-item nav-category">
                    <span class="nav-link">Dashboard</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.dashboard')}}">
                        <span class="menu-title">Dashboard</span>
                        <i class="icon-screen-desktop menu-icon"></i>
                    </a>
                </li>

                @hasanyrole('Product Manager|super-admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index') }}">
                        <span class="menu-title">Product</span>
                        <i class="icon-globe menu-icon"></i>
                    </a>
                    <div class="collapse" id="icons">
                        <ul class="nav flex-column sub-menu">
                        
                        @can('product-list')
                            <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">All Products</a></li>
                        @endcan
                            <li class="nav-item"><a class="nav-link" href="{{ route('products.create') }}">Add Product</a></li>
                            
                        </ul>
                    </div>
                </li>
                @endhasanyrole



                @hasanyrole('Category Manager|super-admin')
                <li class="nav-item">
                    @can('category-list')
                    <a class="nav-link" href="{{route('category.index')}}">
                    @endcan
                        <span class="menu-title">Category</span>
                        <i class="icon-book-open menu-icon"></i>
                    </a>
                    <div class="collapse" id="forms">
                        <ul class="nav flex-column sub-menu">
                            @can('category-list')
                            <li class="nav-item"> <a class="nav-link" href="{{route('category.index')}}">All Categories</a></li>
                            @endcan
                            @can('category-create')
                            <li class="nav-item"> <a class="nav-link" href="{{route('category.create')}}">Add Category</a></li>
                            @endcan
                            <li class="nav-item"> <a class="nav-link" href="{{route('subCategory.index')}}">All Sub Categories</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{route('subCategory.create')}}">Add Sub Category</a></li>
                        </ul>
                    </div>
                </li>
                @endhasanyrole

                @hasanyrole('Testimonials Manager|super-admin')
                <li class="nav-item">
                        @can('testimonials-list')
                    <a class="nav-link" href="{{route('testimonials.index')}}">
                        @endcan
                        <span class="menu-title">Testimonials</span>
                        <i class="icon-layers menu-icon"></i>
                    </a>
                    <div class="collapse" id="forms">
                        <ul class="nav flex-column sub-menu">
                        @can('testimonials-list')
                            <li class="nav-item"> <a class="nav-link" href="{{route('testimonials.index')}}">All Testimonials</a></li>
                            @endcan
                        @can('testimonials-create')
                            <li class="nav-item"> <a class="nav-link" href="{{route('testimonials.create')}}">Add Testimonial</a></li>
                        @endcan
                        </ul>
                    </div>
                </li>
                @endhasanyrole


            

                @hasanyrole('Orders Manager|super-admin')
                <li class="nav-item">
                @can('order-list')
                    <a class="nav-link" href="{{route('orders.index')}}">
                        @endcan
                        <span class="menu-title">Orders</span>
                        <i class="icon-chart menu-icon"></i>
                    </a>
                    <div class="collapse" id="forms3">
                        <ul class="nav flex-column sub-menu">
                            @can('order-list')
                            <li class="nav-item"> <a class="nav-link" href="{{route('orders.index')}}">All Orders</a></li>
                            @endcan
                        </ul>
                    </div>
                </li>

                @endhasanyrole

                @hasanyrole('Coupons Manager|super-admin')
                <li class="nav-item">
                @can('coupons-list')

                    <a class="nav-link" href="{{route('coupons.index')}}">
                        @endcan
                        <span class="menu-title">Coupons</span>
                        <i class="icon-folder-alt menu-icon"></i>
                    </a>
                    <div class="collapse" id="forms4">
                        <ul class="nav flex-column sub-menu">
                @can('coupons-list')

                            <li class="nav-item"> <a class="nav-link" href="{{route('coupons.index')}}">All Coupons</a></li>
                            @endcan
                @can('coupons-create')

                            <li class="nav-item"> <a class="nav-link" href="{{route('coupons.create')}}">Add Coupon</a></li>
                        @endcan
                        </ul>
                    </div>
                </li>

                @endhasanyrole

                @hasanyrole('Blogs Manager|super-admin')
                <li class="nav-item">
                @can('blog-list')
                    
                    <a class="nav-link" href="{{route('blogs.index')}}">
                        @endcan
                        <span class="menu-title">Blogs</span>
                        <i class="icon-grid menu-icon"></i>
                    </a>
                    <div class="collapse" id="forms5">
                        <ul class="nav flex-column sub-menu">
                @can('blog-list')

                            <li class="nav-item"> <a class="nav-link" href="{{route('blogs.index')}}">All Blogs</a></li>
                            @endcan
                @can('blog-create')

                            <li class="nav-item"> <a class="nav-link" href="{{route('blogs.create')}}">Add Blogs</a></li>
                @endcan

                        </ul>
                    </div>
                </li>
                @endhasanyrole

                @hasanyrole('Settings Manager|super-admin')

                <li class="nav-item">
                    @can('setting-list')
                    <a class="nav-link" href="{{route('settings.index')}}">
                        @endcan
                        <span class="menu-title">Settings</span>
                        <i class="icon-disc menu-icon"></i>
                    </a>
                    <div class="collapse" id="forms6">
                        <ul class="nav flex-column sub-menu">
                            @can('setting-list')
                            <li class="nav-item"> <a class="nav-link" href="{{route('settings.index')}}">All Settings</a></li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endhasanyrole

                @hasanyrole('Contacts Manager|super-admin')

                <li class="nav-item">
                    @can('contact-list')
                    <a class="nav-link" href="{{route('admin.contacts.index')}}">
                        @endcan
                        <span class="menu-title">Contacts</span>
                        <i class="icon-globe menu-icon"></i>
                    </a>
                    <div class="collapse" id="forms7">
                        <ul class="nav flex-column sub-menu">
                            @can('contact-list')
                            <li class="nav-item"> <a class="nav-link" href="{{route('admin.contacts.index')}}">All Contacts</a></li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endhasanyrole

                @hasanyrole('Users Manager|super-admin')

                <li class="nav-item">
                    @can('user-list')
                    <a class="nav-link" href="{{route('users.index')}}">
                        @endcan
                        <span class="menu-title">Users</span>
                        <i class="icon-layers menu-icon"></i>
                    </a>
                    <div class="collapse" id="forms8">
                        <ul class="nav flex-column sub-menu">
                            @can('user-list')
                            <li class="nav-item"> <a class="nav-link" href="{{route('users.index')}}">All Users</a></li>
                            @endcan
                            @can('user-create')

                            <li class="nav-item"> <a class="nav-link" href="{{route('users.create')}}">Add User</a></li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endhasanyrole

                @hasanyrole('super-admin')

                <li class="nav-item">
                    <a class="nav-link" href="{{route('admins.index')}}">
                        <span class="menu-title">Admins</span>
                        <i class="icon-book-open menu-icon"></i>
                    </a>
                    <div class="collapse" id="forms9">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{route('admins.index')}}">All Admins</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{route('admins.create')}}">Add Admin</a></li>
                        </ul>
                    </div>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="{{route('roles.index')}}">
                        <span class="menu-title">Roles And Permissions</span>
                        <i class="icon-screen-desktop menu-icon"></i>
                    </a>
                    <div class="collapse" id="forms10">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{route('roles.index')}}">All Roles</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{route('roles.create')}}">Add Roles</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{route('roles.permissions')}}">All Permission</a></li>

                            <li class="nav-item"> <a class="nav-link" href="{{route('permissions.create')}}">Add Permissions</a></li>
                        </ul>
                    </div>
                </li>
                @endhasanyrole
        </nav>

        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">













                @yield('content')












                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024 Stellar. All rights reserved. <a href="#"> Terms of use</a><a href="#">Privacy Policy</a></span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="icon-heart text-danger"></i></span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap Bundle JS CDN (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- JS for specific plugins -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/vendors/chartist/chartist.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.cookie.js') }}"></script>
    
    <!-- Custom js for this page -->
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <!-- endinject -->
</body>

</html>