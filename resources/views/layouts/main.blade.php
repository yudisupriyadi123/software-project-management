<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />

    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">

    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">

    {{-- <link rel="icon" href="{{ site.base}}/favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="{{ site.base}}/favicon.ico" /> --}}

    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ public_path('css/font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="{{ public_path('js/require.min.js') }}"></script>
    <script>
        requirejs.config({
            baseUrl: @{{ base_path() }}
        });
    </script>

    <!-- Dashboard Core -->
    <link href="{{ public_path('css/dashboard.css') }}" rel="stylesheet" />
    <script src="{{ public_path('js/dashboard.js') }}"></script>

    {{-- {% for plugin in site.theme-plugins %}
    <!-- {{ plugin[1].name }} Plugin -->
    {% if plugin[1].files contains 'css' %}<link href="{{ site.base }}/assets/plugins/{{ plugin[0] }}/plugin.css" rel="stylesheet" />{% endif %}
    {% if plugin[1].files contains 'js' %}<script src="{{ site.base }}/assets/plugins/{{ plugin[0] }}/plugin.js"></script>{% endif %}
    {% endfor %} --}}

    <!-- Maintenance page only-->
    {{-- <script src="{{ site.base }}/assets/js/vendors/jquery-3.2.1.min.js"></script>
    <script src="{{ site.base }}/assets/js/vendors/jquery.nestable.js"></script> --}}
</head>
<body>
    @stack('scripts')
    @stack('styles')

    <div class="page">
        <div class="page-main">
            {% include header.html %}

            <div class="my-3 my-md-5">
                @if(View::hasSection('page_title'))
                <div class="container">
                    <div class="page-header">
                        <h1 class="page-title">{{ @yield('page_title') }}</h1>
                    </div>
                </div>
                @endif

                {{ content }}
            </div>
        </div>
    </div>

</body>
</html>
