@extends('user.layout.user-master')
@section('title', 'CP Five Star Franchisee')

@push('page-css')

<style>
.form-group.required .control-label:after {content:"*"; color:red; font-weight: bold;}
</style>

@endpush

@section('content')
<div class="page-wrapper">

    <!-- start: Inner page hero -->
    <div class="inner-page-hero header-bg">
        <div class="container">
            <h2 class="text-white">Franchisee</h2>
        </div>
        <!-- end:Container -->
    </div>

    <!-- end:Inner page hero -->
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="{{ url('/') }}" class="active">Home</a></li>
                <li class="text-danger">Franchisee</li>
            </ul>
        </div>
    </div>

    <section class="contact-page inner-page">

        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-lg-offset-2">

                    <div class="row mb-4">
                        <div class="sidebar-title white-txt">
                            <h6>Apply For Franchisee</h6> <i class="fas fa-utensils float-right"></i>
                        </div>
                    </div>



                    <span id="form_result"></span>

                    <form id="sample_form" method="POST">

                        @csrf

                        <div class="controls">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group required">
                                        <label class="control-label" for="form_name">Name </label>
                                        <input id="form_name" type="text" name="name" class="form-control" placeholder="Please enter your firstname *" required="required" >

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group required">
                                        <label class="control-label" for="form_age">Age </label>
                                        <input id="form_age" type="number" name="age" class="form-control" placeholder="Please enter your Age *" required="required" >

                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group required">
                                        <label class="control-label" for="form_occupation">Occupation </label>
                                        <input id="form_occupation" type="text" name="occupation" class="form-control" placeholder="Please enter your occupation *" required="required" >

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group required">
                                        <label class="control-label" for="form_gender">Gender </label>
                                        <select name="gender" class="form-control" required="required">
                                            <option  value="" disabled selected >Select Gender</option>
                                            <option value="Male" >Male</option>
                                            <option value="Female" >Female</option>
                                            <option value="Others" >Others</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="form_email">Email </label>
                                        <input id="form_email" type="email" name="email" class="form-control" placeholder="Please enter your email" >

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group required">
                                        <label class="control-label" for="form_phone">Phone </label>
                                        <input id="form_phone" type="tel" name="contact" class="form-control" placeholder="Please enter your phone">

                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group required">
                                        <label class="control-label" for="form_address">Address </label>
                                        <input id="form_address" type="address" name="address" class="form-control" placeholder="Please enter your address">

                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group required">
                                        <label class="control-label" for="form_location">Location for Outlet</label>
                                        <input id="form_location" type="text" name="location" class="form-control" placeholder="Please enter your location for outlet*" required="required" >

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="submit" id="action_button" class="btn btn-success btn-block" value="Apply for Franchisee">
                                </div>
                            </div>

                        </div>

                    </form>


                </div>

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
                url: "{{ route('user.franchisee.apply.action') }}",
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

                        $('#action_button').val('Apply for Franchisee');
                        $('#action_button').prop("disabled", false);
                        //Show Validation
                        $('#form_result').html(html);
                    }
                    if (data.success) {
                        $('#action_button').prop("disabled", false);
                        $('#action_button').val('Apply for Franchisee');
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

@endpush
