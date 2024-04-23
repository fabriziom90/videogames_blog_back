<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block navbar-dark sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            @role('admin')
                <li class="nav-item">
                    <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-green-active' : '' }}"
                        href="{{ route('admin.dashboard') }}">
                        <i class="fa-solid fa-tachometer-alt fa-lg fa-fw"></i> Dashboard
                    </a>
                </li>
            @endrole
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.posts.index' ? 'bg-green-active' : '' }}"
                    href="{{ route('admin.posts.index', ['show_type' => 0]) }}">
                    <i class="fa-solid fa-newspaper fa-lg fa-fw"></i> Videogames
                </a>
            </li>
            @role('admin')
                <li class="nav-item">
                    <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.categories.index' ? 'bg-green-active' : '' }}"
                        href="{{ route('admin.categories.index') }}">
                        <i class="fa-solid fa-folder fa-lg fa-fw"></i> Categorie
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.tags.index' ? 'bg-green-active' : '' }}"
                        href="{{ route('admin.tags.index') }}">
                        <i class="fa-solid fa-tag fa-lg fa-fw"></i> Tags
                    </a>
                </li>
            @endrole
        </ul>

    </div>
</nav>
