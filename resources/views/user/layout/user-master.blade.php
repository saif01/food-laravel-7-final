<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Md.Syful Islam">
    @include('admin.layouts.icon')
    <title>@yield('title')</title>
    <!-- Bootstrap core CSS -->
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@300&display=swap" rel="stylesheet">
    <link href="{{ asset('all-assets/common/bootstrap-4.5/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('all-assets/common/fontawesom5.7/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('all-assets/user/css/animsition.min.css') }}" rel="stylesheet">
    <link href="{{ asset('all-assets/user/css/animate.css') }}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('all-assets/user/css/style.css') }}" rel="stylesheet">
    <!-- Social media icon -->
    <link href="{{ asset('all-assets/common/social-icon/css/floating.css') }}" rel="stylesheet">
    <!-- Back to top Button -->
    <link href="{{ asset('all-assets/common/scroll-top/css/back-to-top.css') }}" rel="stylesheet">

    <style>
        body,html{font-family:'El Messiri',sans-serif!important}
        .header-bg {
            background-image: url("{{ asset('all-assets/user/images/bg/bg-blure.jpg') }}");
            max-height: 150px;
            margin-top: -15px;
        }
        .brand-color {
            color: #e51937;
        }
    </style>



    {{-- Page Css --}}
    @stack('page-css')
</head>

