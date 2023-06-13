<li class="nav-item dropdown bottom-transition mt-2">
    <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button"
        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        <i class="fa-solid fa-user-tie"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-end bg-dark" aria-labelledby="navbarDropdown">
        <a class="dropdown-item text-white" href="{{ route('admin.login') }}">
            {{ __('ADMIN') }} </a>
        <a class="dropdown-item text-white" href="{{ route('staff.login') }}">
            {{ __('STAFF') }} </a>
    </div>
</li>
