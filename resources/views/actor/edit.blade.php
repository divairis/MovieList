@extends('layout.main')
@section('css')
<style>
    ul.list {
        width: 100%
    }

</style>
@endsection
@section('content')

<!-- Product Section Begin -->
<section class="product-page spad">
    <div class="container">
        <div class="row">
            <div class="col-lg">
                <div class="product__page__content">
                    <div class="product__page__title">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-6">
                                <div class="section-title">
                                    <h4>Edit actor</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="add__form">
                            @if ($errors->any())
                            <div class="alert alert-danger text-center" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif;
                            <form method="POST" action="{{ route('actor_update') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="actor_id" value="{{ $actor->actor_id }}">
                                <div class="input__item">
                                    <label class="add-label">Name</label>
                                    <input type="text" name='name' class="form-control" placeholder="name"
                                        value="{{ old('name')!=null ? old('name') : $actor->name }}">
                                </div>
                                <div class="input__item">
                                    <label class="add-label">Gender</label>
                                    <select name="gender" class="form-control w-100 pb-5">
                                        @if (old('gender')!=null)
                                        <option value="Male" {{ old('gender')=="Male" ? "selected" : ""}}>Male</option>
                                        <option value="Female" {{ old('gender')=="Female" ? "selected" : ""}}>Female
                                        </option>
                                        @else
                                        <option value="Male" {{ $actor->gender=="Male" ? "selected" : ""}}>
                                            Male</option>
                                        <option value="Female" {{ $actor->gender=="Female" ? "selected" : ""}}>
                                            Female</option>
                                        @endif
                                    </select>
                                </div>
                                <div style="margin-bottom: 5rem!important;"></div>
                                <div class="input__item">
                                    <label class="add-label">Biography</label>
                                    <textarea name="biography" class="form-control" placeholder="Description" cols="30"
                                        rows="10">{{ old('biography')!=null ? old('biography') : $actor->biography }}</textarea>
                                </div>
                                <div class="input__item">
                                    <label class="add-label">Date of Birth</label>
                                    <input type="date" name='dob' class="form-control" placeholder="Date of Birth"
                                        value="{{ old('dob')!=null ? old('dob') : $actor->dob }}">
                                </div>
                                <div class="input__item">
                                    <label class="add-label">Place of Birth</label>
                                    <input type="text" name="pob" class="form-control" placeholder="Place of Birth"
                                        value="{{ old('pob')!=null ? old('pob') : $actor->pob }}">
                                </div>
                                <div class="input__item">
                                    <label class="add-label">Image URL</label>
                                    <input type="file" name="image" class="form-control pt-2"
                                        accept=".jpeg, .jpg, .png, .gif">
                                </div>
                                <div class="input__item">
                                    <label class="add-label">Popularity</label>
                                    <input type="text" name="popularity" class="form-control" max="100"
                                        placeholder="Popularity"
                                        value="{{ old('popularity')!=null ? old('popularity') : $actor->popularity }}"
                                        pattern="^\d*(\.\d{0,2})?$" />
                                    <small class="form-text text-muted">
                                        input example: 10 or 99.5
                                    </small>
                                </div>
                                <button type="submit" class="site-btn">Edit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!-- Product Section End -->
@endsection
