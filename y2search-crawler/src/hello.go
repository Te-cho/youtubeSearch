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

func main() {
	var c chan *youtube.Video = make(chan *youtube.Video)
	go listTrending(c)
	
	for i := 0; i<50; i++ {
		go videoPrinter(c)
	}
  

  var input string
  fmt.Scanln(&input)
}