@extends('admin.layouts.food-master')

@section('title', 'Admin Product Dashboard')

@push('styles')
<!-- Summernote Editor CSS -->
<link href="{{ asset('all-assets/admin/app-assets/custom/summernote/summernote-lite.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('all-assets/common/export-datatable/css/1.10.21/dataTables.bootstrap4.min.css') }}">
@endpush



@section('content')

<section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Products
                        @can('insert')
                            <button class="btn gradient-nepal white big-shadow float-right" id="create_record"
                            >Add <i class="fas fa-plus"></i>
                            </button>
                        @endcan
                    </h4>

                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard table-responsive">
                        <table id="jsDataTable" class="table table-striped table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Details</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



{{-- Modal --}}
@include('admin.food.modals.product')



@endsection


@push('scripts')

<script src="{{ asset('all-assets/common/export-datatable/js/1.10.21/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('all-assets/common/export-datatable/js/1.10.21/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>


<!-- Summernote JS -->
<script src="{{ asset('all-assets/admin/app-assets/custom/summernote/summernote-lite.js') }}"></script>


<script type="text/javascript">

(function( $ ) {
    $(document).ready(function(){


        $('#details').summernote({
            placeholder: 'Write Detail about this issue.',
            tabsize: 5,
            height: 100,
            toolbar: [
                ['style', ['bold', 'italic', 'underline']],
                ['font', ['strikethrough']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ],
        });




        //All Data
        $('#jsDataTable').DataTable({
            language: {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw green"></i><span class="sr-only">Loading...</span> '},
            processing: true,
            serverSide: true,
            pagingType: "full_numbers",
            stateSave: true,


            ajax: {
                url: "\all",
            },
            columns: [
                {
                    data: 'ImgSrc',
                    custom: 'ImgSrc',
                    width: "15%",
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'details',
                    custom: 'details',
                    class: "text-left"
                },

                {
                    data: 'action',
                    custom: 'action',
                    orderable: false,
                    searchable: false,
                    width: "10%"

                }
            ]
        });


        //Create New Record
        $('#create_record').click(function(){
                $('.modal-title').text('Add New Record');
                $('#action_button').val('Add');
                $('#action').val('Add');
                $('#form_result').html('');
                $('#image').val('');
                $('#preview1').attr('src', '');
                $('#details').summernote ('code', '');
                $('#formModal').modal('show');
        });



        //Fetch App Subcategory
        // $("#Category").on("change", function() {
        //     var cat_id = $(this).val();
        //     jQuery.ajax({
        //         url: "{{ route('product.subcategory') }}",
        //         type: "GET",
        //         data: { cat_id: cat_id },
        //         success: function(data) {
        //             $('#SubCategory').empty();
        //             $.each(data, function(index, subcatObj){
        //             $('#SubCategory').append('<option value="'+subcatObj.id+'">'+subcatObj.name+'</option> ');
        //             });
        //         }
        //     });
        // });


        //Form Submit
        $('#sample_form').on('submit', function(event){
                event.preventDefault();
                var action_url = '';
                //After Submit Button Text
                $('#action_button').val('Loading.....');
                $('#action_button').prop("disabled", true);

                if($('#action').val() == 'Add')
                {
                action_url = "store";
                }

                if($('#action').val() == 'Edit')
                {
                action_url = "update";
                }

                $.ajax({
                    url: action_url,
                    method:"POST",
                    data: new FormData(this),
                    contentType: false,
                    cache:false,
                    processData: false,
                    dataType:"json",

                    success:function(data)
                        {
                            var html = '';
                            if(data.errors)
                                {
                                    html = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                                    for(var count = 0; count < data.errors.length; count++)
                                    {
                                        html += '<li class="text-light">' + data.errors[count] + '</li>';
                                    }
                                    html += '</div>';

                                    //Submit Button Text
                                    if($('#action').val() == 'Add') {
                                        $('#action_button').val('Add');
                                    }else{
                                        $('#action_button').val('Edit');
                                    }
                                    $('#action_button').prop("disabled", false);
                                    //Show Validation
                                    $('#form_result').html(html);
                                }
                            if(data.success)
                                {
                                    $('#action_button').prop("disabled", false);
                                    $('#sample_form')[0].reset();
                                    $('#formModal').modal('hide');
                                    $('#jsDataTable').DataTable().ajax.reload(null, false);

                                    Toast.fire({
                                        icon: data.icon,
                                        title: data.success
                                    })
                                }


                         },
                        error: function (xhr, status, errorThrown) {
                            //Here the status code can be retrieved like;
                            console.log(xhr.status);
                            //The message added to Response object in Controller can be retrieved as following.
                            console.log(xhr.responseText);
                        }
                });
        });


        //Update Record
        $(document).on('click', '.edit', function(){

            //From Tbl Field
            let id = $(this).attr('id');

            //Validation Result
            $('#form_result').html('');
            $('#SubCategory').empty();
            $('#image').val('');
            $('#image2').val('');
            $('#image3').val('');

            //AJAX Request
            $.ajax({
                url:"edit/"+id,
                dataType:"json",
                success:function(data)
                {

                    //console.log(data);
                    $('#hidden_id').val(data.main.id);
                    $('#title').val(data.main.title);
                    $('#price').val(data.main.price);
                    $('#Category').val(data.main.cat_id);
                    //$('#SubCategory').append('<option value=" '+data.subcategory.id+' ">'+data.subcategory.name+'</option>');
                    $('#details').summernote ('code', data.main.details);
                    $('#preview1').attr("src", "{{ asset('/') }}"+ data.main.image_small);
                    $('#preview2').attr("src", "{{ asset('/') }}"+ data.main.image2_small);
                    $('#preview3').attr("src", "{{ asset('/') }}"+ data.main.image3_small);

                    $('.modal-title').text('Edit Record');
                    $('#action_button').val('Edit');
                    $('#action').val('Edit');
                    //Show Modal
                    $('#formModal').modal('show');
                },
                error: function (xhr, status, errorThrown) {
                    //Here the status code can be retrieved like;
                    console.log(xhr.status);
                    //The message added to Response object in Controller can be retrieved as following.
                    console.log(xhr.responseText);
                }
            })
        });



        //Delete
        $(document).on('click', '.delete', function(){
            let delID = $(this).attr('id');

             Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {

                    if (result.value) {

                        $.ajax({
                                url:"delete/"+delID,
                                success:function(data)
                                {

                                    $('#jsDataTable').DataTable().ajax.reload(null, false);
                                   //Sweet alert
                                    Swal.fire({
                                        position: 'center',
                                        icon: data.icon,
                                        title: data.success,
                                        showConfirmButton: false,
                                        timer: 1500
                                    })

                                },
                                error: function (xhr, status, errorThrown) {
                                        //Here the status code can be retrieved like;
                                        console.log(xhr.status);
                                        //The message added to Response object in Controller can be retrieved as following.
                                        console.log(xhr.responseText);
                                    }
                            })


                    }
                })


        });


        //Delete
        $(document).on('click', '.activeStatus, .deactiveStatus', function(){
            var currentId = $(this).attr('id');
            var makeValue = $(this).attr('makeValue');

            if(makeValue == '1'){
                var msgText = "You want to active this!";
                var msgIcon = "warning";
                var msgBtn = "Active !!";
            }else{
                var msgText = "You want to deactive this!";
                var msgIcon = "warning";
                var msgBtn = "Deactive !!";
            }

             Swal.fire({
                title: 'Are you sure?',
                text: msgText,
                icon: msgIcon,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: msgBtn
                }).then((result) => {

                    if (result.value) {

                        $.ajax({
                                url:"status/"+currentId+"/"+makeValue,
                                success:function(data)
                                {

                                    $('#jsDataTable').DataTable().ajax.reload(null, false);
                                   //Sweet alert
                                    Swal.fire({
                                        position: 'center',
                                        icon: data.icon,
                                        title: data.success,
                                        showConfirmButton: false,
                                        timer: 1500
                                    })

                                },
                                error: function (xhr, status, errorThrown) {
                                        //Here the status code can be retrieved like;
                                        console.log(xhr.status);
                                        //The message added to Response object in Controller can be retrieved as following.
                                        console.log(xhr.responseText);
                                    }
                            })


                    }
                })


        });


    });


})(jQuery);



</script>


@endpush
