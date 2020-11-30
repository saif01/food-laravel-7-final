@extends('user.layout.user-master')
@section('title', 'CP Five Star Contact')

@push('page-css')
<style>
    .input-invalid {
        font-size: 14px;
        margin-left: 12px;
        color: rgb(236, 54, 54);
    }
    .form-group.required .control-label:after {content:"*"; color:red; font-weight: bold;}
</style>
@endpush

@section('content')
<div class="page-wrapper">

    <!-- start: Inner page hero -->
    <div class="inner-page-hero header-bg">
        <div class="container">
            <h2 class="text-white">Contact us</h2>
        </div>
        <!-- end:Container -->
    </div>

    <!-- end:Inner page hero -->
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="{{ url('/') }}" class="active">Home</a></li>
                <li class="text-danger">Contact</li>
            </ul>
        </div>
    </div>

    <section class="contact-page inner-page">

        <div class="container">
            <div class="row my-2">
                <div class="col-md-12">
                    <div class="row pb-3">
                        <div class="sidebar-title white-txt">
                            <h6>Contact Us</h6> <i class="fas fa-utensils float-right"></i>
                        </div>
                    </div>
                    <div class="ml-3">

                        @foreach ($contactData as $item)

                            <span><b>Phone : </b> {{ $item->contact }} </span><br>
                            <span><b>Telephone : </b> {{ $item->telephone }} </span><br>
                            <span><b>E-mail : </b> {{ $item->email }} </span><br>
                            <span><b>Address : </b> {{ $item->address }} </span>
                            <hr>
                    
                        @endforeach

                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="row pb-4">
                        <div class="sidebar-title white-txt">
                            <h6>If any query then writes down below, Please.</h6> <i class="fas fa-utensils float-right"></i>
                        </div>
                    </div>

                    <div>



                        <span id="form_result"></span>

                        <form id="sample_form" method="POST">

                            @csrf

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group required">
                                     <label class="control-label" >Name </label>
                                        <input type="text" name="name" class="form-control" placeholder="Please enter your name">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group required">
                                     <label class="control-label">Contact </label>
                                        <input type="text" name="contact" class="form-control" placeholder="Please enter your phone number">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Email </label>
                                        <input type="email" name="email" class="form-control" placeholder="Please enter your email">
                                    </div>
                                </div>

                            </div>

                             <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group required">
                                        <label class="control-label">Message </label>
                                        <textarea id="form_message" name="details" class="form-control" id="details" placeholder="Please enter your query" rows="4" ></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input type="submit" id="action_button" class="btn btn-success btn-block" value="Submit your query">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>


        </div>
    </section>





    <section>
        <div class="row">
            <div class="col-md-12 m-b-10">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7287.483051623704!2d90.24882127252808!3d24.040178286033793!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755e6cba58c5335%3A0x1b52ffdcf921b2a0!2sC.P.%20Bangladesh%20Head%20Office%20%26%20Dhaka%20Feed%20Mill!5e0!3m2!1sen!2sbd!4v1566701145021!5m2!1sen!2sbd" width="100%" height="500px" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>
        </div>
    </section>

</div>
@endsection


@push('page-js')

{{-- Tostar + Sweetalert 2 --}}
<script src="{{ asset('all-assets/common/sweet-alert-2/sw-alert.js') }}" type="text/javascript"></script>

<script>
    $(document).ready(function() {

        //Form Submit
        $('#sample_form').on('submit', function(event) {
            event.preventDefault();
            //After Submit Button Text
            $('#action_button').val('Loading.....');
            $('#action_button').prop("disabled", true);

            $.ajax({
                url: "{{ route('contact.mail') }}",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",

                success: function(data) {
                    var html = '';
                    if (data.errors) {
                        html = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="color:white" >&times;</span></button>';
                        for (var count = 0; count < data.errors.length; count++) {
                            html += '<li class="text-light">' + data.errors[count] + '</li>';
                        }
                        html += '</div>';
                        $('#action_button').val('Submit your query');
                        $('#action_button').prop("disabled", false);
                        //Show Validation
                        $('#form_result').html(html);
                    }
                    if (data.success) {
                        $('#action_button').prop("disabled", false);
                        $('#action_button').val('Submit your query');
                        $('#sample_form')[0].reset();

                        Swal.fire({
                            position: 'center',
                            icon: data.icon,
                            title: data.success,
                            showConfirmButton: false,
                            timer: 1500
                        });

                    }


                },
                error: function(xhr, status, errorThrown) {
                    //Here the status code can be retrieved like;
                    console.log(xhr.status);
                    //The message added to Response object in Controller can be retrieved as following.
                    console.log(xhr.responseText);
                }
            });
        });



    });
</script>

{{-- <script>
     //Sweet alert
     Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'This is test',
                showConfirmButton: false,
                timer: 1500
            });
</script> --}}

@endpush
