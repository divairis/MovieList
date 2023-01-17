@extends('layout.main')
@section('css')
<style>
    .add__form form button {
        margin-top: 0px;
    }

    .selection .select2-selection {
        padding: 8px 0px 18px 20px;
    }

    .nice-select {
        padding-bottom: 42px;
    }

</style>
@endsection
@section('content')

<!-- Product Section Begin -->
<section class="product-page spad">
    <div class="container">
        <div class="col-lg">
            <div class="product__page__content">
                <div class="product__page__title">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-6">
                            <div class="section-title">
                                <h4>Add new movie</h4>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($errors->any())
                <div class="alert alert-danger text-center" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif;
                <div class="row">
                    <div class="add__form">
                        <form action="{{ route('movie_store') }}" method='POST' enctype="multipart/form-data">
                            @csrf
                            <div class="input__item">
                                <label class="add-label">Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Title"
                                    value="{{ old('title') }}">
                            </div>
                            <div class="input__item">
                                <label class="add-label">Description</label>
                                <textarea name="description" class="form-control" placeholder="Description" cols="30"
                                    rows="10">{{ old('description') }}</textarea>
                            </div>
                            <div class="input__item">
                                <label class="add-label">Genre</label>
                                <select class="form-control w-100 select2-multi" multiple="multiple" name="genre[]">
                                    @if ($errors->any())
                                    @for ($i = 0, $count = count(old('genre')); $i < $count; $i++) @foreach ($genres as
                                        $genre) <option value="{{ $genre }}"
                                        {{ $genre== old("genre.$i") ? 'selected' : ''}}>
                                        {{ $genre }}
                                        </option>
                                        @endforeach
                                        @endfor
                                        @else
                                        @foreach ($genres as $genre)
                                        <option value="{{ $genre }}">{{ $genre }}</option>
                                        @endforeach
                                        @endif
                                </select>
                            </div>
                            <div class="input__item">
                                <label class="add-label">Actors</label>
                                <div class="container" id='actor'>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div id="actor-target">
                                                <div hidden>
                                                    <div id="actor-row">
                                                        <div class="row mb-3">
                                                            <div class="col-6">
                                                                <label class="add-label">Actor</label>
                                                                <select name="actor[]" class="form-control w-100">
                                                                    <option value="">Pilih Actor</option>
                                                                    @foreach ($actors as $actor)
                                                                    <option value="{{ $actor->actor_id }}">
                                                                        {{ $actor->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-6">
                                                                <label class="add-label">Character name</label>
                                                                <input type="text" name="character_name[]"
                                                                    class="form-control" placeholder="Character Name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($errors->any())
                                                @for ($i = 1, $count = count(old('character_name')); $i < $count; $i++)
                                                    <div class="row mb-3">
                                                    <div class="col-6">
                                                        <label class="add-label">Actor</label>
                                                        <select name="actor[]" class="form-control w-100" required>
                                                            <option value="">Pilih Actor</option>
                                                            @foreach ($actors as $actor)
                                                            <option value="{{ $actor->actor_id }}"
                                                                {{ $actor->actor_id == old("actor.$i") ? 'selected' : ''}}>
                                                                {{ $actor->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="add-label">Character name</label>
                                                        <input type="text" name="character_name[]" class="form-control"
                                                            placeholder="Character Name"
                                                            value='{{ old("character_name.$i") }}'>
                                                    </div>
                                            </div>
                                            @endfor
                                            @else
                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    <label class="add-label">Actor</label>
                                                    <select name="actor[]" class="form-control w-100" required>
                                                        <option value="">Pilih Actor</option>
                                                        @foreach ($actors as $actor)
                                                        <option value="{{ $actor->actor_id }}">
                                                            {{ $actor->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <label class="add-label">Character name</label>
                                                    <input type="text" name="character_name[]" class="form-control"
                                                        placeholder="Character Name">
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col mt-3">
                                        <button type="button" class="btn btn-primary btn-sm pull-right"
                                            id="add-actor">Add
                                            Actor</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="input__item">
                        <label class="add-label">Director</label>
                        <input type="text" name=' director' class="form-control" placeholder="Director"
                            value="{{ old('director') }}">
                    </div>
                    <div class="input__item">
                        <label class="add-label">Release Date</label>
                        <input type="date" name='release_date' class="form-control" placeholder="Release Date"
                            value="{{ old('release_date') }}">
                    </div>
                    <div class="input__item">
                        <label class="add-label">Image URL</label>
                        <input type="file" name="image" class="form-control pt-2" accept=".jpeg, .jpg, .png, .gif">
                    </div>
                    <div class="input__item">
                        <label class="add-label">Background URL</label>
                        <input type="file" name="background" class="form-control pt-2" accept=".jpeg, .jpg, .png, .gif">
                    </div>
                    <button type="submit" class="site-btn">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!-- Product Section End -->
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('.select2-multi').niceSelect('destroy');
        $('.select2-multi').select2({
            placeholder: "Select Genres",
            width: 'resolve'
        });
        $('#add-actor').click(function () {
            select_actor = $('#actor-row').clone();
            $('#actor-target').append(select_actor);
        })
    });

</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js">
</script>
@endsection
