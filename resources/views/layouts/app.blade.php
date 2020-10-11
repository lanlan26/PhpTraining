<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>ZENI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <link rel="stylesheet" href="{{ asset('css/style.css')}}" media="all" />
    <link rel="stylesheet" href="{{ asset('css/jquery.tweet.css')}}" media="all"  />
    <link rel="stylesheet" href="{{ asset('css/superfish.css')}}" media="screen" />
    <link rel="stylesheet" href="{{ asset('css/flexslider.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/lessframework.css')}}" media="all" />
    <link rel="stylesheet" href="{{ asset('css/widgets.css')}}" media="all" />
    <link rel="stylesheet" href="{{ asset('css/social.css')}}" media="all" />
    <link rel="stylesheet" href="{{ asset('css/skin.css')}}" media="all" />
    <link rel="stylesheet" href="{{ asset('css/reset.css')}}" media="all" />
    <link rel="stylesheet" href="{{ asset('css/prettyPhoto.css')}}"  media="screen" />
    <link rel="stylesheet" href="{{ asset('css/tip-twitter.css')}}"  />
    <link rel="stylesheet" href="{{ asset('css/tip-yellowsimple.css')}}"/>
</head>
<body>
    <div id="header">
        @include('layouts.header')
    </div>

    <div id="main">
        <div class="wrapper">
        @include('layouts.slider')
        @yield('slider')
            <div id= "content">
                @yield('content')
            </div>
        </div>
    </div>

    <div id="footer">
        @include('layouts.footer')
    </div>

    <script src="{{ asset('js/app.js') }}" ></script>
    @yield('scripts')
</body>
</html>
