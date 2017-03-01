@extends('layouts.master')

@section("content")

    @include('subviews.header', ['showSearch'=> false])
    <div id="content">
        <div id="mainPage">
            <div class="ui container infographics">
                <div id="videos" class="ui three column stackable grid container">
                    <div href="/" class="column">
                        <center>
                            <img class="logo" src="{{asset('images/infographic1.png')}}">
                        </center>
                    </div>
                    <div href="/" class="column">
                        <center>
                            <img class="logo" src="{{asset('images/infographic2.png')}}">
                        </center>
                    </div>
                    <div href="/" class="column">
                        <center>
                            <img class="logo" src="{{asset('images/infographic3.png')}}">
                        </center>
                    </div>
                </div>
                <br><br>
                @include('subviews.searchBar')
            </div>
            <h4 class="ui horizontal header divider">
                <a href="#">Hot Search</a>
            </h4>
        </div>
        <br><br>
        @include('subviews.videos')
    </div>

@endsection("content")
