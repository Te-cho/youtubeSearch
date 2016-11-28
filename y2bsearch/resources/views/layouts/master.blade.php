<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Youtube Search</title>
        @include('mainComponents.metas')
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.blue-red.min.css" />
        <script defer src="https://code.getmdl.io/1.2.1/material.min.js"></script>

        <!-- Square card -->
        <style>
        .demo-card-square.mdl-card {
          /*width: 320px;*/
          height: 320px;
        }
        .demo-card-square > .mdl-card__title {
          color: #fff;
          background:
            url('../assets/demos/dog.png') bottom right 15% no-repeat rgb(33,150,243);
        }
        </style>

        <!-- Main style -->
        <style>
            .demo-main {
                margin-top: -25vh;
                -webkit-flex-shrink: 0;
                -ms-flex-negative: 0;
                flex-shrink: 0;
            }
        </style>
        <style type="text/css">
          .demo-ribbon {
            width: 100%;
            height: 30vh;
            background-color: rgb(33,150,243);
            -webkit-flex-shrink: 0;
            -ms-flex-negative: 0;
            flex-shrink: 0;
          }
        </style>
    </head>
    <body>
         <div class="mdl-layout mdl-layout--fixed-header mdl-js-layout mdl-color--grey-100">
            @include("subviews.topBar")
            <div class="content demo-main">
                @yield("content")
            </div>
        </div>
    </body>
</html>
