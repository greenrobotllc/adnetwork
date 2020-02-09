#!/bin/bash
cd laradock || exit; docker-compose down; docker-compose up -d nginx mariadb;
