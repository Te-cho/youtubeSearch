<div id="videos" class="ui link cards three column stackable grid container">
    @foreach ($videos as $video)
        @include('components.videoCard', ['video' => $video['_source'], 'highlighted_search' => $video['highlight']['subtitles'][0]])
    @endforeach
</div>
