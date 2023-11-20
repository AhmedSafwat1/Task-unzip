@extends('layout.dasboard.master')

@section('content')
    <div class="mt-5">
        <a href="{{ route('dashboard.pages.create') }}" class="btn btn-info">Create</a>
    </div>
    <div class="table-container">
        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-success">
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Created_at</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($models as $model)
                    <tr>
                        <th scope="row">{{ $model->id }}</th>
                        <td>{{ $model->title }}</td>
                        <td>{{ $model->slug ?? 0 }}</td>
                        <td>{{ $model->created_at->format('d-m-Y h:i a') }}</td>
                        <td>
                            <a class="btn btn-warning" href="{{ route('website.page', $model->slug) }}">Show</a>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {!! $models->links() !!}
        </div>
    </div>
@endsection
