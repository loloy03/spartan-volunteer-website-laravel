<li class="nav-item bottom-transition mx-1">
    <a class="nav-link text-light" href="{{ route('event') }}">{{ __('EVENTS') }}</a>
</li>
<li class="nav-item bottom-transition mx-1">
    <a class="nav-link text-light" href="{{ route('create-event') }}">{{ __('CREATE EVENT') }}</a>
</li>
<li class="nav-item bottom-transition mx-1">
    <a class="nav-link text-light" href="{{ route('admin-volunteers') }}">{{ __('VOLUNTEERS') }}</a>
</li>


<li class="nav-item dropdown bottom-transition">
    <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button"
        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        {{ strtoupper(Auth::guard('admin')->user()->first_name . ' ' . Auth::guard('admin')->user()->last_name) }}

    </a>
    <div class="dropdown-menu dropdown-menu-end bg-dark" aria-labelledby="navbarDropdown">
        @admin
            <a class="dropdown-item text-white" href="{{ route('admin.signup') }}">
                {{-- {{ __('MAKE ADMIN') }} </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-white" href="{{ route('staff.signup') }}">
                {{ __('MAKE STAFF') }} </a>
            <div class="dropdown-divider"></div> --}}
            <a class="dropdown-item text-white" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                {{ __('LOGOUT') }}
            </a>
        @endadmin
        <form id="logout-form" action="/admin-logout" method="POST" class="d-none">
            @csrf
        </form>
    </div>

</li>
