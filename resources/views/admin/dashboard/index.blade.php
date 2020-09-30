@extends('admin.layouts.common')

@section('title', 'Admin Dashboard')


@section('content')

<div class="row justify-content-center">
    <div class="col-md-6 my-auto">
        <div class="card">
            <div class="card-header">Admin Dashboard</div>

            <div class="card-body">

                <h1>Admin Dashboard</h1>

                <div class="btn btn-danger" >
                    <a  href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>



            </div>
        </div>
    </div>
</div>

@endsection
