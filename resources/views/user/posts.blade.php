@extends('user.layout.user-master')
@section('title', 'CP Five Star Posts')

@section('content')
 <div class="page-wrapper">

            <!-- start: Inner page hero -->
            <div class="inner-page-hero header-bg" >
                <div class="container">
                    <h2 class="text-white">All Posts</h2>
                </div>
                <!-- end:Container -->
            </div>

            <!-- end:Inner page hero -->
            <div class="breadcrumb">
                <div class="container">
                    <ul>
                        <li><a href="{{ url('/') }}" class="active">Home</a></li>
                        <li class="text-danger">Posts</li>
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
                                    <h5><a href="{{ url('/posts-details/'.$row->id) }}">{{ Str::limit($row->title, $limit = 30 ) }}</a></h5>
                                    <div class="product-name min-height">
                                        {!! substr(strip_tags($row->details), 0, 300) !!} 
                                      <a href="{{ url('/posts-details/'.$row->id) }}"> ...... Read More.</a>
                                    </div>

                                    <div class="price-btn-block"> <span class="price"></span> <a href="{{ url('/posts-details/'.$row->id) }}" class="btn theme-btn-dash float-right"><i class="fa fa-eye" aria-hidden="true"></i> View Details</a> </div>
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
