package main

import (
	"fmt"
	"log"
	"flag"
	"strconv"
	"time"
	"net/http"
	"google.golang.org/api/googleapi/transport"
	"google.golang.org/api/youtube/v3"
)
import "database/sql"
import _ "github.com/go-sql-driver/mysql"
import "io/ioutil"
import "os"
import "github.com/youtube-videos/go-youtube-dl"
import "app/ytvideo"

var (
	query = flag.String("query", "iprice Mannequinchallenge", "")
	listingVideos = flag.String("chart", "mostPopular", "")
	maxResults = flag.Int64("max-results", 50, "Max YouTube results")
	db sql.DB
	debugOutput = true
	number = 0
)
// var db sql.DB
const developerKey = "AIzaSyCq6GaikitWw3X3xMduprZB_soUZqvg9_c"

//////////////////
//START OF Miscilanious 
func handleError(err error) {
	if err != nil {
		log.Println(err.Error()) // Just for example purpose. You should use proper error handling instead of panic
	}
}
//END OF Miscilanious 
//////////////////

//////////////////
//START OF YOUTUBE
func listVideosWithNoSubtitles(c chan ytvideo.YTVideo, tPoolNum chan int) {

	rows, err := db.Query("SELECT video_hash_id, id FROM videos v where id not in (SELECT v.id FROM videos v, videos_subtitles vs where v.id = vs.video_id)")
	handleError(err)
	defer rows.Close() // Close the statement when we leave main() / the program terminates
	// Inserting
	for rows.Next() {
		var (
			videoHashId string
			videoId string
		)
		if err := rows.Scan(&videoHashId, &videoId); err != nil {
			handleError(err)
		}
		vid := ytvideo.YTVideo{}
		vid.Id = videoHashId
		vid.Url  = "https://www.youtube.com/watch?v=" + vid.Id
		vid.Title  = videoId
		vid.Description = ""
		vid.ThumbnailDefault = "https://i.ytimg.com/vi/"+vid.Id+"/mqdefault.jpg"
		vid.ThumbnailMedium = "https://i.ytimg.com/vi/"+vid.Id+"/default.jpg"
		vid.ThumbnailHigh = "https://i.ytimg.com/vi/"+vid.Id+"/hqdefault.jpg"
		vid.PublishedAt = ""
		c <- vid

		//c <- videoObj
		log.Println("processing video %v \n", videoId)

	}
	if err := rows.Err(); err != nil {
		log.Fatal(err)
	}
}

//END OF YOUTUBE
//////////////////

//Printers
func videosHandler(videoChan chan ytvideo.YTVideo, tPoolNum chan int) {
	video := <-videoChan
	<-tPoolNum // get a turn in the pool
	defer consumeThread(tPoolNum) // to give turn to other threads
	if debugOutput {
		log.Println("Handling video %v", video.Id)
	}
	ytdl := youtube_dl.YoutubeDl{}
	ytdl.Path = "$GOPATH/src/app/srts"
	err := ytdl.DownloadVideo(video.Id)
	if err != nil {
		log.Printf("%v", err)
	}
	StoreValue(video)
}

// START OF MYSQL
//////////////////

// Initialize Mysql Connection
func initializeMysqlConn() {
	dbConn, err := sql.Open("mysql", "admin:admin@tcp(y2search_mysql:3306)/y2search_db?collation=utf8mb4_unicode_ci")
	db = *dbConn
	if err != nil {
		log.Panic(err.Error()) // Just for example purpose. You should use proper error handling instead of panic
	}

	// Open doesn't open a connection. Validate DSN data:
	err = db.Ping()
	if err != nil {
		log.Panic(err.Error()) // proper error handling instead of panic in your app
	}
}

// destruct Mysql Connection
func tearDownMysqlConn() {
	db.Close()
}

// store values in mysql connection
func StoreValue(ytVideoObj ytvideo.YTVideo) {
	// Prepare statement for inserting data
	// INSERTING VIDEO
	// Prepairing
	lastInsertedId, _ := strconv.Atoi(ytVideoObj.Title)
	log.Println("lastInsertedId : %v", lastInsertedId)

	// Read subtitles file
	file, err := ioutil.ReadFile("srts/" + ytVideoObj.Id + ".en.vtt")// it will be save with this extension regardless
	//fmt.Printf(file)
	defer os.Remove("srts/" + ytVideoObj.Id + ".en.vtt");
	if debugOutput {
		log.Println(err)
	}
	if err == nil {
		// INSERTING VIDEO's Subtitles
		// Prepairing
		stmtVidSubIns, err := db.Prepare("INSERT INTO videos_subtitles (`id`, `video_id`,`subtitles`,`language`) VALUES (NULL, ?, ?, ?)") // ? = placeholder
		handleError(err)
		defer stmtVidSubIns.Close() // Close the statement when we leave main() / the program terminates
		// Inserting
		_, err = stmtVidSubIns.Exec(lastInsertedId, file, `en`) // Insert tuples
		handleError(err)

		// INSERTING VIDEO's Meta
		// Prepairing
		stmtVidMetaIns, err := db.Prepare("INSERT INTO videos_meta (`id`, `video_id`,`image_default`,`image_medium`,`image_high`) VALUES (NULL, ?, ?, ?, ?)") // ? = placeholder
		handleError(err)
		defer stmtVidMetaIns.Close() // Close the statement when we leave main() / the program terminates
		// Inserting
		_, err = stmtVidMetaIns.Exec(lastInsertedId, ytVideoObj.ThumbnailDefault, ytVideoObj.ThumbnailMedium, ytVideoObj.ThumbnailHigh) // Insert tuples
		handleError(err)
	}
}

//////////////////
// END OF MYSQL

func threadsPoolManager(tPoolNum chan int) {
	// So that we run only 10 at a time
	for counter := 0; counter < 100; counter++ {
		tPoolNum <- counter
	}
}

// After each thread consume it self, it will call this so it can give one call to another thread.
func consumeThread(tPoolNum chan int) {
	tPoolNum <- 1
}

////////////////////////////////////
////////////////////////////////////
// MAIN APPLICATION START POINT

func main() {
	LogfileName := "/tmp/logs/"+"log_2ndrnd_" + time.Now().Format("2006-01-02_15:04:05") + ".log"
	f, err := os.OpenFile(LogfileName, os.O_APPEND | os.O_CREATE | os.O_RDWR, 0666)
	if err != nil {
		fmt.Printf("error opening file: %v", err)
	}
	// don't forget to close it
	defer f.Close()
	// assign it to the standard logger
	log.SetOutput(f)

	//mysql connection
	initializeMysqlConn()
	var c chan ytvideo.YTVideo = make(chan ytvideo.YTVideo)
	var tPoolNum chan int = make(chan int)

	go listVideosWithNoSubtitles(c, tPoolNum)

	go threadsPoolManager(tPoolNum)

	for i := 0; i < 50; i++ {
		go videosHandler(c, tPoolNum)
	}

	var input string
	fmt.Scanln(&input)
	defer tearDownMysqlConn()
}
// MAIN APPLICATION END POINT
////////////////////////////////////
////////////////////////////////////
