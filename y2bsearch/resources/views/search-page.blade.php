@extends('layouts.master')

@section("content")
    @include('subviews.header', ['showSearch'=> true])
    <div id="content">
        <div style="text-align: center;margin-bottom: 20px;">our library growing, so keep using to expand it</div>
        @include('subviews.videos')
    </div>
@endsection("content")
