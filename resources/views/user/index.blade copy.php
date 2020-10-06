@extends('user.layout.user-master')
@section('title', 'CP Five Star - Bangladesh')



@push('page-css')
<!--  Vegas Slider CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('all-assets/user/assets/vegas/vegas.min.css') }}">
<!-- Text Animated CSS -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Modak">
<link href="{{ asset('all-assets/user/assets/textAnimate/animate.css') }}" rel="stylesheet">

<style>
    .card {
        border: inherit;
        background-color: inherit;
    }
</style>

@endpush

@push('page-js')
<!-- Vegas Slider Js -->
<script src="{{ asset('all-assets/user/assets/vegas/vegas.min.js') }}"></script>
<!-- Animated Text JS -->
<script src="{{ asset('all-assets/user/assets/textAnimate/jquery.lettering.js') }}"></script>
<script src="{{ asset('all-assets/user/assets/textAnimate/jquery.textillate.js') }}"></script>
<script src="{{ asset('all-assets/user/assets/textAnimate/animateOptions.js') }}"></script>

<script>
    // Home Page Two Slideshow
    $("#slideslow-bg").vegas({
        overlay: true,
        transition: 'fade',
        transitionDuration: 2000,
        delay: 4000,
        shuffle: true,
        color: '#e51937',
        animation: 'random',
        animationDuration: 20000,
        slides: [
            @foreach($slider as $slide) {
                src: "{{ asset( $slide->image) }}"
            },
            @endforeach
        ]
    }); //Home Page Two Slideshow
</script>
@endpush

{{-- Main Content --}}
@section('content')

<section class="hero bg-image" id="slideslow-bg" style="height: 100vh">

    <div class="hero-inner">
        <p class="tlt animated_text">CP Five Star</p>
        <div class="container text-center hero-text font-white">
            <h1 class="tlt" style="color:#fdbc56; text-shadow: 4px 4px 4px #e51937;">We Believe In Better Quality And Service</h1>
        </div>
    </div>
    <!--end:Hero inner -->
</section>



<section>
    <div class="title text-center mt-5">
        <h2>Our Promotional Products... <i class="fa fa-bullhorn brand-color" aria-hidden="true"></i></h2>
        <p class="lead">These products are available in your nearest CP Five Star Outlet</p>
    </div>
    <div class="row" style="background-image: url({{ asset('all-assets/user/images/bg/img1.jpg') }}); background-size: cover;">

        <div class="col-md-12 roundDiv text-center m-t-30">

            <div class="card-group">

                @foreach ($promotionalData as $promotion)

                <div class="card">
                    <a href="{{ url('/promotion-details/'.$promotion->id) }}">
                        <img src="{{ asset($promotion->image) }}" class="round_img">
                        <div class="card-body">
                            <a href="{{ url('/promotion-details/'.$promotion->id) }}" class="card-text btn theme-btn-dash m-t-30"><i class="fa fa-eye" aria-hidden="true"></i>
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
            <p class="lead">The easiest way to find your nearest CP Five Star Outlet</p>
        </div>
        <div class="row">

            @foreach ($postData as $rowPost )

            <!-- Each popular food item starts -->
            <div class="col-xs-12 col-sm-6 col-md-4 food-item">
                <div class="food-item-wrap">
                    <div class="figure-wrap bg-image zoom">
                        <img src="{{ asset($rowPost->image) }}" height="211" width="392">
                        <div class="rating pull-left"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> </div>
                    </div>
                    <div class="content">
                        <h5><a href="{{ url('/posts-details/'.$rowPost->id) }}">{{ Str::limit($rowPost->title, $limit = 30 ) }}</a></h5>
                        <div class="product-name min-height"> {!! Str::limit($rowPost->details, $limit = 300, $end = '......') !!} <a href="{{ url('/posts-details/'.$rowPost->id) }}"> Read More.</a></div>

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
            <p class="lead">The easiest way to find your nearest CP Five Star Outlet</p>
        </div>
        <div class="row">
            @foreach ($productData as $rowProduct )
            <!-- Each popular food item starts -->
            <div class="col-xs-12 col-sm-6 col-md-4 food-item">
                <div class="food-item-wrap">
                    <div class="figure-wrap bg-image zoom">
                        <img src="{{ asset($rowProduct->image) }}" height="211" width="392">
                        <div class="rating pull-left"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> </div>
                    </div>
                    <div class="content">
                        <h5><a href="{{ url('/products-details/'.$rowProduct->id) }}">{{ Str::limit($rowProduct->title, $limit = 30 ) }}</a></h5>
                        <div class="product-name min-height"> {!! Str::limit($rowProduct->details, $limit = 300, $end = '......') !!} <a href="{{ url('/products-details/'.$rowProduct->id) }}"> Read More.</a></div>

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
