<div class="demo-card-square mdl-card mdl-shadow--2dp mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--4-col-phone">
  <div class="mdl-card__title mdl-card--expand">
    <h2 class="mdl-card__title-text">{{ $video['video_title'] }}</h2>
  </div>
  {{-- image API --}}
  {{-- https://img.youtube.com/vi/video_id/hqdefault.jpg --}}
  <div class="mdl-card__supporting-text">
    ... {{ $highlighted_search }} ...
  </div>
  <div class="mdl-card__actions mdl-card--border">
    <a class="mdl-button mdl-button--colored mdl-js-button mdl-button--fab mdl-js-ripple-effect" 
        href="{{ $video['video_url'] }}" target="_blank">
      <i class="material-icons">play_arrow</i>
    </a>
  </div>
</div>
