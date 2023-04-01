# Raddb3

Radiology imaging equipment management system to track equipment inventory and annual testing of radiology imaging equipment.

This application will track

* radiology imaging equipment inventory
* surveys performed on imaging equipment for
  * acceptance testing
  * annual equipment performance surveys
  * surveys following major repairs
  * shielding surveys
* report repository
* survey recommendations
* test equipment used for performing surveys
  * required calibrations on test equipment

## Install

* Clone the Github repository for the [project](https://github.com/imabug/raddb)
* Run ```composer install``` to install the Laravel framework and associated software bits
* Edit ```.env.example``` and customize database server section for local settings. Save as ```.env```
* Run ```php artisan key:generate``` to generate an application key
* For testing purposes, run ```php artisan serve``` and point your web browser at ```http://localhost:8000```
* For production, configure a web server virtual host using the ```public``` directory as the DocumentRoot

## Changes

This is a re-write of the previous version of [raddb](https://github.com/imabug/raddb) 

* Use Laravel 10 and PHP 8
* A test-driven-design (TDD) approach will be taken with this iteration.
* Use [SQLite](https://sqlite.org/index.html) as the database instead of MySQL.
