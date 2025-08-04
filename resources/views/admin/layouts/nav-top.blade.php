@if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))
    <nav class="main-header navbar navbar-expand navbar-dark">
@else
    <nav class="main-header navbar navbar-expand navbar-light">
@endif
<!-- Left navbar links -->
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('dashboard') }}" class="nav-link">الرئيسية</a>
    </li>
    <li class="nav-item">
                <a href="{{ route('profile.edit') }}" class="nav-link">
                  <p>ملفي الشخصي  </p>
                </a>
              </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link">
            <p>الموقع </p>
        </a>
    </li>

    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('user'))
        <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('people.index') }}" class="nav-link">
                    <p>الأشخاص</p>
                </a>
            </li>
    @endif

 
   



    <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
            {{ __('تسجيل الخروج') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    </li>
</ul>

<!-- Right navbar links -->
<ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
        </a>
    </li>
</ul>
</nav>