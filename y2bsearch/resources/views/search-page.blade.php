@extends('layouts.master')

@section("content")
    @include('subviews.header', ['showSearch'=> true])
    <div id="content">
        <div>our library growing, so keep using to expand it</div>
        @include('subviews.videos')
    </div>
@endsection("content")
