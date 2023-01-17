@extends('layout.main')
@section('css')
<style>
    img {
        border-radius: 50%;
        cursor: pointer;
        min-width: 150px;
        min-height: 150px;
        max-width: 150px;
        max-height: 150px;
    }

</style>
@endsection
@section('content')

<!-- Signup Section Begin -->
<section class="signup spad">
    <div class="container">
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
            <div class="col-lg-6">
                <div class="login__form">
                    <h3>Update Profile</h3>
                    <form method="POST" action="{{ route('user_profile_upsert') }}">
                        <input type="hidden" name="user_id" value="{{ $user_id }}">
                        @csrf
                        <div class="input__item">
                            <input type="text" name="email" placeholder="Email address"
                                value="{{ old('email')!=null ? old('email') : $email_address }}">
                            <span class="icon_mail"></span>
                        </div>
                        <div class="input__item">
                            <input type="text" name="username" placeholder="Your Userame"
                                value="{{ old('username')!=null ? old('username') : $username }}">
                            <span class="icon_profile"></span>
                        </div>
                        <div class="input__item">
                            <input type="date" name="dob" placeholder="Date of Birth"
                                value="{{ old('dob')!=null ? old('dob') : $dob }}">
                            <span><i class="fa fa-calendar"></i></span>
                        </div>
                        <div class="input__item">
                            <input type="number" name="number" placeholder="Phone Number"
                                value="{{ old('number')!=null ? old('number') : $phone }}">
                            <span><i class="fa fa-calendar"></i></span>
                        </div>
                        <button type="submit" class="site-btn">Update Profile</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login__register">
                    <h3>My Profile</h3>
                    <img id="pop" src="{{ $image_url!=null ? $image_url : asset('img/avatar-2.png') }}" class="mb-5">
                    <h6 class="text-light mb-3 font-weight-bold">{{ $username }}</h6>
                    <h6 class="text-secondary mb-3 font-weight-bold">
                        {{ $email_address }}
                    </h6>
                </div>
            </div>
        </div>
    </div>
    {{-- modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('user_profile_upsert') }}">
                    <div class="modal-body">
                        <div class="form-group">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user_id }}">
                            <label for="recipient-name" class="col-form-label">Image URL:</label>
                            <input type="text" class="form-control" name="image_url" placeholder="Image URL"
                                value="{{ $image_url }}">
                            <small class="form-text text-muted">
                                Please upload your image to other sources first and use the URL
                            </small>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Signup Section End -->
@endsection
@section('js')
<script>
    $(document).ready(function () {
        $("#pop").click(function () {
            $('#exampleModal').modal('show');
        });
    });

</script>
@endsection
