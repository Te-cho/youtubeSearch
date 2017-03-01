@extends('layouts.master')

@section("content")

    @include('subviews.header', ['showSearch'=> false])
    <div id="content">
        <div id="mainPage">
            <div class="ui container">
                @include('components.infographics')
                @include('subviews.searchBar')
                <h4 class="ui horizontal header divider">
                    <a href="#">Hot Search</a>
                </h4>
            </div>

            @include('subviews.videos')
        </div>
    </div>

@endsection("content")
