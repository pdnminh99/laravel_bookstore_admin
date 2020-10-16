<nav
    class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white"
    id="sidenav-main"
>
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header align-items-center">
            <a class="navbar-brand" href="javascript:void(0)">
                <img
                    src="{{ asset('img/brand/blue.png')  }}"
                    class="navbar-brand-img"
                    alt="..."
                />
            </a>
        </div>

        <div class="navbar-inner">
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                @isset($navigators)
                    <h6 class="navbar-heading p-0 text-muted">
                        <span class="docs-normal">Main</span>
                    </h6>
                    <ul class="navbar-nav">
                        @each('components.side-nav-btn', $navigators, 'nav')
                    </ul>
                @endisset

                <hr class="my-3"/>
                <!-- Heading -->
                <h6 class="navbar-heading p-0 text-muted">
                    <span class="docs-normal">Documentation</span>
                </h6>

                <ul class="navbar-nav mb-md-3">
                    @each('components.side-nav-btn', $userNavigators, 'nav')
                </ul>
            </div>
        </div>
    </div>
</nav>
