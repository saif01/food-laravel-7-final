@extends('user.layout.user-master')
@section('title', 'CP Five Star Outlets')

@section('content')
<div class="page-wrapper">
    <!-- start: Inner page hero -->
    <div class="inner-page-hero header-bg" >
        <div class="container">
            <h2 class="text-white">Our Outlets</h2>
        </div>
        <!-- end:Container -->
    </div>

    <!-- end:Inner page hero -->
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="{{ url('/') }}" class="active">Home</a></li>
                <li class="text-danger">Outlet</li>
            </ul>
        </div>
    </div>

    <section class="contact-page inner-page">
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <p class="sidebar-title" style="color:white; font-weight: bold; text-align: center;">All {{ $division }} Division's Five Star Outlet Address</p>
                    <tr style="background: #ffcb0c; ">
                        <th scope="col">#</th>
                        <th scope="col">District</th>
                        <th scope="col">Local Area</th>
                        <th scope="col">Shop Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Phone</th>
                    </tr>
                </thead>
                <tbody>
                    @php $count=1 @endphp
                    @foreach ($OutletData as $row)
                    <tr>
                        <th scope="row">{{ $count }}</th>
                        <td>{{ $row->district }}</td>
                        <td>{{ $row->local_area }}</td>
                        <td>{{ $row->shop_name }}</td>
                        <td>{{ $row->address }}</td>
                        <td><a href="tel:+88{{ $row->contact }}"> {{ $row->contact }} </a></td>
                    </tr>
                    @php $count++ @endphp
                    @endforeach

                </tbody>
            </table>
        </div>
    </section>
</div>


@endsection
