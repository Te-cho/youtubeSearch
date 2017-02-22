<div class="column">
    <center>
        {{--<a href="{{ $video['video_url'] }}">--}}
        {{--</a>--}}
        <div class="ui video-card card">
            <div class="content">
                {{ $video['video_title'] }}
            </div>
            <div class="image gingham">
                <img src="{{$video['image_medium']}}">
            </div>
            <div class="content">
                {{--<div class="header">Matt Giampietro</div>--}}
                <div class="description">
                    " {!! $highlighted_search !!} "
                </div>
            </div>
            <div class="extra content">
          <span class="right floated">
            <i class="like icon"></i>
            <i class="share icon"></i>
          </span>
            </div>
        </div>
    </center>
</div>
