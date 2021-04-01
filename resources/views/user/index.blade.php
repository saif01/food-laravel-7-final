@extends('user.layout.user-master')
@section('title', 'CP Five Star - Bangladesh')



@push('page-css')

<link rel="stylesheet" href="{{ asset('all-assets/common/animate/css/animate.min.css') }}">

<style>
    .card {
        border: inherit;
        background-color: inherit;
    }

    .custom-font{
        font-family: 'Sansita Swashed', cursive !important;
    }

    .promotion-btn{
        color: white;
        border: 2px dashed #050505;
        font-size: larger;
    }

    .promotion-btn:hover{
        background: #4e4e4e;
    }

    .carousel-item {
        /* height: 100vh; */
        max-height: 670px;
        background: no-repeat center center scroll;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }

    .carousel-item img{
        width: 100%;
        background-size: cover;
        background-position: center center;
    }

    /* .theme-btn-dash {
        border: 2px dashed #050505;
        background-color: transparent;
    } */
 


    /* // Small devices (landscape phones, 576px and up) */
    @media (min-width: 576px) { 
        .text_size {
            font-size: 30px !important;
        }

        .text_size_2 {
            font-size: 15px !important;
        }
    }

    /* // Medium devices (tablets, 768px and up) */
    @media (min-width: 768px) { 
        .text_size {
            font-size: 50px !important;
        }

        .text_size_2 {
            font-size: 20px !important;
        }
    }

    /* // Large devices (desktops, 992px and up) */
    @media (min-width: 992px) { 
        .text_size {
            font-size: 100px !important;
        }

        .text_size_2 {
            font-size: 30px !important;
        }
    }

    /* // Extra large devices (large desktops, 1200px and up) */
    @media (min-width: 1200px) { 
        .text_size {
            font-size: 120px !important;
        }

        .text_size_2 {
            font-size: 40px !important;
        }
    }


</style>

@endpush

@push('page-js')

<script>
    $('.carousel').carousel({
        interval: 5000,
        loop: true,
    })
</script>


@endpush

{{-- Main Content --}}
@section('content')

<section >

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="padding-top: 60px;">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>


        <div class="carousel-inner">
            @php
            $isFirst = true;
            @endphp
            @foreach ($slider as $slide)

            <div class="carousel-item {{ $isFirst ? ' active' : '' }} ">
                <img class="img-fluid" src="{{ asset( $slide->image ) }}" alt="Slider Image">
                <div class="carousel-caption text-center">
                    <p class="text_size font-weight-bold animate__animated animate__heartBeat custom-font" style="color:{{ $slide->favcolor }} !important"  >{{ $slide->header }}</p>
                    <p class="text_size_2 text-light custom-font" style="color:{{ $slide->favcolor }} !important">{{ $slide->remarks }}</p>
                </div>
            </div>

            @php
            $isFirst = false;
            @endphp

            @endforeach

        </div>



        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

</section>



<section>
    <div class="title text-center mt-5 pb-3">
        <h2>Our Promotional Products... <i class="fa fa-bullhorn brand-color" aria-hidden="true"></i></h2>
    </div>
    <div class="row" style="background-image: url({{ asset('all-assets/user/images/bg/img1.jpg') }}); background-size: cover;">

        <div class="col-md-12 roundDiv text-center m-t-30">

            <div class="card-group">

                @foreach ($promotionalData as $promotion)

                <div class="card">
                    <a href="{{ url('/promotion-details/'.$promotion->id) }}">
                        <img src="{{ asset($promotion->image) }}" class="round_img">
                        <div class="card-body">
                            <a href="{{ url('/promotion-details/'.$promotion->id) }}" class="card-text btn theme-btn-dash m-t-30 promotion-btn"><i class="fa fa-eye" aria-hidden="true"></i>
                                View Details</a>
                        </div>
                    </a>
                </div>

                @endforeach


            </div>

        </div>
    </div>
</section>


<!-- Popular block starts -->
<section class="popular">
    <div class="container">
        <div class="title text-xs-center m-b-30">
            <h2>Latest Posts... <i class="far fa-newspaper brand-color float-right"></i>
            </h2>
        </div>
        <div class="row">

            @foreach ($postData as $rowPost )

            <!-- Each popular food item starts -->
            <div class="col-xs-12 col-sm-6 col-md-4 food-item">
                <div class="food-item-wrap">
                    <div class="figure-wrap bg-image zoom">
                        <img src="{{ asset($rowPost->image) }}" height="211" width="392">
                    </div>
                    <div class="content">
                        <h5><a href="{{ url('/posts-details/'.$rowPost->id) }}">{{ Str::limit($rowPost->title, $limit = 30 ) }}</a></h5>
                        <div class="product-name min-height">
                              {!! substr(strip_tags($rowPost->details), 0, 300) !!} 
                            <a href="{{ url('/posts-details/'.$rowPost->id) }}"> ...... Read More.</a>
                        </div>

                        <div class="price-btn-block"> <span class="price"></span> <a href="{{ url('/posts-details/'.$rowPost->id) }}" class="btn theme-btn-dash float-right"><i class="fa fa-eye" aria-hidden="true"></i> View Details</a> </div>
                    </div>

                </div>
            </div>
            <!-- Each popular food item starts -->
            @endforeach

        </div>
    </div>
</section>
<!-- Popular block ends -->

<!-- Letest Projucts starts -->
<section class="popular">
    <div class="container">
        <div class="title text-xs-center m-b-30">
            <h2>Latest Products... <i class="fa fa-gift brand-color float-right"></i>
            </h2>
        </div>
        <div class="row">
            @foreach ($productData as $rowProduct )
            <!-- Each popular food item starts -->
            <div class="col-xs-12 col-sm-6 col-md-4 food-item">
                <div class="food-item-wrap">
                    <div class="figure-wrap bg-image zoom">
                        <img src="{{ asset($rowProduct->image) }}" height="211" width="392">
                    </div>
                    <div class="content">
                        <h5><a href="{{ url('/products-details/'.$rowProduct->id) }}">{{ Str::limit($rowProduct->title, $limit = 30 ) }}</a></h5>
                        <div class="product-name min-height">
                            {!! substr(strip_tags($rowProduct->details), 0, 300) !!} 
                            <a href="{{ url('/products-details/'.$rowProduct->id) }}"> ...... Read More.</a>
                        </div>

                        <div class="price-btn-block"> <span class="price">{{ $rowProduct->price }}/= Taka</span> <a href="{{ url('/products-details/'.$rowProduct->id) }}" class="btn theme-btn-dash float-right"><i class="fa fa-eye"></i> View Details</a> </div>
                    </div>

                </div>
            </div>
            <!-- Each popular food item starts -->
            @endforeach

        </div>
    </div>
</section>
<!-- Letest Projucts  ends -->



@endsection