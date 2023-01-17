@extends('layout.main')
@section('content')
<!-- Hero Section Begin -->
<section class="hero">
    <div class="container">
        <div class="hero__slider owl-carousel">
            @foreach ($random_movies as $random_movie)
            @if(file_exists(public_path("storage/$random_movie->image_url")))
            <div class="hero__items set-bg" data-setbg="{{ asset('storage/'.$random_movie->background) }}">
                @else
                <div class="hero__items set-bg" data-setbg="{{ $random_movie->background }}">
                    @endif;
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                @if (count($random_movie->genre))
                                <div class="label">
                                    @foreach ($random_movie->genre as $genre)
                                    {{ $genre->name }}
                                    @if(!$loop->last)
                                    ||
                                    @endif
                                    @endforeach
                                </div>
                                @endif
                                <h2>{{ $random_movie->title }}</h2>
                                <p>{{ $random_movie->release_date->format('Y') }}</p>
                                <a href="{{ route('movie_detail', ['movie_id' => $random_movie->movie_id]) }}"><span>Movie
                                        Detail</span> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
</section>
<!-- Hero Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg">
                <div class="popular__product">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="section-title">
                                <h4>Popular Shows</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($popular_movies as $popular_movie)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                @if(file_exists(public_path("storage/".$popular_movie->movie->image_url)))
                                <div class="product__item__pic set-bg"
                                    data-setbg="{{ asset('storage/'.$popular_movie->movie->image_url) }}">
                                    @else
                                    <div class="product__item__pic set-bg"
                                        data-setbg="{{ $popular_movie->movie->image_url }}">
                                        @endif
                                        <div class="comment">{{ $popular_movie->movie->release_date->format('Y') }}
                                        </div>
                                    </div>
                                    <div class="product__item__text">
                                        <h5><a
                                                href="{{ route('movie_detail', ['movie_id' => $popular_movie->movie->movie_id]) }}">{{ $popular_movie->movie->title }}</a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="show" id="show">
                        <div class="row mb-3">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Show</h4>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1"></div>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <form action="{{ route('home') }}" method="get">
                                    <input type="text" name="s" class="form-control" placeholder="Search...">
                                </form>
                            </div>
                        </div>
                        <div class="container text-center my-3">
                            <div class="row mx-auto my-auto">
                                <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
                                    <div class="carousel-inner w-100" role="listbox">
                                        @foreach ($genres as $genre)
                                        @if($loop->first )
                                        <div class="carousel-item active">
                                            @else
                                            <div class="carousel-item">
                                                @endif
                                                <div class="col-sm-2">
                                                    <a href="{{ route('home', ['category' => $genre]) }}"
                                                        class="btn btn-secondary btn-rounded btn-xs btn-block bg-dark border-0 rounded">{{ $genre }}</a>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <a class="carousel-control-prev w-auto" href="#recipeCarousel" role="button"
                                            data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next w-auto" href="#recipeCarousel" role="button"
                                            data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 mt-4">
                                <div class="col-sm-1">
                                    <p class="text-light">Sort by:</p>
                                </div>
                                <div class="col-sm-9">
                                    <div class="product__page__filter">
                                        <select onchange="location = this.value;">
                                            <option value="/">Latest</option>
                                            <option value="?s=!A-Z!">A-Z</option>
                                            <option value="?s=!Z-A!">Z-A</option>
                                        </select>
                                    </div>
                                </div>
                                @can('admin')
                                <div class="col-md-2">
                                    <a href="{{ route('movie_add') }}"
                                        class="btn btn-danger btn-rounded btn-md border-0 rounded float-right"><i
                                            class="fa fa-plus">&nbsp;</i>Add Movie</a>
                                </div>
                                @endcan
                            </div>

                            <div class="row">
                                @foreach ($movies as $movie)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        @if(file_exists(public_path("storage/".$movie->image_url)))
                                        <div class="product__item__pic set-bg"
                                            data-setbg="{{ asset('storage/'.$movie->image_url) }}">
                                            @else
                                            <div class="product__item__pic set-bg" data-setbg="{{ $movie->image_url }}">
                                                @endif
                                                <div class="comment">
                                                    {{ $movie->release_date->format('Y') }}
                                                </div>
                                                @auth
                                                @can('user')
                                                @if(!in_array($movie->movie_id, $user_watchlist))
                                                <a
                                                    href="{{ route('user_watchlist_add', ['movie_id' => $movie->movie_id]) }}">
                                                    <div class="view">
                                                        <i class="fa fa-plus"></i>
                                                    </div>
                                                </a>
                                                @else
                                                <a>
                                                    <div class="view">
                                                        <i class="fa fa-check" style="color: greenyellow"></i>
                                                    </div>
                                                </a>
                                                @endif
                                                @endcan
                                                @endauth
                                            </div>
                                            <div class="product__item__text">
                                                <h5><a
                                                        href="{{ route('movie_detail', ['movie_id' => $movie->movie_id]) }}">{{ $movie->title }}</a>
                                                </h5>
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
