@extends('layout.main')
@section('css')
<style>
    .none:hover {
        text-decoration:  !important none;
    }

</style>
@endsection
@section('content')

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                    <span>Actor</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Product Section Begin -->
<section class="product-page spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="product__page__content">
                    <div class="product__page__title">
                        <div class="row">
                            <div class="col-lg-7 col-md-7 col-sm-7">
                                <div class="section-title">
                                    <h4>Actors</h4>
                                </div>
                            </div>
                            @can('user')
                            <div class="col-lg-2 col-md-2 col-sm-2">

                            </div>
                            @endcan
                            @guest
                            <div class="col-lg-2 col-md-2 col-sm-2">

                            </div>
                            @endcan
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="product__page__filter">
                                    <form action="{{ route('actor') }}" method="get">
                                        <input type="text" name="s" class="form-control"
                                            placeholder="Search Actor Name">
                                    </form>
                                </div>
                            </div>
                            @can('admin')
                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <a href="{{ route('actor_add') }}"
                                    class="btn btn-danger btn-rounded btn-md border-0 rounded">Add Actor</a>
                            </div>
                            @endcan
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($actors as $actor)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                @if(file_exists(public_path("storage/$actor->image_url")))
                                <div class="product__item__pic set-bg"
                                    data-setbg="{{ asset('storage/'.$actor->image_url) }}">
                                </div>
                                @else
                                <div class="product__item__pic set-bg" data-setbg="{{ $actor->image_url }}">
                                </div>
                                @endif
                                <div class="product__item__text">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <h5><a
                                                    href="{{ route('actor_detail', ['actor_id' => $actor->actor_id]) }}">{{ $actor->name }}</a>
                                            </h5>
                                        </div>
                                    </div>
                                    <ul>
                                        @foreach ($actor->movies as $actor_movie)
                                        <li>{{ $actor_movie->title }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->
@endsection
