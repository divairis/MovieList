@extends('layout.main')

@section('css')
<style>
    table tr td,
    table tr th {
        background-color: rgb(11, 12, 42) !important;
    }

    .table {
        border: 1px solid #dddddd;
    }

    img {
        min-width: 200px;
        min-height: 300px;

        max-width: 200px;
        max-height: 300px;
    }

</style>
@endsection

@section('content')
<section class="product-page spad">
    <div class="container">

        <div class="row">
            <div class="col-lg">
                <div class="product__sidebar__comment">
                    <div class="section-title">
                        <h5>My Watchlist</h5>
                    </div>
                    <form action="{{ route('user_watchlist') }}" method="get">
                        <input type="text" name="s" class="form-control mb-4" placeholder="Search Your Watchlist">
                    </form>
                    <div class="row">
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-sm-1">
                                    <p class="text-light">Sort by:</p>
                                </div>
                                <div class="col-sm-9">
                                    <div class="product__page__filter">
                                        <select onchange="location = this.value;">
                                            <option value="?">All</option>
                                            <option value="?status=Finished">Finished</option>
                                            <option value="?status=Watching">Watching</option>
                                            <option value="?status=Planned">Planned</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product__sidebar__comment__item">
                        <div class="table-responsive-md">
                            <table class="table table-dark">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col" style="width: 30%">Poster</th>
                                        <th class="text-center" scope="col">Title</th>
                                        <th class="text-center" scope="col">Status</th>
                                        <th class="text-center" scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $dt)
                                    <tr style="border-bottom: 2px;">
                                        <td class="text-center" scope="row">
                                            @if(file_exists(public_path("storage/".$dt->movie->image_url)))
                                            <img src="{{ asset("storage/".$dt->movie->image_url) }}" width="200px"
                                                height="300px">
                                            @else
                                            <img src="{{ $dt->movie->image_url }}" alt="">
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $dt->movie->title }}</td>
                                        <td class="text-center" class="font-weight-bold">
                                            <a class="text-{{ 
                                                ($dt->status=='Finished' ? 'success': 
                                                ($dt->status=='Watching' ? 'info' :'warning'))
                                            }}">
                                                {{ $dt->status  }}
                                            </a>
                                        </td>
                                        <td class="text-center"><button type="button" class="btn btn-outline-light"
                                                data-toggle="modal" data-target="#exampleModal"
                                                data-id="{{ $dt->user_watchlist_id }}"
                                                data-movie="{{ $dt->movie->title }}" data-status="{{ $dt->status }}">
                                                ...
                                            </button>
                                            <a href="{{ route('user_watchlist_destroy', ['user_watchlist_id' => $dt->user_watchlist_id]) }}"
                                                class="btn btn-danger btn-rounded"><i class="fa fa-trash">&nbsp;</i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('user_watchlist_status') }}">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="user_watchlist_id" id="user_watchlist_id">
                    <div class="form-group">
                        <label for="status" class="col-form-label">Status:</label>
                        <select class="form-control w-100" name="status" id="status">
                            <option value="Finished">Finished</option>
                            <option value="Watching">Watching</option>
                            <option value="Planned">Planned</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function () {
        $("#status").niceSelect('destroy');
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var movie = button.data('movie');
            var status = button.data('status');

            var modal = $(this);
            modal.find('.modal-title').text('Change Status Movie "' + movie + '"');
            modal.find('#user_watchlist_id').val(id);
            modal.find('#status').val(status);
        })
    });

</script>
@endsection
