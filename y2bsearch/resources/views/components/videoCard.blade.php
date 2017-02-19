<div class="video-card">
    {{--<a href="{{ $video['video_url'] }}">--}}
    {{--</a>--}}
    {{--title--}}
    <div class="title">
        {{ $video['video_title'] }}
    </div>
    {{--image--}}
    <figure class="image gingham">
        <img src="{{$video['image_medium']}}">
    </figure>

    <div class="text">
        {{--desc--}}
        {{--<div class="desc">--}}
            {{--desc--}}
        {{--</div>--}}
        {{--spots--}}
        <div class="spots">
            " {!! $highlighted_search !!} "
        </div>
    </div>

    {{--like&share--}}
    <div class="like-share">
        <span class="like"></span>
        <span class="share"></span>
    </div>
</div>
