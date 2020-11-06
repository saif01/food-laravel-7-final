@extends('user.layout.user-master')
@section('title', 'CP Five Star Post Details')



@section('content')
<div class="page-wrapper">
            <!-- start: Inner page hero -->
            <div class="inner-page-hero header-bg" >
                <div class="container">
                    <h2 class="text-white">@if($singleData->header)  {{ $singleData->header }} @else Single Post Details... @endif</h2>
                </div>
                <!-- end:Container -->
            </div>

            <div class="breadcrumb">
                <div class="container">
                    <ul>
                        <li><a href="{{ url('/') }}" class="active">Home</a></li>
                        <li><a href="{{ url('/posts') }}">Posts</a></li>
                        <li class="text-danger">Post Details</li>
                    </ul>
                </div>
            </div>
            <section class="contact-page inner-page">
                <div class="container">
                    <div class="row">
                        <!-- REGISTER -->
                        <div class="col-md-6">
                            <div class="widget">
                                <div class="widget-body">

                                    <b>Product Title : </b>
                                    <div class="pl-2">
                                        {{ $singleData->title }}.
                                    </div>
                                    <hr>


                                    <b>Product Details : </b>
                                    <div class="pl-2">
                                        {!! $singleData->details !!}
                                    </div>
                                    <hr>

                                </div>
                            </div>
                            <!-- end: Widget -->
                        </div>
                        <!-- /REGISTER -->
                        <!-- WHY? -->
                        <div class="col-md-6">
                            <h4>Product Views</h4>
                            <hr>
                            <img class="img-fluid img-thumbnail d-block" src="{{ asset($singleData->image) }}" alt="Image">
                        </div>
                        <!-- /WHY? -->
                    </div>
                </div>
            </section>


@endsection
