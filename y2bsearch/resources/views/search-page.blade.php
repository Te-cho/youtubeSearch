@extends('layouts.master')

@section("content")
    @include('subviews.header', ['showSearch'=> true])
    <div id="content">
        @include('subviews.videos')
    </div>
@endsection("content")
