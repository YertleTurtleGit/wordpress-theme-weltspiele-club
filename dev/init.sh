#!/bin/bash

cd ..

PROJECT_NAME="${PWD##*/}"
SERVER_NAME="${PROJECT_NAME}_server"

cd ..
mkdir "${SERVER_NAME}"
mkdir "${SERVER_NAME}/wp-content"
mkdir "${SERVER_NAME}/wp-content/themes"

cp "${PROJECT_NAME}/dev/docker-compose.yml" "${SERVER_NAME}/"
cp -r "${PROJECT_NAME}" "${SERVER_NAME}/wp-content/themes"

cd "${SERVER_NAME}"
sudo docker kill $(sudo docker ps -q)
sudo docker-compose up -d

xdg-open http://localhost:8000 &

exit
