@extends('user.layout.user-master')
@section('title', 'CP Five Star Outlates')


@push('page-css')

 <style>
        .google-maps {
            position: relative;
            padding-bottom: 75%;
            height: 0;
            overflow: hidden;
        }

        .google-maps iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100% !important;
            height: 100% !important;
        }
    </style>

@endpush

@section('content')
 <div class="page-wrapper">

            <!-- start: Inner page hero -->
            <div class="inner-page-hero header-bg" >
                <div class="container">
                   <h2 class="text-white">All CP Five Star Outlets</h2>

                </div>
                <!-- end:Container -->
            </div>

            <!-- end:Inner page hero -->
            <div class="breadcrumb">
                <div class="container">
                    <ul>
                        <li><a href="{{ url('/') }}" class="active">Home</a></li>
                        <li class="text-danger">Outlate</li>
                        @if ($name)
                            <li class="text-danger">{{ $name }}</li>
                        @endif

                    </ul>
                </div>
            </div>

            <section class="contact-page inner-page">

                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="google-maps">

                                {!! $gmap !!}
                            </div>
                        </div>
                    </div>

                </div>
            </section>


        </div>
@endsection
