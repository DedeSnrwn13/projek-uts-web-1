<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('front.index') }}">
                <h2>BlogD<em>.</em></h2>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item @if (Route::currentRouteName() == 'front.index') active @endif">
                        <a class="nav-link" href="{{ route('front.index') }}">{{ __('Home') }}
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item @if (Route::currentRouteName() == 'front.all_post') active @endif">
                        <a class="nav-link" href="{{ route('front.all_post') }}">{{ __('Blog') }}</a>
                    </li>
                    <li class="nav-item @if (Route::currentRouteName() == 'front.contact') active @endif">
                        <a class="nav-link" href="{{ route('front.contact') }}">{{ __('Contact Us') }}</a>
                    </li>
                    @if (!Auth::user())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="switch-language me-5">
            <form method="GET" id="switch_language_form">
                <select class="form-select form-select-sm" name="lang" id="switch_language">
                    <option value="en">EN</option>
                    <option value="id">ID</option>
                </select>
            </form>
        </div>
    </nav>
</header>

@push('js')
    <script>
        if (localStorage.lang == 'id') {
            $('#switch_language').val('id');
        } else {
            $('#switch_language').val('en');
        }

        $('#switch_language').on('change', function (e) {
            e.preventDefault();

            localStorage.lang = $(this).val();
            $('#switch_language_form').submit();
        });
    </script>
@endpush
