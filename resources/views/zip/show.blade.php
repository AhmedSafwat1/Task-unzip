@extends('layout.dasboard.master')

@section('content')
    <div class="mt-5">
        <a href="{{ route('dashboard.zip.index') }}" class="btn btn-info">Zips</a>
    </div>
    <div class="table-container">
        <div class="filtes m-2">
            <form>
                <div class="row">

                    <div class="col-4">
                        <input type="text" name="search" class="form-control" placeholder="search"
                            value="{{ request()->search }}">
                    </div>

                    <div class="col-4">
                        <select class="form-control" name="type">
                            <option value="" {{ !request()->type ? 'selected' : '' }}>All</option>
                            @foreach (["file"] as $item)
                              <option value="{{$item}}" {{ request()->type == $item ? 'selected' : '' }}> {{ucfirst($item)}}</option>

                            @endforeach
                         
                        </select>
                    </div>

                    <div class="col-4">
                        <button type="submit" class="btn-success">Search</button>
                    </div>

                </div>
            </form>
        </div>
        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-success">
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Type</th>
                    <th scope="col">Extenstions</th>
                    <th scope="col">Size</th>
                    <th scope="col">Location</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($models as $model)
                    <tr>
                        <th scope="row">{{ $model->id }}</th>
                        <td>{{ $model->name }}</td>
                        <td>{{ $model->type }}</td>
                        <td>{{ $model->extension ?? "File" }}</td>
                        <td>{{ $model->size }} kB</td>
                        <td>{{ $model->location }}</td>

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
