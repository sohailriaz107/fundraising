<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.html">GiveHope</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">

            <ul class="navbar-nav ml-auto">
                @foreach($navs as $nav)
                <li class="nav-item {{ request()->is(ltrim($nav->route, '/')) ? 'active' : '' }}">
                    <a href="{{ url($nav->route) }}" class="nav-link">
                        {{ ucfirst($nav->nav) }}
                    </a>
                </li>
                @endforeach
            </ul>

        </div>

    </div>
</nav>