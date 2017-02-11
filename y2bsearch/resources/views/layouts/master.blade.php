<!DOCTYPE html>
<html lang="en">
<head>
    @include('scripts.metadata')
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.blue-red.min.css"/>
    <script defer src="https://code.getmdl.io/1.2.1/material.min.js"></script>

    <!-- Square card -->
    <style>
        .demo-card-square.mdl-card {
            /*width: 320px;*/
            height: 320px;
        }

        .demo-card-square > .mdl-card__title {
            background-size: cover;
            color: #fff;
        }

        .blur-for-txt {
            height: 62%;
            left: 0px;
            content: "";
            position: absolute;
            width: 100%;
            background: linear-gradient(to bottom, rgba(100, 100, 100, 0), rgba(0, 0, 0, 0.5));
            z-index: 0;
        }

        .mdl-card__title-text {
            z-index: 1;
        }
    </style>

    <!-- Main style -->
    <style>
        .demo-main {
            margin-top: -17vh;
            -webkit-flex-shrink: 0;
            -ms-flex-negative: 0;
            flex-shrink: 0;
        }
    </style>
    <style type="text/css">
        .demo-ribbon-primary {
            width: 100%;
            height: 15vh;
            background-color: rgb(33, 150, 243);
            -webkit-flex-shrink: 0;
            -ms-flex-negative: 0;
            flex-shrink: 0;
        }

        .demo-ribbon-secondary {
            width: 100%;
            height: 20vh;
            background-color: rgba(33, 150, 243, 0.7);
            -webkit-flex-shrink: 0;
            -ms-flex-negative: 0;
            flex-shrink: 0;
        }

        .search {
            color: rgba(0, 0, 0, 0.71);
            font-family: helvetica;
            flex: 1 1 auto;
            order: 2;
            outline: none;
            border: none;
            border-radius: 0;
            background: #fff;
            padding: 10px;
            margin: 1vh;
            font-family: 'Roboto', sans-serif;
            height: 8vh;
            transition: all 0.05s ease-in-out;
            -webkit-appearance: none;
            width: 30vw;
            margin: 3vh;
            font-size: 2vh;
        }

        .search:focus {
            margin-left: -15px;
            padding: 10px 15px;
            width: 80vw;
            margin: 1vh;
            height: 13vh;
            font-size: 6vh;
        }
    </style>
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
