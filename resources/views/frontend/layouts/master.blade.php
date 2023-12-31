<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.includes.head')
</head>

<body>
    <!-- ***** Preloader Start ***** -->
    @include('frontend.includes.preloader')
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    @include('frontend.includes.nav')

    <!-- Page Content -->
    <!-- Banner Starts Here -->
    @yield('banner')
    <!-- Banner Ends Here -->

    <section class="blog-posts">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="all-blog-posts">
                        <div class="row">
                            @yield('content')
                        </div>
                    </div>
                </div>
                @include('frontend.includes.sidebar')
            </div>
        </div>
    </section>


    <!-- Footer -->
    @include('frontend.includes.footer')

    <!-- Scripts-->
    @include('frontend.includes.scripts')
</body>

</html>
