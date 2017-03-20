<div id="videos" class="ui link cards three column stackable grid container">
    @foreach ($videos as $video)
        @include('components.videoCard', ['video' => $video['_source'],
        'highlighted_search' => $video['inner_hits']['subtitles']['hits']['hits'][0]['highlight']['subtitles.sentence'][0],
        'start' => $video['inner_hits']['subtitles']['hits']['hits'][0]['_source']['start']
        ])
    @endforeach
</div>
