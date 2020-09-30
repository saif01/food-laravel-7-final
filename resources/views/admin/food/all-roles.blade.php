@extends('admin.layouts.food-master')
@section('title', 'Admin Role Dashboard')

@push('styles')
<link rel="stylesheet" href="{{ asset('all-assets/common/export-datatable/css/1.10.21/dataTables.bootstrap4.min.css') }}">

@endpush



@section('content')

<section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Role Name

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
                                    <th>Roles</th>
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
@include('admin.food.modals.role')


@endsection


@push('scripts')

<script src="{{ asset('all-assets/common/export-datatable/js/1.10.21/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('all-assets/common/export-datatable/js/1.10.21/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>



<!-- Modal Show-->
<script src="{{ asset('all-assets/admin/app-assets/js/components-modal.min.js') }}" type="text/javascript" ></script>
{{-- Tostar + Sweetalert 2 --}}
<script src="{{ asset('all-assets/common/sweet-alert-2/sw-alert.js') }}" type="text/javascript"></script>


<script type="text/javascript">


    $(document).ready(function(){

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
                    data: 'name',
                    name: 'name'
                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    "searchable": false
                }
            ]
        });


        //Create New Record
        $('#create_record').click(function(){
                $('.modal-title').text('Add New Role');
                $('#action_button').val('Add');
                $('#action').val('Add');
                $('#form_result').html('');
                $('#name').val('');
                $('#formModal').modal('show');
        });

        //Form Submit
        $('#sample_form').on('submit', function(event){
                event.preventDefault();
                var action_url = '';

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

                                    //Show Validation
                                    $('#form_result').html(html);
                                }
                            if(data.success)
                                {
                                    //html = '<div class="alert alert-success">' + data.success + '</div>';
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
            var id = $(this).attr('id');

            //Validation Result
            $('#form_result').html('');

            //AJAX Request
            $.ajax({
                url:"edit/"+id,
                dataType:"json",
                success:function(data)
                {
                    //console.log(data);
                    $('#name').val(data.name);
                    $('#hidden_id').val(id);
                    //Set Modal Title
                    $('.modal-title').text('Edit Record');
                    //Set Action Btn Value
                    $('#action_button').val('Edit');
                    //Set Action Route Value
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


        //Define Delete ID
        var delID;

        //Delete
        $(document).on('click', '.delete', function(){
             delID = $(this).attr('id');

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





    });



</script>


@endpush
