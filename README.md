## Overview
* Implemented migration system;
* Laravel Eloquent;
* Simple REST client for API [Component/Property/Client];
* CLI command to fetch data from API;
* Slightly modified framework to use yaml config;
* Used SASS for compiling Bootstrap 4 styles.
* Used Blade engine to render templates.
* Cleaned up unused files.


## ToDo
* validate in saveFromDto using Symfony Validator;
* Implement pagination to `Properties List`.
* CRUD in `Property View`.


## Suggestions for API
* I would use bearer auth for API, instead of sending token in a query.
* API doc can be more understandable when use OpenAPI.


## Running (Using Docker)
**1.** Run start script to lunch docker, install necessary dependencies using composer and migrate database.
```shell script
$ chmod +x docker-start.sh && sh docker-start.sh
```

**2.** After success start modify `config/parameters.yml` with necessary configs
for `api_url` and `api_key`.

**3.** Fetch data from API
```shell script
$ chmod +x docker-console.sh && sh docker-console.sh app:fetch-data
```

**4.** Check out `http://localhost:8080/`.

**5.**
To stop docker, use CTRL+C or following command
```shell script
$ chmod +x docker-stop.sh && sh docker-stop.sh
```


## Running (Using local web server)
**1.** Edit `config/parameters.yml` if present, if not, than run `composer install` and follow instructions

**2.** Migrate database
```shell script
$ php vendor/bin/phpmig migrate
```

**3.** Run CLI command to fetch data from server
```shell script
$ php console.php app:fetch-data
```
