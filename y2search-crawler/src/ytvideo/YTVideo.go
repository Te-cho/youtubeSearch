package ytvideo

import "google.golang.org/api/youtube/v3"
//////////////////
//START OF YOUTUBE

type YTVideo struct {
    Id string
    Url string
    Title  string
    Description string
    ThumbnailDefault string
    ThumbnailMedium string
    ThumbnailHigh string
    PublishedAt string
    Duration string
}
func (video YTVideo) ConvertSearchResult(searchResult *youtube.SearchResult) YTVideo {
    video.Id = searchResult.Id.VideoId
    video.Url  = "https://www.youtube.com/watch?v=" + video.Id
    video.Title  = searchResult.Snippet.Title
    video.Description = searchResult.Snippet.Description
    video.ThumbnailDefault = searchResult.Snippet.Thumbnails.Default.Url
    video.ThumbnailMedium = searchResult.Snippet.Thumbnails.Medium.Url
    video.ThumbnailHigh = searchResult.Snippet.Thumbnails.High.Url
    video.PublishedAt = searchResult.Snippet.PublishedAt
    return video
}
func (video YTVideo) ConvertVideoResult(videoResult *youtube.Video) YTVideo {
    video.Id = videoResult.Id
    video.Url  = "https://www.youtube.com/watch?v=" + video.Id
    video.Title  = videoResult.Snippet.Title
    video.Description = videoResult.Snippet.Description
    video.ThumbnailDefault = videoResult.Snippet.Thumbnails.Default.Url
    video.ThumbnailMedium = videoResult.Snippet.Thumbnails.Medium.Url
    video.ThumbnailHigh = videoResult.Snippet.Thumbnails.High.Url
    video.PublishedAt = videoResult.Snippet.PublishedAt
    video.Duration = videoResult.ContentDetails.Duration
    return video
}

//END OF YOUTUBE
//////////////////
