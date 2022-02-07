# FranceTV Lab

[![pipeline status](https://gitlab.ftven.net/innovation/francetv-lab/badges/master/pipeline.svg)](https://gitlab.ftven.net/innovation/francetv-lab/-/commits/master)
[![coverage report](https://gitlab.ftven.net/innovation/francetv-lab/badges/master/coverage.svg)](https://gitlab.ftven.net/innovation/francetv-lab/-/commits/master)


[nuxt](https://fr.nuxtjs.org/) x [laravel](laravel.com/) x [nova](nova.laravel.com/)

## Start the project :

You need docker to run the project. We created makefile shortcut to help you dev faster !

Install the app for the first time :

`make first-init`

Start the app :

`make up`

Stop the app :

`make stop`

Restart the app :

`make restart`


| App  | Url  |
|---|---|
| Api  | [https://api.localhost](https://api.localhost)  |
| Nova  | [https://api.localhost/admin](https://api.localhost/admin) (need a custom endpoint) |
| Front | [https://front.localhost](https://front.localhost/)  |
| Traefik | [http://localhost:8080](http://localhost:8080)  |
