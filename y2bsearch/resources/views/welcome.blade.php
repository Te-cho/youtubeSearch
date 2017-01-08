@extends('layouts.master')

@section("content")
<div class="content">
    @include('subviews.searchBar')
	@include('subviews.videos')
</div>
@endsection("content")
