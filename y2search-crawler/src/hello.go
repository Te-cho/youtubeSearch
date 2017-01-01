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
func listTrending(c chan *youtube.Video) {
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

        // Group video, channel, and playlist results in separate lists.
        //can use type youtube.Video later
        videos := make(map[string]*youtube.Video)

        // Iterate through each item and add it to the correct list.
        for _, item := range response.Items {
        		fmt.Printf(".")
                videos[item.Id] = item
                c <- item
        }
        
        // printIDs("Videos", videos)
}
//Bring suggestions for the videos Id passed
func getVideoSuggestions(videoId string) {//([]*youtube.Video){

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
	log.Printf("command : %v", command)
}

//Printers
func videosHandler(videoChan chan *youtube.Video) {
    video := <- videoChan
    fmt.Println(video.Id)
    downloadVideo(video.Id)
    StoreValue(video.Id)
    getVideoSuggestions(video.Id)
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
func StoreValue(videoId string) {
	// Prepare statement for inserting data
    // INSERTING VIDEO
    // Prepairing 
    videoInsertQuery := "INSERT INTO videos (`id`, `video_id`,`video_url`,`video_title`) VALUES (NULL, ?, ?, ?)"
    stmtVidIns, err := db.Prepare(videoInsertQuery) // ? = placeholder
    handleError(err)
    defer stmtVidIns.Close() // Close the statement when we leave main() / the program terminates
    result, err := stmtVidIns.Exec(videoId, `url`, `title`)// Inserting    
    handleError(err)
    lastInsertedId, _ := result.LastInsertId()
    fmt.Println(lastInsertedId)

    // Read subtitles file
    file, err := ioutil.ReadFile("srts/" + videoId + ".en.vtt")// it will be save with this extension regardless
    fmt.Println(err)
    if err == nil {
        // INSERTING VIDEO's Subtitles
        // Prepairing 
        stmtVidSubIns, err := db.Prepare("INSERT INTO videos_subtitles (`id`, `video_id`,`subtitles`,`language`) VALUES (NULL, ?, ?, ?)") // ? = placeholder
        handleError(err)
        defer stmtVidSubIns.Close() // Close the statement when we leave main() / the program terminates
        // Inserting
        _, err = stmtVidSubIns.Exec(lastInsertedId,file,`en`) // Insert tuples
        handleError(err)
    }
}

//////////////////
// END OF MYSQL


////////////////////////////////////
////////////////////////////////////
// MAIN APPLICATION START POINT

func main() {
    //mysql connection
    initializeMysqlConn()
	var c chan *youtube.Video = make(chan *youtube.Video)
	go listTrending(c)
	
	for i := 0; i<50; i++ {
		go videosHandler(c)
	}

  var input string
  fmt.Scanln(&input)
  defer tearDownMysqlConn()
}
// MAIN APPLICATION END POINT
////////////////////////////////////
////////////////////////////////////