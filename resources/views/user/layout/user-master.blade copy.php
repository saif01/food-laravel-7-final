<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Md.Syful Islam">
    @yield('og')
    @include('admin.layouts.icon')
    <title>@yield('title')</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    {{-- <link href="{{ asset('all-assets/user/css/bootstrap.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('all-assets/user/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('all-assets/user/css/animsition.min.css') }}" rel="stylesheet">
    <link href="{{ asset('all-assets/user/css/animate.css') }}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('all-assets/user/css/style.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" rel="stylesheet">
    <!-- Social media icon -->
    <link href="{{ asset('all-assets/user/css/floating-social-icon.css') }}" rel="stylesheet">

    <style>
        .nav_logo {
            height: 100px;
            width: 100px;
            margin-bottom: -70px;
        }

        .navbar-nav .nav-link:hover {
            color: #fdbc56 !important;
        }

        .navbar-dark .navbar-nav .nav-link {
            font-weight: bold;
        }

        .min-height{
            min-height:170px !important;
        }

        .header-bg{
            background-image: url("{{ asset('all-assets/user/images/bg/bg-blure.jpg') }}");
            max-height: 150px;
        }
        .brand-color{
            color: #e51937;
        }

    </style>

<style>
    /*
*
* ==========================================
* CUSTOM UTIL CLASSES
* ==========================================
*
*/

.dropdown-submenu {
position: relative;
}

.dropdown-submenu>a:after {
content: "\f0da";
float: right;
border: none;
font-family: 'FontAwesome';
}

.dropdown-submenu>.dropdown-menu {
top: 0;
left: 100%;
margin-top: 0px;
margin-left: 0px;
}

/*
*
* ==========================================
* FOR DEMO PURPOSES
* ==========================================
*
*/
/*
body {
background: #4568DC;
background: -webkit-linear-gradient(to right, #4568DC, #B06AB3);
background: linear-gradient(to right, #4568DC, #B06AB3);
min-height: 100vh;
} */

code {
color: #B06AB3;
background: #fff;
padding: 0.1rem 0.2rem;
border-radius: 0.2rem;
}

@media (min-width: 991px) {
.dropdown-menu {
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
}
</style>

    {{-- Page Css --}}
    @yield('page-css')
</head>

<body class="home">
    <div class="site-wrapper animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
        <!--header starts-->
        <header id="header" class="header-scroll top-header headrom">
            <!-- .navbar -->
            {{-- <nav class="navbar navbar-dark" style="background:#e51937">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>

                    <!-- <a class="navbar-brand" href="index"> <img class="img-rounded" src="images/food.png" alt=""> </a> -->
                    <a href="{{ url('/') }}" class="navbar-brand"><img class="img-rounded nav_logo" src="{{ asset('all-assets/user/images/food.ico') }}" alt=""></a>

                    <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"> <a class="nav-link" href="{{ url('/') }}">Home </a> </li>
                            <li class="nav-item"> <a class="nav-link" href="{{ url('/about') }}">About </a> </li>
                            <li class="nav-item"> <a class="nav-link" href="{{ url('/products') }}">Products </a> </li>

                            <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Products</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ url('/products') }}">All-Products</a>
                                    <a class="dropdown-item" href="{{ url('/outlate/Khulna') }}">Khulna</a>
                                    <a class="dropdown-item" href="{{ url('/outlate/Chittagong') }}">Chittagong</a>
                                    <a class="dropdown-item" href="{{ url('/outlate/Rajshahi') }}">Rajshahi</a>
                                    <a class="dropdown-item" href="{{ url('/outlate/Barisal') }}">Barisal</a>
                                    <a class="dropdown-item" href="{{ url('/outlate/Comilla') }}">Comilla</a>
                                    <a class="dropdown-item" href="{{ url('/outlate/Sylhet') }}">Sylhet</a>
                                    <a class="dropdown-item" href="{{ url('/outlate/Rangpur') }}">Rangpur</a>

                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Dropdown link
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <li><a class="dropdown-item" href="#">Action</a></li>

                                  <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">Submenu</a>
                                    <ul class="dropdown-menu">
                                      <li><a class="dropdown-item" href="#">Submenu action</a></li>
                                      <li><a class="dropdown-item" href="#">Another submenu action</a></li>


                                      <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="#">Subsubmenu</a>
                                        <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="#">Subsubmenu action</a></li>
                                          <li><a class="dropdown-item" href="#">Another subsubmenu action</a></li>
                                        </ul>
                                      </li>
                                      <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="#">Second subsubmenu</a>
                                        <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="#">Subsubmenu action</a></li>
                                          <li><a class="dropdown-item" href="#">Another subsubmenu action</a></li>
                                        </ul>
                                      </li>



                                    </ul>
                                  </li>
                                </ul>
                              </li>


                            <li class="nav-item"> <a class="nav-link" href="{{ url('/promotions') }}">Promotions </a> </li>
                            <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Outlates</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ url('/outlate/Dhaka') }}">Dhaka</a>
                                    <a class="dropdown-item" href="{{ url('/outlate/Khulna') }}">Khulna</a>
                                    <a class="dropdown-item" href="{{ url('/outlate/Chittagong') }}">Chittagong</a>
                                    <a class="dropdown-item" href="{{ url('/outlate/Rajshahi') }}">Rajshahi</a>
                                    <a class="dropdown-item" href="{{ url('/outlate/Barisal') }}">Barisal</a>
                                    <a class="dropdown-item" href="{{ url('/outlate/Comilla') }}">Comilla</a>
                                    <a class="dropdown-item" href="{{ url('/outlate/Sylhet') }}">Sylhet</a>
                                    <a class="dropdown-item" href="{{ url('/outlate/Rangpur') }}">Rangpur</a>

                                </div>
                            </li>

                            <li class="nav-item"> <a class="nav-link" href="{{ url('/posts') }}">Posts </a> </li>
                            <li class="nav-item"> <a class="nav-link" href="{{ url('/contact') }}">Contact </a> </li>



                        </ul>
                    </div>
                </div>
            </nav> --}}
            <!-- /.navbar -->

