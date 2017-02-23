<div class="column">
    <center>
        {{--<a href="{{ $video['video_url'] }}">--}}
        {{--</a>--}}
        <div class="ui video-card card">
            <div class="content">
                {{ $video['video_title'] }}
            </div>
            <a target="_blank" href="{{ $video['video_url'] }}" class="image gingham">
                <img src="{{$video['image_medium']}}">
            </a>
            <div class="content">
                {{--<div class="header">Matt Giampietro</div>--}}
                <div class="description">
                    " {!! $highlighted_search !!} "
                </div>
            </div>
            <div class="extra content">
              <span class="right floated">
                <i class="like icon"></i>
                <i class="share alternate icon"></i>
              </span>
            </div>
        </div>
    </center>
</div>
