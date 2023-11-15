<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ route('back.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Master</div>
                <!-- Category -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCategory"
                    aria-expanded="false" aria-controls="collapseCategory">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Category
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseCategory" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('category.index') }}">List</a>
                        <a class="nav-link" href="{{ route('category.create') }}">Create</a>
                    </nav>
                </div>

                <!-- Sub Category -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSubCategory"
                    aria-expanded="false" aria-controls="collapseSubCategory">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Sub Category
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseSubCategory" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('sub-category.index') }}">List</a>
                        <a class="nav-link" href="{{ route('sub-category.create') }}">Create</a>
                    </nav>
                </div>

                <!-- Tag -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTag"
                    aria-expanded="false" aria-controls="collapseTag">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Tag
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseTag" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('tag.index') }}">List</a>
                        <a class="nav-link" href="{{ route('tag.create') }}">Create</a>
                    </nav>
                </div>

                <!-- Tag -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePost"
                    aria-expanded="false" aria-controls="collapsePost">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Post
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePost" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('post.index') }}">List</a>
                        <a class="nav-link" href="{{ route('post.create') }}">Create</a>
                    </nav>
                </div>

                <div class="sb-sidenav-menu-heading">Addons</div>
                <a class="nav-link" href="charts.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Charts
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>
