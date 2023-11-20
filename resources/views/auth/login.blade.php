@extends('layout.dasboard.master')

@section('content')
    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Login</div>
                        <div class="card-body">

                            <form action="{{ route('login.post') }}" method="POST" id="handleAjax">
                                @csrf

                                <div id="errors-list"></div>

                                <div class="form-group row">
                                    <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
                                    <div class="col-md-6">
                                        <input type="text" id="username" class="form-control" name="username" required
                                            autofocus>
                                        @if ($errors->has('username'))
                                            <span class="text-danger">{{ $errors->first('username') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="password">
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


@push('js')
    <script type="text/javascript">
        $(function() {

            /*------------------------------------------
            --------------------------------------------
            Submit Event
            --------------------------------------------
            --------------------------------------------*/
            $(document).on("submit", "#handleAjax", function() {
                var e = this;

                $(this).find("[type='submit']").html("Login...");

                $.ajax({
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    type: "POST",
                    dataType: 'json',
                    error: function(error) {
                        var data = error.responseJSON
                        $(e).find("[type='submit']").html("Login");
                        if (error.status == 422) {
                            handlerReponse(e, data)
                        } else {
                            alert(data.message ? data.message : error.responseText)
                        }
                    },
                    success: function(data) {
                        if (data.status) {
                            window.location = data.redirect;
                        }else{
                            handlerReponse(e, data)
                        }

                    }
                });

                function handlerReponse(button, data) {
                    $(button).find("[type='submit']").html("Login");
                    if (data.errors) {
                        $(".alert").remove();
                        $.each(data.errors, function(key, val) {
                            $("#errors-list").append(
                                "<div class='alert alert-danger'>" + val +
                                "</div>");
                        });
                    } else if (data.message) {
                        alert(data.message)
                    }
                }

                return false;
            });

        });
    </script>
@endpush
