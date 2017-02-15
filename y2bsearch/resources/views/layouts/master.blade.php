<!DOCTYPE html>
<html lang="en">
<head>
    @include('scripts.metadata')
    <link defer href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link defer rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link defer rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.blue-red.min.css"/>
    <link defer rel="stylesheet" href="{{asset('css/app.css')}}"/>
    <script defer src="https://code.getmdl.io/1.2.1/material.min.js"></script>

</head>
<body>
@include('scripts.ga')
<div class="mdl-layout mdl-layout--fixed-header mdl-js-layout mdl-color--grey-100">
    @include("subviews.topBar")
    <div class="content demo-main">
        @yield("content")
    </div>
</div>
</body>
</html>
