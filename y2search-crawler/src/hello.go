package main

import (
	"fmt"
	"log"
	"flag"
	"net/http"
	"google.golang.org/api/googleapi/transport"
	"google.golang.org/api/youtube/v3"
)
import "database/sql"
import _ "github.com/go-sql-driver/mysql"
import "os/exec"
import "io/ioutil"


var (
        query      = flag.String("query", "iprice Mannequinchallenge", "")
        listingVideos = flag.String("chart", "mostPopular", "")
        maxResults = flag.Int64("max-results", 50, "Max YouTube results")
        db sql.DB
        debugOutput = false
        number = 0
)
// var db sql.DB
const developerKey = "AIzaSyCq6GaikitWw3X3xMduprZB_soUZqvg9_c"

//////////////////
//START OF Miscilanious 
func handleError(err error){
    if err != nil {
        panic(err.Error()) // Just for example purpose. You should use proper error handling instead of panic
    }
}
//END OF Miscilanious 
//////////////////

//////////////////
//START OF YOUTUBE

type YTVideo struct {
    id string
    title  string
    description string
    thumbnailDefault string
    thumbnailMedium string
    thumbnailHigh string
    publishedAt string
    duration string
}
func (video YTVideo) convertSearchResult(searchResult *youtube.SearchResult) YTVideo {
    video.id = searchResult.Id.VideoId
    video.title  = searchResult.Snippet.Title
    video.description = searchResult.Snippet.Description
    // video.thumbnailDefault = searchResult.Snippet.Thumbnails.default.url
    // video.thumbnailMedium = searchResult.Snippet.Thumbnails.medium.url
    // video.thumbnailHigh = searchResult.Snippet.Thumbnails.high.url
    video.publishedAt = searchResult.Snippet.PublishedAt
    return video
}
func (video YTVideo) convertVideoResult(videoResult *youtube.Video) YTVideo {
    video.id = videoResult.Id
    video.title  = videoResult.Snippet.Title
    video.description = videoResult.Snippet.Description
    // video.thumbnailDefault = videoResult.Snippet.Thumbnails.default.url
    // video.thumbnailMedium = videoResult.Snippet.Thumbnails.medium.url
    // video.thumbnailHigh = videoResult.Snippet.Thumbnails.high.url
    video.publishedAt = videoResult.Snippet.PublishedAt
    video.duration = videoResult.ContentDetails.Duration
    return video
}

func listTrending(c chan YTVideo, tPoolNum chan int) {
        flag.Parse()

        client := &http.Client{
                Transport: &transport.APIKey{Key: developerKey},
        }

        service, err := youtube.New(client)
        if err != nil {
                log.Fatalf("Error creating new YouTube client: %v", err)
        }

        // Make the API call to YouTube.
        call := service.Videos.List("id,snippet,contentDetails").
                Chart("mostPopular").
                MaxResults(*maxResults)

        response, err := call.Do()
        if err != nil {
                log.Fatalf("Error making search API call: %v", err)
        }

        // Iterate through each item and add it to the correct list.
        for _, item := range response.Items {
        		// fmt.Printf(".")
                videoObj := YTVideo{}.convertVideoResult(item)
                c <- videoObj
        }
}
//Bring suggestions for the videos Id passed
func getVideoSuggestions(videoId string, videoChan chan YTVideo, pageToken string, tPoolNum chan int) {//([]*youtube.Video){
        flag.Parse()

        client := &http.Client{
                Transport: &transport.APIKey{Key: developerKey},
        }

        service, err := youtube.New(client)
        if err != nil {
                log.Fatalf("Error creating new YouTube client: %v", err)
        }

        // Make the API call to YouTube.
        call := service.Search.List("id,snippet").
                MaxResults(*maxResults).
                Type("video").
                RelatedToVideoId(videoId).
                PageToken(pageToken)

        response, err := call.Do()
        if err != nil {
                log.Fatalf("Error making search API call: %v", err)
        }
        
        // Group video, channel, and playlist results in separate lists.
        //can use type youtube.Video later
        videos := make(map[string]YTVideo)


        // // Iterate through each item and add it to the correct list.
        for _, item := range response.Items {
                videoObj := YTVideo{}.convertSearchResult(item)
                videos[item.Id.VideoId] = videoObj
                go videosHandler(videoChan, tPoolNum)
                videoChan <- videoObj
        }


        //fetch the rest of th videos if we still have
        if len(response.NextPageToken) > 0 {
            getVideoSuggestions(videoId, videoChan, response.NextPageToken, tPoolNum)
        }
}
//END OF YOUTUBE
//////////////////

