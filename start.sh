#!/bin/bash
cd laradock || exit; docker-compose down; docker-compose up -d workspace nginx mariadb;
