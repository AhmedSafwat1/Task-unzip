@extends('layout.dasboard.master')

@section('content')

    @include('layout.dasboard._msg')

    <main class="login-form mt-5">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Page</div>
                        <div class="card-body">

                            <form action="{{ route('dashboard.pages.store') }}" method="POST" id="handleAjax"
                                enctype="multipart/form-data">

                                @csrf

                                <div id="errors-list"></div>

                                <div class="form-group row">
                                    <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>
                                    <div class="col-md-6">
                                        <input type="text" id="title" class="form-control" name="title" required
                                            autofocus>
                                        @if ($errors->has('title'))
                                            <span class="text-danger">{{ $errors->first('title') }}</span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group row mt-5">
                                    <label for="content" class="col-md-4 col-form-label text-md-right">Title</label>
                                    <div class="col-md-6">
                                        <textarea id="content" rows="8" cols="80" class="form-control ltrEditor" name="content" required> </textarea>
                                        @if ($errors->has('content'))
                                            <span class="text-danger">{{ $errors->first('content') }}</span>
                                        @endif
                                    </div>
                                </div>




                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Create
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


@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.5/tinymce.min.js"></script>


    <script>
        var editor_LTR = {
            path_absolute: "/",
            selector: "textarea.ltrEditor",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern",
                "advlist directionality autolink autosave link image lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "table contextmenu textcolor paste textcolor"
            ],
            toolbar: "insertfile undo redo | styleselect | fontselect | fontsizeselect | forecolor | backcolor| bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | rtl | ltr ",
            content_css: ['//fonts.googleapis.com/css?family=Indie+Flower'],
            font_formats: 'Arial Black=arial black,avant garde;Indie Flower=indie flower, cursive;Times New Roman=times new roman,times;',
            relative_urls: false
        };


        tinymce.init(editor_LTR);
    </script>
@endpush
