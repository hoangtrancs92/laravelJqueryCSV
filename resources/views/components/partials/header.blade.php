@props(['title' => null])
    <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="padding-top:20px; z-index: 0;">
        <ul class="navbar-nav" style="display:none">
            <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <div style="margin-left: 180px;"></div>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <h5>{{ $title }}</h5>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item" style="padding: 10px;">
                <p>{{session('name')}}</p>
            </li>
            <li class="nav-item  d-sm-inline-block" style="padding: 10px;">
                <a href="{{ route('logout-a01') }}" id="logout-a01">Logout</a>
            </li>
        </ul>
    </nav>
