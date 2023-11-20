@extends('layout.dasboard.master')

@section('content')

    @include("layout.dasboard._msg")
    
    <main class="login-form mt-5">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">UploaZip</div>
                        <div class="card-body">

                            <form action="{{ route('dashboard.zip.store') }}" method="POST" id="handleAjax" enctype="multipart/form-data">

                                @csrf

                                <div id="errors-list"></div>

                                <div class="form-group row">
                                    <label for="zip" class="col-md-4 col-form-label text-md-right">Zip file</label>
                                    <div class="col-md-6">
                                        <input type="file" id="zip" class="form-control" name="zip" required
                                            autofocus>
                                        @if ($errors->has('zip'))
                                            <span class="text-danger">{{ $errors->first('zip') }}</span>
                                        @endif
                                    </div>
                                </div>




                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Upload
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@stop
