<div class="mdl-grid">
@foreach ($videos as $video)
	@include('components.videoCard', ['video' => $video['_source'], 'highlighted_search' => $video['highlight']['subtitles'][0]])
@endforeach
</div>