package main

import (
  "fmt"
  "time"
  "log"
  "math/rand"
  "strconv"
)
import "os/exec"

func pinger(c chan string) {
  for i := 0; ; i++ {
    c <- "ping"
  }
}

func printer(c chan string) {
  for {
    msg := <- c
    fmt.Println(msg)
	rand.Seed(time.Now().UnixNano())

	filename := "\"srts/here_"+strconv.Itoa(rand.Intn(1000000))+".srt\""
    commandParams := " --write-auto-sub --skip-download \"https://www.youtube.com/watch?v=QECX7YvzF_c\" -o " + filename
    commandName := "youtube-dl"
    command := commandName + " " + commandParams
    cmd := exec.Command("sh","-c", command)
	err := cmd.Run()
	if err != nil {
		log.Printf("%v",err)
	}

	log.Printf("command : %v", command)
	
    time.Sleep(time.Second * 1)
  }
}

func ponger(c chan string) {
  for i := 0; ; i++ {
    c <- "pong"
  }
}

func main() {
  var c chan string = make(chan string)

  go pinger(c)
  go ponger(c)
  
  for i := 0; i<100; i++ {
    go printer(c)
  }
  

  var input string
  fmt.Scanln(&input)
}