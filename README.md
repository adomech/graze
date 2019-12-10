## Graze

## Summary

The frontend is an application using React, for the Backend is and API using Symfony 5. YOu must need Docker for run the backend in local. The version of the PHP is 7.3 with apache server.

In case of there is no rating for a specific product ,if the user want to increase the number of the rating, then the new value is added on the DB. In other case is updated.

## For Run the Frontend Application in local

Go to frontend folder and Run

yarn install

yarn start

## For Run the Backend in local Application in local

Go to Backend folder and run

docker-compose up -d

When the docker is running, go to the backend directory and run:

composer install
