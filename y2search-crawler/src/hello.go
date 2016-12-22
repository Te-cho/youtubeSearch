package main

import (
	"fmt"
	"time"
	"log"
	"flag"
	"math/rand"
	// "strconv"
	"net/http"
	"google.golang.org/api/googleapi/transport"
	"google.golang.org/api/youtube/v3"
)
import "database/sql"
import _ "github.com/go-sql-driver/mysql"
import "os/exec"

//START OF YOUTUBE
var (
        query      = flag.String("query", "iprice Mannequinchallenge", "")
        listingVideos = flag.String("chart", "mostPopular", "")
        maxResults = flag.Int64("max-results", 50, "Max YouTube results")
)

const developerKey = "AIzaSyCq6GaikitWw3X3xMduprZB_soUZqvg9_c"


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

//END OF YOUTUBE

// SRT Downloader
func downloadVideo(id string) {

	rand.Seed(time.Now().UnixNano())

	// filename := "\"srts/here_"+strconv.Itoa(rand.Intn(1000000))+".srt\""
	filename := "\"srts/here_" + id + ".srt\""
    commandParams := " --write-auto-sub --skip-download \"https://www.youtube.com/watch?v=" + id + "\" -o " + filename
    commandName := "youtube-dl"
    command := commandName + " " + commandParams
    cmd := exec.Command("sh","-c", command)
	err := cmd.Run()
	if err != nil {
		log.Printf("%v",err)
	}

	log.Printf("command : %v", command)
}

//Printers
func videoPrinter(c chan *youtube.Video) {
  for {
    msg := <- c
    fmt.Println(msg.Id)
    downloadVideo(msg.Id)
  }
}

// START OF MYSQL
func mysqlConnection() {
	
	//this command works just fine
  	db, err := sql.Open("mysql", "admin:admin@tcp(y2search_mysql:3306)/y2search_db")
	if err != nil {
	    panic(err.Error()) // Just for example purpose. You should use proper error handling instead of panic
	}
	defer db.Close()

	// Open doesn't open a connection. Validate DSN data:
	err = db.Ping()
	if err != nil {
	    panic(err.Error()) // proper error handling instead of panic in your app
	}

	
    // Execute the query
    rows, err := db.Query("SELECT * FROM videos")
    if err != nil {
        panic(err.Error()) // proper error handling instead of panic in your app
    }

    // Get column names
    columns, err := rows.Columns()
    if err != nil {
        panic(err.Error()) // proper error handling instead of panic in your app
    }

    // Make a slice for the values
    values := make([]sql.RawBytes, len(columns))

    // rows.Scan wants '[]interface{}' as an argument, so we must copy the
    // references into such a slice
    // See http://code.google.com/p/go-wiki/wiki/InterfaceSlice for details
    scanArgs := make([]interface{}, len(values))
    for i := range values {
        scanArgs[i] = &values[i]
    }

    // Fetch rows
    for rows.Next() {
        // get RawBytes from data
        err = rows.Scan(scanArgs...)
        if err != nil {
            panic(err.Error()) // proper error handling instead of panic in your app
        }

        // Now do something with the data.
        // Here we just print each column as a string.
        var value string
        for i, col := range values {
            // Here we can check if the value is nil (NULL value)
            if col == nil {
                value = "NULL"
            } else {
                value = string(col)
            }
            fmt.Println(columns[i], ": ", value)
        }
        fmt.Println("-----------------------------------")
    }
    if err = rows.Err(); err != nil {
        panic(err.Error()) // proper error handling instead of panic in your app
    }

}
// END OF MYSQL

func main() {
	// var c chan *youtube.Video = make(chan *youtube.Video)
	// go listTrending(c)
	
	// for i := 0; i<50; i++ {
	// 	go videoPrinter(c)
	// }

	//mysql connection test
	mysqlConnection();

  var input string
  fmt.Scanln(&input)
}