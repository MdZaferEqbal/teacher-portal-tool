<nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand text-danger" href="{{url('/')}}">tailwebs.</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
        @if(Auth::check())
          <form class="d-flex grid gap-2" role="search">
            <a href="{{url('/students')}}" class="btn {{ request()->is('students*') ? 'btn-secondary' : 'btn-outline-secondary' }}">Students</a>
            <a href="{{url('/log-out')}}" class="btn btn-danger">Log Out</a>
          </form>
        @else
          <form class="d-flex grid gap-2" role="search">
            <a href="{{url('/login')}}" class="btn {{ request()->is('login*') ? 'btn-success' : 'btn-outline-success' }}">Log In</a>
            <a href="{{route('signup')}}" class="btn {{ request()->is('signUp*') ? 'btn-primary' : 'btn-outline-primary' }}">Sign Up</a>
          </form>
        @endif
      </div>
    </div>
</nav>
