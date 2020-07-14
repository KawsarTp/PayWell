<nav class="navbar navbar-expand-lg navbar-dark bg-info">
  <div class="container">
    <a class="navbar-brand" href="{{route('home')}}">Paywell</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
              <li class="nav-item dropdown">
                <a class="nav-link active dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                  {{auth()->user()->username}}
                </a>
                <div class="dropdown-menu">
                <a class="dropdown-item" href=""></a>
                  <div class="nav-divider"></div> 
                  <a class="dropdown-item" href="{{route('logout')}}">logout</a>
                </div>
              </li>
          </ul>
        </div>
      </div>
      </nav>