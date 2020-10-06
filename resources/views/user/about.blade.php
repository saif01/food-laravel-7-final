@extends('user.layout.user-master')
@section('title', 'CP Five Star About')

@section('content')
 <div class="page-wrapper">

            <!-- start: Inner page hero -->
            <div class="inner-page-hero header-bg" >
                <div class="container">
                    <h2 class="text-white">About us</h2>
                </div>
                <!-- end:Container -->
            </div>

            <!-- end:Inner page hero -->
            <div class="breadcrumb">
                <div class="container">
                    <ul>
                        <li><a href="{{ url('/') }}" class="active">Home</a></li>
                        <li class="text-danger">About</li>
                    </ul>
                </div>
            </div>

            <section class="contact-page inner-page">

                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="sidebar-title white-txt">
                                    <h6>About Us</h6> <i class="fas fa-utensils float-right"></i>
                                </div>
                            </div>
                            <div class="m-3">
                                @if ($messageData->image)
                                    <img src="{{ asset($messageData->image) }}" class="img-fluid pb-3" alt="Responsive image">
                                @endif

                                {!! $messageData->details !!}
                            </div>
                        </div>
                    </div>

                     @if ($messageData->video_link)
                         <div class="embed-responsive embed-responsive-16by9 mt-5">
                        <iframe class="embed-responsive-item" src="{{ $messageData->video_link }}" allowfullscreen></iframe>
                        </div>
                    @endif


                </div>
            </section>




        </div>
@endsection
