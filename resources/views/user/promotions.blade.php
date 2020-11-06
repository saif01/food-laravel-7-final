@extends('user.layout.user-master')
@section('title', 'CP Five Star Promotions')

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

@section('content')
<div class="page-wrapper">

    <!-- start: Inner page hero -->
    <div class="inner-page-hero header-bg" >
        <div class="container">
            <h2 class="text-white">All Promotions</h2>
        </div>
        <!-- end:Container -->
    </div>

    <!-- end:Inner page hero -->
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="{{ url('/') }}" class="active">Home</a></li>
                <li class="text-danger">Promotions</li>
            </ul>
        </div>
    </div>

    <!-- //results show -->
    <section class="restaurants-page mt-2">
        <div class="container">
            <div class="row">

                @foreach ($allData as $row )

                <!-- Each popular food item starts -->
                <div class="col-xs-12 col-sm-6 col-md-4 food-item">
                    <div class="food-item-wrap">
                        <div class="figure-wrap bg-image zoom">
                            <img src="{{ asset($row->image) }}" height="211" width="392">
                            {{-- <div class="rating pull-left"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> </div> --}}
                        </div>
                        <div class="content">
                            <h5><a href="{{ url('/promotion-details/'.$row->id) }}">{{ Str::limit($row->title, $limit = 30 ) }}</a></h5>
                            <div class="product-name min-height"> {!! Str::limit($row->details, 300, '......') !!} <a href="{{ url('/promotion-details/'.$row->id) }}"> Read More.</a></div>


                            <div class="price-btn-block">
                                <span class="style-1">

                                        <del>
                                          <span>{{ $row->price_old }}</span>
                                        </del>
                                        <ins>
                                          <span>{{ $row->price_new }} /= Taka</span>
                                        </ins>

                                </span>

                                <a href="{{ url('/promotion-details/'.$row->id) }}" class="btn theme-btn-dash float-right"><i class="fa fa-eye" aria-hidden="true"></i> View Details</a> </div>




                        </div>

                    </div>
                </div>
                <!-- Each popular food item starts -->
                @endforeach

            </div>

            <div>
                {{ $allData->links() }}
            </div>
        </div>
    </section>

</div>
@endsection
