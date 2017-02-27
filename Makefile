ifndef env
	env=dev
endif
ifndef modules
	modules=debug
endif
up: 
	docker-compose up -d
upProduction: up
	docker exec -it y2search bash -c "cd /y2search/; npm install; npm run prod;"
down:
	docker-compose down
stop:
	docker-compose stop
delete:
	docker rm -f y2search
	docker rmi y2bsearch_y2search
dependencies: up
	docker exec -it y2search bash -c "cd /y2search/; composer install -vvv; npm install;"
copyConfig:
	docker cp docker/config/logstash/logstash.conf y2search_elk:/opt/logstash/config/logstash.conf
indexMysql: copyConfig
	docker exec -it y2search_elk bash -c "cd /opt/logstash; bin/logstash -f config/logstash.conf"
indexMysqlBG: copyConfig
	docker exec -it -d y2search_elk bash -c "cd /opt/logstash; bin/logstash -f config/logstash.conf"
crawlVideos:
	docker exec -it y2search_crawler bash -c "go run app/hello.go"
crawlVideosBG:
	docker exec -it -d y2search_crawler bash -c "go run app/hello.go"
