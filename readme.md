

# SERVICES CONTROL:
- To crawl the latest videos :
 - this will crawl the latest videos subtitles and meta data from videos from youtube
	`make crawlVideos`

- To index the data in your elastic search from myesql
	- to be able to do proper search for users accessing your platform you need to fill your Elasticsearch documents using LogStash
	`make indexMysql`


The elastic search part is based on this docker container:
https://elk-docker.readthedocs.io/

## to reindex you should run
make indexMysql




## Useful info 
#use this api to fetch videos
https://www.youtube.com/api/timedtext?v=Jg-BRpn38L8&asr_langs=fr,it,es,ru,pt,ja,nl,en,ko,de&key=yttt1&sparams=asr_langs,caps,v,expire&hl=en_US&caps=asr&signature=7C66C0DC3E235945623A661BDD7D7D7BA7C0C599.64384A577B6184F744C9497CB6506E5F3A6838FB&expire=1476311191&kind=asr&lang=en


