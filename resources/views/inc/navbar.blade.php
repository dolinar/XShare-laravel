<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h4 class="my-0 mr-md-auto font-weight-normal">{{config('app.name', 'XShare')}}</h4>
    <nav class="my-2 my-md-0 mr-md-3">
      <a class="p-2 text-dark" href="/">Home</a>
      <a class="p-2 text-dark" href="/about">About</a>
      <a class="p-2 text-dark" href="/uploads">Gallery</a>
    </nav>
    @guest
      <a class="btn btn-outline-primary btn-space" href="{{ route('login') }}">{{ __('Login') }}</a>
      <a class="btn btn-primary" href="{{ route('register') }}">{{ __('Register') }}</a>
    @else
      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        {{ Auth::user()->name }} <span class="caret"></span>
      </a>

      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          {{ __('Logout') }}
        </a>
        <a class="dropdown-item" href="/dashboard">Dashboard</a>
        <a class="dropdown-item" href="/uploads/create">New Upload</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </div>
    @endguest
  </div>