@include('partials._alert')

<form action="{{route('auth.logout')}}" method="POST" id="logout-form">
    @csrf
    @method('DELETE')
</form>

<nav class="navbar is-primary" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="{{config('app.url')}}">
            <h3 class="text-xl">{{config('app.name')}}</h3>
        </a>

        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"
           data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="/">
                Home
            </a>
        </div>

        <div class="navbar-end">

            @guest
                <div class="navbar-item">
                    <div class="buttons">
                        <a class="button is-light" href="{{route('auth.login')}}">
                            Log in
                        </a>
                    </div>
                </div>
            @endguest

            @auth
                <div class="navbar-item has-dropdown is-hoverable">
                    <div class="navbar-link">{{ auth()->user()->me->json('name')  }}</div>
                    <div class="navbar-dropdown">
                        <a class="navbar-item" href="http://dokan-auth.test/dashboard/profile">{{__('Profile')}}</a>
                        <a class="navbar-item"
                           href="http://dokan-auth.test/dashboard/password">{{__('Change Password')}}</a>
                        <a class="navbar-item" href="javascript:voud(0)"
                           onclick="confirm('Sure to logout?') && document.getElementById('logout-form').submit()">{{__('Logout')}}</a>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</nav>
