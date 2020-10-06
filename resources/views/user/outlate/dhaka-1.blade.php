@extends('user.layout.user-master')
@section('title', 'CP Five Star All Outlates')


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
                         <li class="text-danger">All</li>
                    </ul>
                </div>
            </div>

            <section class="contact-page inner-page">

                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="google-maps">

                                <iframe
                                    src="https://www.google.com/maps/d/u/0/embed?mid=1lunsbEYmhs1W66FprhGrGx-N0yHsPcL7&z=13&ll=23.75351, 90.40709"></iframe>

                            </div>
                        </div>
                    </div>

                </div>
            </section>


        </div>
@endsection