// SRT Downloader
func downloadVideo(id string) {
	filename := "\"srts/" + id + ".srt\""
    commandParams := " --write-auto-sub --skip-download \"https://www.youtube.com/watch?v=" + id + "\" -o " + filename
    commandName := "youtube-dl"
    command := commandName + " " + commandParams
    cmd := exec.Command("sh","-c", command)
	err := cmd.Run() // waits until the commands runs and finishes
    if err != nil {
		log.Printf("%v",err)
	}
	if debugOutput {log.Printf("command : %v", command)}
    fmt.Println(".");
}

//Printers
func videosHandler(videoChan chan YTVideo, tPoolNum chan int) {
    video := <- videoChan
    <- tPoolNum // get a turn in the pool
    defer consumeThread(tPoolNum) // to give turn to other threads
    if debugOutput {fmt.Println(video.id)}
    downloadVideo(video.id)
    StoreValue(video)
    getVideoSuggestions(video.id, videoChan, "12", tPoolNum)// 12 is a random token that works as initial value
}

// START OF MYSQL
//////////////////

// Initialize Mysql Connection
func initializeMysqlConn(){
    dbConn, err := sql.Open("mysql", "admin:admin@tcp(y2search_mysql:3306)/y2search_db")
    db = *dbConn
    if err != nil {
        panic(err.Error()) // Just for example purpose. You should use proper error handling instead of panic
    }   

    // Open doesn't open a connection. Validate DSN data:
    err = db.Ping()
    if err != nil {
        panic(err.Error()) // proper error handling instead of panic in your app
    }
}

// destruct Mysql Connection
func tearDownMysqlConn(){
    db.Close()
}

// store values in mysql connection
func StoreValue(ytVideo YTVideo) {
	// Prepare statement for inserting data
    // INSERTING VIDEO
    // Prepairing 
    videoInsertQuery := "INSERT INTO videos (`id`, `video_id`,`video_url`,`video_title`) VALUES (NULL, ?, ?, ?)"
    stmtVidIns, err := db.Prepare(videoInsertQuery) // ? = placeholder
    handleError(err)
    defer stmtVidIns.Close() // Close the statement when we leave main() / the program terminates
    result, err := stmtVidIns.Exec(ytVideo.id, `url`, ytVideo.title)// Inserting    
    handleError(err)
    lastInsertedId, _ := result.LastInsertId()

    // Read subtitles file
    file, err := ioutil.ReadFile("srts/" + ytVideo.id + ".en.vtt")// it will be save with this extension regardless
    if debugOutput {fmt.Println(err)}
    if err == nil {
        // INSERTING VIDEO's Subtitles
        // Prepairing 
        stmtVidSubIns, err := db.Prepare("INSERT INTO videos_subtitles (`id`, `video_id`,`subtitles`,`language`) VALUES (NULL, ?, ?, ?)") // ? = placeholder
        handleError(err)
        defer stmtVidSubIns.Close() // Close the statement when we leave main() / the program terminates
        // Inserting
        _, err = stmtVidSubIns.Exec(lastInsertedId,file,`en`) // Insert tuples
        handleError(err)

        // INSERTING VIDEO's Meta
        // Prepairing 
        stmtVidMetaIns, err := db.Prepare("INSERT INTO videos_meta (`id`, `video_id`) VALUES (NULL, ?)") // ? = placeholder
        handleError(err)
        defer stmtVidMetaIns.Close() // Close the statement when we leave main() / the program terminates
        // Inserting
        _, err = stmtVidMetaIns.Exec(lastInsertedId) // Insert tuples
        handleError(err)
    }
}

//////////////////
// END OF MYSQL

func threadsPoolManager(tPoolNum chan int) {
    // So that we run only 10 at a time
    for counter := 0; counter<10;counter++ {
        tPoolNum <- counter
    }
}

// After each thread consume it self, it will call this so it can give one call to another thread.
func consumeThread(tPoolNum chan int){
    tPoolNum <- 1 
}

////////////////////////////////////
////////////////////////////////////
// MAIN APPLICATION START POINT

func main() {
    //mysql connection
    initializeMysqlConn()
	var c chan YTVideo = make(chan YTVideo)
    var tPoolNum chan int = make(chan int)
	go listTrending(c,tPoolNum)
    go threadsPoolManager(tPoolNum)
	
	for i := 0; i<50; i++ {
		go videosHandler(c, tPoolNum)
	}

  var input string
  fmt.Scanln(&input)
  defer tearDownMysqlConn()
}
// MAIN APPLICATION END POINT
////////////////////////////////////
////////////////////////////////////