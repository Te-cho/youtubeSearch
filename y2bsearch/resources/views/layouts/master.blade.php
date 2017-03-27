<!DOCTYPE html>
<html lang="en">
<head>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-2113342998549991",
            enable_page_level_ads: true
        });
    </script>
    @include('scripts.metadata')
    {{--<link defer href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">--}}
    <link defer rel="stylesheet" href="{{asset('css/app.css')}}"/>
    <link defer rel="stylesheet" href="https://semantic-ui.com/dist/semantic.min.css"/>
    <script defer
    src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>
    <script defer src="https://semantic-ui.com/dist/semantic.min.js"></script>
    {{--<link defer rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cssgram/0.1.10/cssgram.min.css">--}}
    <script defer src="{{asset('js/app.js')}}"></script>
</head>
<body>
@include('scripts.ga')

@yield("content")

@include('subviews.footer')

@include('components.video-modal')

</body>
</html>
