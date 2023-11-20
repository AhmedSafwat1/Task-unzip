<!DOCTYPE html>
<html lang="en" dir="rtl">

@include('layout.dasboard._head')

<body class="">
    <div class="container-fluid ">

        @include("layout.dasboard._header")



        <div class="page-container mt-4">


            @yield('content')
        </div>


    </div>

    @include('layout.dasboard._footer')
    @include('layout.dasboard._js')
</body>

</html>
