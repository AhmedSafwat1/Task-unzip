<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Task</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @guest
                <li class="nav-item  ">
                    <a class="nav-link {{ active_menu('login') }}" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ active_menu('register') }}" href="{{ route('register') }}">Register</a>
                </li>
            @else
                <li class="nav-item ">
                    <a class="nav-link {{ active_menu('dashboard.home') }}" href="{{ route('dashboard.home') }}">Home (
                        <span class="sr-only">{{ auth()->user()->username }}</span> )</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ active_menu('zip') }}" href="{{ route('dashboard.zip.index') }}">Zip Files</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link {{ active_menu('pages') }}" href="{{ route('dashboard.pages.index') }}">Pages</a>
              </li>

            </ul>
            <form class="form-inline my-2 my-lg-0" action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button>
            </form>
        @endguest
    </div>
</nav
