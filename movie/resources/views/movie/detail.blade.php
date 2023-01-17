@extends('layout.main')

@section('content')
<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
                    <a href="{{ route('home') }}">Movies</a>
                    <span>{{ $movie->title }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Anime Section Begin -->
<section class="anime-details spad">
    <div class="container">
        @if(file_exists(public_path("storage/".$movie->background)))
        <div class="anime__details__content set-bg" data-setbg="{{ asset("storage/".$movie->background) }}">
            @else
            <div class="anime__details__content set-bg" data-setbg="{{ $movie->background }}">
                @endif
                <div class="row">
                    <div class="col-lg-3">
                        @if(file_exists(public_path("storage/$movie->image_url")))
                        <div class="anime__details__pic set-bg" data-setbg="{{ asset("storage/$movie->image_url") }}">
                        </div>
                        @else
                        <div class="anime__details__pic set-bg" data-setbg="{{ $movie->image_url }}">
                        </div>
                        @endif;
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3>{{ $movie->title }}</h3>
                                <span>
                                    @foreach ($movie->genre as $genre)
                                    {{ $genre->name }}@if(!$loop->last),@endif
                                    @endforeach
                                </span>
                            </div>
                            <p>
                                {{ $movie->description }}
                            </p>
                            <div class="anime__details__widget">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Release Date:</span> {{ $movie->release_date->format("Y") }}</li>
                                            <li><span>Director:</span> {{ $movie->director }}</li>
                                            <li><span>Genre:</span>
                                                @foreach ($movie->genre as $genre)
                                                {{ $genre->name }}@if(!$loop->last),@endif
                                                @endforeach
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @can('admin')
                            <div class="anime__details__btn">
                                <a href="{{ route('movie_edit', ['movie_id' => $movie->movie_id]) }}"
                                    class="follow-btn">Edit</a>
                                <a href="{{ route('movie_destroy', ['movie_id' => $movie->movie_id]) }}"
                                    class="watch-btn"><span>Delete</span></a>
                            </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="anime__details__review">
                        <div class="section-title">
                            <h5>Cast</h5>
                        </div>
                        <div class="row">
                            @foreach ($movie->movie_actor as $actor)
                            <div class="col-lg-3">
                                <div class="product__item">
                                    @if(file_exists(public_path("storage/".$actor->actor->image_url)))
                                    <div class="product__item__pic set-bg"
                                        data-setbg="{{ asset('storage/'.$actor->actor->image_url) }}">
                                        @else
                                        <div class="product__item__pic set-bg"
                                            data-setbg="{{ $actor->actor->image_url }}">
                                            @endif
                                        </div>
                                        <div class="product__item__text">
                                            <h5><a
                                                    href="{{ route('actor_detail', ['actor_id' => $actor->actor->actor_id]) }}">
                                                    {{ $actor->actor->name }}
                                                </a>
                                                <small class="form-text text-muted">
                                                    {{ $actor->character_name }}
                                                </small>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="anime__details__sidebar">
                            <div class="section-title">
                                <h5>you might like...</h5>
                            </div>
                            <div class="row">
                                @foreach ($random_movies as $random_movies)
                                <div class="col-lg-3">
                                    <div class="product__item">
                                        @if(file_exists(public_path("storage/".$random_movies->image_url)))
                                        <div class="product__item__pic set-bg"
                                            data-setbg="{{ asset('storage/'.$random_movies->image_url) }}">
                                            @else
                                            <div class="product__item__pic set-bg"
                                                data-setbg="{{ $random_movies->image_url }}">
                                                @endif
                                                <div class="comment">
                                                    {{ $random_movies->release_date->format('Y') }}
                                                </div>
                                                @auth
                                                @can('user')
                                                @if(!in_array($random_movies->movie_id, $user_watchlist))
                                                <a
                                                    href="{{ route('user_watchlist_add', ['movie_id' => $random_movies->movie_id]) }}">
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
                                                        href="{{ route('movie_detail', ['movie_id' => $random_movies->movie_id]) }}">{{ $random_movies->title }}</a>
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
            </div>
</section>
<!-- Anime Section End -->
@endsection
