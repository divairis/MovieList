    @extends('layout.main')
    @section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('home') }}"><i class=" fa fa-home"></i> Home</a>
                        <a href="{{ route('actor') }}">Actors</a>
                        <span>{{ $actor->name }}</span>
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
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="product__sidebar">
                        <div class="product__sidebar__view">
                            <div class="filter__gallery">
                                @if(file_exists(public_path("storage/$actor->image_url")))
                                <div class="product__sidebar__view__item set-bg mix day years"
                                    data-setbg='{{ asset("storage/$actor->image_url") }}' style="height: 400px;">
                                    @else
                                    <div class="product__sidebar__view__item set-bg mix day years"
                                        data-setbg="{{ $actor->image_url }}" style="height: 400px;">
                                        @endif
                                        @can('admin')
                                        <a href="{{ route('actor_destroy', ['actor_id' => $actor->actor_id]) }}">
                                            <div class="ep">
                                                <i class="fa fa-trash"></i></div>
                                        </a>
                                        <a href="{{ route('actor_edit', ['actor_id' => $actor->actor_id]) }}">
                                            <div class="view">
                                                <i class="fa fa-pencil"></i>
                                            </div>
                                        </a>
                                        @endcan
                                    </div>
                                    <h3 class="text-light mb-3 font-weight-bold">Personal Info</h3>
                                    <h6 class="text-light mb-3 font-weight-bold">Popularity</h6>
                                    <h6 class="text-secondary mb-3 font-weight-bold">{{ $actor->popularity }}</h6>
                                    <h6 class="text-light mb-3 font-weight-bold">Gender</h6>
                                    <h6 class="text-secondary mb-3 font-weight-bold">{{ $actor->gender }}</h6>
                                    <h6 class="text-light mb-3 font-weight-bold">Birthday</h6>
                                    <h6 class="text-secondary mb-3 font-weight-bold">{{ $actor->dob }}</h6>
                                    <h6 class="text-light mb-3 font-weight-bold">Place of birth</h6>
                                    <h6 class="text-secondary mb-3 font-weight-bold">{{ $actor->pob }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="product__page__content">
                            <div class="product__page__title">
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-6">
                                        <div class="section-title">
                                            <h4>{{ $actor->name }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="add__form mb-5">
                                <div class="input__item">
                                    <label class="add-label">Biography</label>
                                    <textarea name="biography" class="form-control" disabled cols="30"
                                        rows="12">{{ $actor->biography }}</textarea>
                                </div>
                            </div>
                            <h3 class="text-light mb-3 font-weight-bold">Known For</h3>
                            <div class="row">
                                @foreach ($actor->movies as $movie)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        @if(file_exists(public_path("storage/$movie->image_url")))
                                        <div class="product__item__pic set-bg"
                                            data-setbg="{{ asset('storage/'.$movie->image_url) }}">
                                        </div>
                                        @else
                                        <div class="product__item__pic set-bg" data-setbg="{{ $movie->image_url }}">
                                        </div>
                                        @endif
                                        <div class="product__item__text">
                                            <h5><a href="#">{{ $movie->title }}</a></h5>
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