<body class="home">

    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v8.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <!-- Your Chat Plugin code -->
    <div class="fb-customerchat" attribution=setup_tool page_id="102603987981724">
    </div>
    <!--End Load Facebook SDK for JavaScript -->

    <div class="site-wrapper animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
        <!--header starts-->
        <header id="header" class="header-scroll top-header headrom">
            <nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background:#e51937; padding: inherit;">
                <div class="container">

                    <a href="{{ url('/') }}" class="navbar-brand font-weight-bold"><img class="img-rounded" src="{{ asset('all-assets/user/images/food.ico') }}" alt="Logo" height="50" width="50"></a>

                    <button type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
                        <span class="navbar-toggler-icon"></span>
                    </button>


                    <div id="navbarContent" class="collapse navbar-collapse">
                        <ul class="navbar-nav mr-auto">

                            <li class="nav-item active"> <a class="nav-link" href="{{ url('/') }}"><i class="fa fa-home"></i> Home </a> </li>
                            <li class="nav-item"> <a class="nav-link" href="{{ url('/about') }}">About </a> </li>

                            <!-- Level one dropdown -->
                            <li class="nav-item dropdown">
                                <a id="dropdownMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Products</a>
                                <ul aria-labelledby="dropdownMenu1" class="dropdown-menu border-0 shadow">

                                    <li><a href="{{ route('user.all.products') }}" class="dropdown-item">All Products</a></li>
                                    <li class="dropdown-divider"></li>

                                    <!-- Level two dropdown-->
                                    @php
                                    $cat_data = App\Models\Category::orderBy('id', 'asc')->get();
                                    @endphp

                                    @foreach($cat_data as $cat)
                                        <li><a href="{{ route('user.cat.products', $cat->id) }}" class="dropdown-item">{{ $cat->name }}</a></li>
                                    @endforeach



                                    {{-- @foreach($cat_data as $cat)


                                    @php
                                    $sub_data = App\Models\Subcategory::where('cat_id', $cat->id)->orderBy('name')->get();
                                    @endphp

                                    <li class="dropdown-submenu">
                                        <a id="dropdown_{{ $cat->id }}" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">{{ $cat->name }}</a>
                                        @if(count($sub_data)>0)

                                        <ul aria-labelledby="dropdown_{{ $cat->id }}" class="dropdown-menu border-0 shadow">
                                            <li>
                                                @foreach($sub_data as $sub)
                                                <a tabindex="-1" href="{{ route('user.sub.products',$sub->id) }}" class="dropdown-item">{{ $sub->name }}</a>
                                                @endforeach
                                            </li>
                                        </ul>

                                        @else
                                        <ul aria-labelledby="dropdown_{{ $cat->id }}" class="dropdown-menu border-0 shadow">
                                            <li>
                                                <span class="dropdown-item text-danger">Comming Soon</span>
                                            </li>
                                        </ul>
                                        @endif
                                    </li>

                                    @endforeach --}}

                                </ul>
                            </li>
                            <!-- End Level one -->
                            <li class="nav-item"> <a class="nav-link" href="{{ url('/posts') }}">Posts </a> </li>
                            <li class="nav-item"> <a class="nav-link" href="{{ url('/contact') }}">Contact </a> </li>

                            <li class="nav-item dropdown">
                                <a id="dropdownMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Outlet</a>
                                <ul aria-labelledby="dropdownMenu1" class="dropdown-menu border-0 shadow">

                                    <li><a href="{{ route('user.outlate.all') }}" class="dropdown-item">All Outlets </a></li>

                                    <li class="dropdown-divider"></li>

                                    {{-- <!-- Level two dropdown-->
                                        <li class="dropdown-submenu">
                                            <a id="dropdownMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Dhaka</a>
                                            <ul aria-labelledby="dropdownMenu2" class="dropdown-menu border-0 shadow">
                                                <li>
                                                    <a tabindex="-1" href="{{ route('user.outlate.subarea','dh-1') }}" class="dropdown-item">Zone 1</a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href="{{ route('user.outlate.subarea','dh-2') }}" class="dropdown-item">Zone 2</a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href="{{ route('user.outlate.subarea','dh-3') }}" class="dropdown-item">Zone 3</a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href="{{ route('user.outlate.subarea','dh-4') }}" class="dropdown-item">Zone 4</a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href="{{ route('user.outlate.subarea','dh-5') }}" class="dropdown-item">Zone 5</a>
                                            </li>
                                        </ul>
                                        </li>
                                        <!-- End Level two --> 
                                    --}}

                        <li><a href="{{ route('user.outlate.subarea','dhk') }}" class="dropdown-item">Dhaka </a></li>

                        <li><a href="{{ route('user.outlate.subarea','ctg') }}" class="dropdown-item">Chittagong </a></li>

                        </ul>
                        </li>

                        <li class="nav-item"> <a class="nav-link" href="{{ route('user.franchisee.apply') }}">Franchisee </a> </li>


                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <!-- banner part starts -->
            @yield('content')
        

        {{-- Sofial Media Icons --}}
        <div class="sbuttons">
            <a href="https://www.facebook.com/cpfivestarbangladesh" target="_blank" class="sbutton fb" tooltip="Facebook"><i class="fab fa-facebook-square"></i></a>
            <a href="https://www.instagram.com/cpfivestar.bd" target="_blank" class="sbutton instagram" tooltip="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="https://www.youtube.com/c/CPFiveStarBangladesh" target="_blank" class="sbutton youtube" tooltip="Youtube"><i class="fab fa-youtube"></i></a>
            <a target="_blank" class="sbutton mainsbutton" tooltip="Share"><i class="fas fa-share-alt"></i></a>
        </div>



        <!-- Back to top button -->
        <a id="button"></a>

        <!-- start: FOOTER -->
        <footer class="footer">
            <div class="container">

                <!-- bottom footer statrs -->
                <div class="bottom-footer">
                    <div class="row">
                        {{-- <div class="col-xs-12 col-sm-3 about color-gray">
                            <h5>About Us</h5>
                            <ul>
                                <li><a href="about">About us</a> </li>
                                <li><a href="#">History</a> </li>
                                <li><a href="#">Our Team</a> </li>
                                <li><a href="#">We are hiring</a> </li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-4 address color-gray">
                            <h5>Address</h5>
                            <p>
                                <p>Holding No E-236,<br>Ward No 007, Chandra, Kaliyakor, Gazipur<br></p>
                            </p>
                            <h5>Phone: <a href="tel:+88 01707-08 04 01">+88 01707-08 04 01</a></h5>
                        </div>
                        <div class="col-xs-12 col-sm-5 additional-info color-gray">
                            <h5>Addition informations</h5>
                            <p>Join the thousands of other restaurants who benefit from having their menus on TakeOff</p>
                        </div> --}}

                        @php
                            $contactData = App\Models\Contact::where('status', '1')->orderBy('id', 'desc')->get();
                        @endphp

                            {{-- <h5>Address</h5> --}}
                            @foreach ($contactData as $item)
                            <div class="col-md-6 address color-gray">
                                @if($item->contact)
                                    <h5><b>Phone : </b><a href="tel:+88 {{ $item->contact }}">{{ $item->contact }}</a> </h5>
                                @endif
                                @if($item->telephone)
                                    <p><b>Telephone : </b> {{ $item->telephone }}</p>
                                @endif
                                @if($item->email)
                                    <p><b>E-mail : </b> {{ $item->email }} </span></p>
                                @endif
                                @if($item->address)
                                    <p><b>Address : </b> {{ $item->address }}</p>
                                @endif
                                
                            </div>
                            @endforeach
            
                        
                    </div>
                </div>
                <!-- bottom footer ends -->
                <p class="m-0 text-muted small">Copyright &copy; Powered By CPB-IT</p>
            </div>
            
        </footer> <!-- end:Footer -->
    </div>
    <!--/end:Site wrapper -->



    <!-- Bootstrap core JavaScript================================================== -->
    <script src="{{ asset('all-assets/user/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('all-assets/user/js/tether.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('all-assets/common/bootstrap-4.5/js/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('all-assets/common/bootstrap-4.5/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('all-assets/user/js/animsition.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('all-assets/user/js/bootstrap-slider.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('all-assets/user/js/jquery.isotope.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('all-assets/user/js/headroom.js') }}" type="text/javascript"></script>
    <script src="{{ asset('all-assets/user/js/foodpicky.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('all-assets/user/js/navbar-active.js') }}" type="text/javascript"></script>
    <script src="{{ asset('all-assets/common/scroll-top/js/back-to-top.js') }}" type="text/javascript"></script>


    {{-- Page Js --}}
    @stack('page-js')

    <script>
        $(function() {
            // ------------------------------------------------------- //
            // Multi Level dropdowns
            // ------------------------------------------------------ //
            $("ul.dropdown-menu [data-toggle='dropdown']").on("click", function(event) {
                event.preventDefault();
                event.stopPropagation();

                $(this).siblings().toggleClass("show");


                if (!$(this).next().hasClass('show')) {
                    $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
                }
                $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
                    $('.dropdown-submenu .show').removeClass("show");
                });

            });
        });
    </script>



    {{-- Toastar Alert --}}
    <script type="text/javascript">
        // const Toast = Swal.mixin({
        //     toast: true,
        //     position: 'top-end',
        //     showConfirmButton: false,
        //     timer: 3000,
        //     timerProgressBar: true,
        //     onOpen: (toast) => {
        //         toast.addEventListener('mouseenter', Swal.stopTimer)
        //         toast.addEventListener('mouseleave', Swal.resumeTimer)
        //     }
        // });
    </script>


</body>

</html>