<nav class="navbar navbar-expand-lg navbar-dark py-3 shadow-sm" style="background:#e51937">
    <div class="container-fluid navbar-container">
        <img class="navbar-brand" src="{{ asset('all-assets/user/images/food.ico') }}" height="50" width="50" alt="logo">
      </div>
    <div class="container">
        {{-- <a href="{{ url('/') }}" class="navbar-brand"><img class="img-rounded nav_logo" src="{{ asset('all-assets/user/images/food.ico') }}" alt=""></a> --}}
      <a href="#" class="navbar-brand font-weight-bold"> CP FIVE STAR</a>

      <button type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
                <span class="navbar-toggler-icon"></span>
            </button>


      <div id="navbarContent" class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
          <!-- Level one dropdown -->
          <li class="nav-item dropdown">
            <a id="dropdownMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Dropdown</a>
            <ul aria-labelledby="dropdownMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="#" class="dropdown-item">Some action </a></li>
              <li><a href="#" class="dropdown-item">Some other action</a></li>

              <li class="dropdown-divider"></li>

              <!-- Level two dropdown-->
              <li class="dropdown-submenu">
                <a id="dropdownMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Hover for action</a>
                <ul aria-labelledby="dropdownMenu2" class="dropdown-menu border-0 shadow">
                  <li>
                    <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                  </li>

                  <!-- Level three dropdown-->
                  <li class="dropdown-submenu">
                    <a id="dropdownMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>
                    <ul aria-labelledby="dropdownMenu3" class="dropdown-menu border-0 shadow">
                      <li><a href="#" class="dropdown-item">3rd level</a></li>
                      <li><a href="#" class="dropdown-item">3rd level</a></li>
                    </ul>
                  </li>
                  <!-- End Level three -->

                  <li><a href="#" class="dropdown-item">level 2</a></li>
                  <li><a href="#" class="dropdown-item">level 2</a></li>
                </ul>
              </li>
              <!-- End Level two -->
            </ul>
          </li>
          <!-- End Level one -->

          <li class="nav-item"><a href="#" class="nav-link">About</a></li>
          <li class="nav-item"><a href="#" class="nav-link">Services</a></li>
          <li class="nav-item"><a href="#" class="nav-link">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>




        </header>

        <!-- banner part starts -->

        @yield('content')


        <div class="sbuttons">

            <a href="#" target="_blank" class="sbutton whatsapp" tooltip="WhatsApp"><i class="fab fa-whatsapp"></i></a>

            <a href="#" target="_blank" class="sbutton fb" tooltip="Facebook"><i class="fab fa-facebook-f"></i></a>

            <a href="#" target="_blank" class="sbutton gplus" tooltip="Google Plus"><i class="fab fa-google-plus-g"></i></a>

            <a href="#" target="_blank" class="sbutton twitt" tooltip="Twitter"><i class="fab fa-twitter"></i></a>

            <a href="#" target="_blank" class="sbutton pinteres" tooltip="Pinterest"><i class="fab fa-pinterest-p"></i></a>

            <a target="_blank" class="sbutton mainsbutton" tooltip="Share"><i class="fas fa-share-alt"></i></a>

        </div>



        <!-- start: FOOTER -->
        <footer class="footer">
            <div class="container">

                <!-- bottom footer statrs -->
                <div class="bottom-footer">
                    <div class="row">
                        <div class="col-xs-12 col-sm-3 about color-gray">
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
                        </div>
                    </div>
                </div>
                <!-- bottom footer ends -->
            </div>
        </footer> <!-- end:Footer -->
    </div>
    <!--/end:Site wrapper -->



    <!-- Bootstrap core JavaScript================================================== -->
    <script src="{{ asset('all-assets/user/js/jquery.min.js') }}"></script>
    <script src="{{ asset('all-assets/user/js/tether.min.js') }}"></script>
    {{-- <script src="{{ asset('all-assets/user/js/bootstrap.min.js') }}"></script> --}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="{{ asset('all-assets/user/js/animsition.min.js') }}"></script>
    <script src="{{ asset('all-assets/user/js/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('all-assets/user/js/jquery.isotope.min.js') }}"></script>
    <script src="{{ asset('all-assets/user/js/headroom.js') }}"></script>
    <script src="{{ asset('all-assets/user/js/foodpicky.min.js') }}"></script>
    <script src="{{ asset('all-assets/user/js/navbar-active.js') }}"></script>

    {{-- Page Js --}}
    @yield('page-js')

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
