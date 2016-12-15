package main

import (
  "fmt"
  "time"
  "log"
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
    commandParams := " --write-auto-sub --skip-download \"https://www.youtube.com/watch?v=QECX7YvzF_c\" -o srts/here_" + time.Now().String() + ".srt"
    command := "youtube-dl"
    cmd := exec.Command(command, commandParams)
	cmd.Run()

	log.Printf("command : %v", commandParams)
	
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

  go printer(c)
  go printer(c)
  go printer(c)
  go printer(c)
  go printer(c)
  go printer(c)
  go printer(c)
  go printer(c)
  go printer(c)
  go printer(c)
  go printer(c)
  go printer(c)

  var input string
  fmt.Scanln(&input)
}