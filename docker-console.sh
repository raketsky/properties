#!/bin/sh

export $(egrep -v '^#' ./docker/.env | xargs)

echo
printf "${GREEN}Starting console command..${NC}\n"
echo

docker-compose -f ./docker/docker-compose.yml exec php php console.php $1
