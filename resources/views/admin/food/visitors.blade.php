@extends('admin.layouts.food-master')

@section('title', 'Admin Visitor Dashboard')

@push('styles')
<link rel="stylesheet" href="{{ asset('all-assets/common/export-datatable/css/1.10.21/dataTables.bootstrap4.min.css') }}">
@endpush



@section('content')

<section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Visitor Hit Information
                    
                    </h4>

                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard table-responsive">
                        <table id="jsDataTable" class="table table-striped table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Register</th>
                                    <th>IP Address</th>
                                    <th>OS Virson</th>
                                    <th>Browser Name</th>
                                    <th>Device Type</th>
                                    <th>Country Name</th>
                                    <th>Region Name</th>
                                    <th>City Name</th>
                                    <th>Zip  Code</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                </tr>
                            </thead>


                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection


@push('scripts')

<script src="{{ asset('all-assets/common/export-datatable/js/1.10.21/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('all-assets/common/export-datatable/js/1.10.21/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>




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
            order: [[ 1, "desc" ]],
            ajax: {
                url: "\all",
            },
            columns: [
                {
                    data: 'id',
                    name: 'id',
                },
                {
                    data: 'register',
                    custom: 'register',
                },
                {
                    data: 'ip',
                    name: 'ip',
                },
                {
                    data: 'os',
                    name: 'os',
                },
                {
                    data: 'browser',
                    name: 'browser',
                },
                {
                    data: 'device',
                    name: 'device',
                },
                {
                    data: 'country_name',
                    name: 'country_name',
                },
                {
                    data: 'region_name',
                    name: 'region_name',
                },
                {
                    data: 'city_name',
                    name: 'city_name',
                },
                {
                    data: 'zip_code',
                    name: 'zip_code',
                },
                {
                    data: 'latitude',
                    name: 'latitude',
                },
                {
                    data: 'longitude',
                    name: 'longitude',
                },
                
            ]
        });


    

    });



</script>


@endpush
