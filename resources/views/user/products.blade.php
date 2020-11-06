@extends('user.layout.user-master')
@section('title', 'CP Five Star Products')

@section('content')
<div class="page-wrapper">

    <!-- start: Inner page hero -->
    <div class="inner-page-hero header-bg" >
        <div class="container">
            <h2 class="text-white">
                @if ($category)
                    {{ $category->name }}
                @else
                    All
                @endif

                Products
            </h2>
        </div>
        <!-- end:Container -->
    </div>

    <!-- end:Inner page hero -->
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="{{ url('/') }}" class="active">Home</a></li>
                <li><a href="{{ url('/products/all') }}">Product</a></li>
                @if ($category)
                     <li class="text-danger"> {{  $category->name }}</li>
                @endif
               
            </ul>
        </div>
    </div>

    <!-- //results show -->
    <section class="restaurants-page mt-2">
        <div class="container">
            <div class="row">

            @if ( count($allData) > 0 )

                @foreach ($allData as $row )

                <!-- Each popular food item starts -->
                <div class="col-xs-12 col-sm-6 col-md-4 food-item">
                    <div class="food-item-wrap">
                        <div class="figure-wrap bg-image zoom">
                            <img src="{{ asset($row->image) }}" height="211" width="392">
                            {{-- <div class="rating pull-left"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> </div> --}}
                        </div>
                        <div class="content">
                            <h5><a href="{{ url('/products-details/'.$row->id) }}">{{ Str::limit($row->title, $limit = 30 ) }}</a></h5>
                            <div class="product-name min-height">
                                {!! substr(strip_tags($row->details), 0, 300) !!} 
                                <a href="{{ url('/products-details/'.$row->id) }}"> Read More.</a>
                            </div>

                            <div class="price-btn-block"> <span class="price">{{ $row->price }}/= Taka</span> <a href="{{ url('/products-details/'.$row->id) }}" class="btn theme-btn-dash float-right"><i class="fa fa-eye" aria-hidden="true"></i> View Details</a> </div>
                        </div>

                    </div>
                </div>
                <!-- Each popular food item starts -->
                @endforeach

            @else

            <div class="row">
                <p class="h1 text-info my-5">Sorry !! Products are coming soon...</p>
            </div>

            @endif

            </div>

            <div>
                {{ $allData->links() }}
            </div>
        </div>
    </section>

</div>
@endsection
