@extends('user.layout.user-master')
@section('title', 'CP Five Star Post Details')


@push('page-css')

<style>

.style-1 del {
  color: rgba(255, 0, 0, 0.5);
  text-decoration: none;
  position: relative;
}
.style-1 del:before {
  content: " ";
  display: block;
  width: 100%;
  border-top: 2px solid rgba(255, 0, 0, 0.8);
  height: 12px;
  position: absolute;
  bottom: 0;
  left: 0;
  transform: rotate(-7deg);
}
.style-1 ins {
  color: green;
  font-size: 25px;
  text-decoration: none;
  padding: 1em 1em 1em 0.5em;
}
</style>

@endpush

{{-- Start For Social Media Share --}}
@section('og')
<meta property="og:title" content="{{ $singleData->title }}" />
<meta property="og:image" content="{{ asset($singleData->image) }}" />
<meta property="og:type" content="website" />
@endsection
{{-- End For Social Media Share --}}
@section('content')
<div class="page-wrapper">
            <!-- start: Inner page hero -->
            <div class="inner-page-hero header-bg" >
                <div class="container">
                    <h2 class="text-white">@if($singleData->header)  {{ $singleData->header }} @else Single Promotion Details... @endif</h2>
                </div>
                <!-- end:Container -->
            </div>

            <div class="breadcrumb">
                <div class="container">
                    <ul>
                        <li><a href="{{ url('/') }}" class="active">Home</a></li>
                        <li><a href="{{ url('/promotions') }}">Promotions</a></li>
                        <li class="text-danger">Promotions Details</li>
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

                                    <span class="style-1">

                                        <del>
                                          <span><b>Old Price : </b> {{ $singleData->price_old }}</span>
                                        </del>
                                        <ins>
                                          <span><b>New Price :</b> {{ $singleData->price_new }} /= Taka</span>
                                        </ins>

                                    </span>

                                </div>
                            </div>
                            <!-- end: Widget -->
                        </div>
                        <!-- /REGISTER -->
                        <!-- WHY? -->
                        <div class="col-md-6">
                            <h4>Product Views</h4>
                            <hr>
                            <img class="img-fluid img-thumbnail d-block" src="{{ asset($singleData->image) }}"  alt="Image">
                            {{-- style="max-width: 609px; max-height: 350px;" --}}
                        </div>
                        <!-- /WHY? -->
                    </div>
                </div>
            </section>


@endsection
