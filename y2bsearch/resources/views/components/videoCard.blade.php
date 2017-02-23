<div class="column">
    <center>
        <div class="ui video-card card">
            <div class="content">
                {{ $video['video_title'] }}
            </div>
            <a target="_blank" href="{{ $video['video_url'] }}" class="image .valencia .lark">
                <img src="{{$video['image_medium']}}">
            </a>
            <div class="content">
                <div class="description">
                    " {!! $highlighted_search !!} "
                </div>
            </div>
            <div class="extra content">
              <span class="right floated">
                <i class="like icon"></i>
                  {{--<i class="share alternate icon"></i>--}}
                  <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($video['video_url']) }}" target="_blank"><i
                              class="facebook f icon"></i></a>
                  <a href="https://twitter.com/home?status=check%20this%20out%20:%20{{ urlencode($video['video_url']) }}"
                     target="_blank"><i class="twitter icon"></i></a>
                  <a href="https://plus.google.com/share?url={{ urlencode($video['video_url']) }}" target="_blank"><i class="google plus icon"></i></a>
              </span>
            </div>
        </div>
    </center>
</div>
