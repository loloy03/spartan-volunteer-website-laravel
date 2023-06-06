<li class="nav-item bottom-transition mx-1">
    <a class="nav-link text-light" href="{{ route('event') }}">{{ __('EVENTS') }}</a>
</li>
<li class="nav-item bottom-transition mx-1">
    <a class="nav-link text-light" href="{{ route('staff-volunteers') }}">{{ __('VOLUNTEERS') }}</a>
</li>

<li class="nav-item dropdown bottom-transition">
    <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button"
        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        {{ strtoupper(Auth::guard('staff')->user()->first_name . ' ' . Auth::guard('staff')->user()->last_name) }}

    </a>
    <div class="dropdown-menu dropdown-menu-end bg-dark" aria-labelledby="navbarDropdown">
        @staff
            <a class="dropdown-item text-white" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                {{ __('LOGOUT') }}
            </a>
        @endstaff
        <form id="logout-form" action="/staff-logout" method="POST" class="d-none">
            @csrf
        </form>
    </div>

</li>
