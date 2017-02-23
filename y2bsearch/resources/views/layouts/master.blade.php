<!DOCTYPE html>
<html lang="en">
<head>
    @include('scripts.metadata')
    {{--<link defer href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">--}}
    <link defer rel="stylesheet" href="{{asset('css/app.css')}}"/>
    <link defer rel="stylesheet" href="http://semantic-ui.com/dist/semantic.min.css"/>
    {{--<script defer--}}
    {{--src="https://code.jquery.com/jquery-3.1.1.min.js"--}}
    {{--integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="--}}
    {{--crossorigin="anonymous"></script>--}}
    {{--<script defer src="http://semantic-ui.com/dist/semantic.min.js"></script>--}}
    {{--<link defer rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cssgram/0.1.10/cssgram.min.css">--}}
</head>
<body>
@include('scripts.ga')
@include('subviews.header')
<div id="content">
    @yield("content")
</div>
@include('subviews.footer')
</body>
</html>
