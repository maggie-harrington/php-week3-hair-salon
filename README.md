# Hair Salon

#### _Epicodus PHP Week 3 Independent Project - MySQL Database Basics and Behavior Driven Development (BDD), 2/24/2017_

#### By Maggie Harrington

## Description

A sample hair salon application written in PHP to demonstrate MySQL database basics and BDD. The salon owner (user) can add stylists, and for each stylist, add clients who see that stylist. The stylists work independently, so each client only belongs to a single stylist.

## Setup/Installation Requirements

* Download project at my GitHub repository: https://github.com/php-week3-hair-salon .
* To clone through GitHub, first make sure that you have PHP, Composer, and MAMP installed.
* See https://secure.php.net/ for details on installing PHP. Note: PHP is typically already installed on Macs.
* See https://getcomposer.org for details on installing Composer.
* See https://mamp.info/ for details on installing MAMP.
* Open the terminal and enter `cd Desktop`. Copy the link above (in the first bullet point), then type `git clone ` and enter the link. You will now have a copy of this project on your desktop.
* In the terminal, type `cd php-week3-hair-salon/` and hit enter.
* From the terminal, run `composer install --prefer-source --no-interaction`
* Launch MAMP and select "start servers".
* Open a new terminal window and enter `cd ~`, then start MySQL at the command prompt with `/Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot`
* Use PHPMyAdmin `http://localhost:8888/phpmyadmin/` and `hair_salon.sql.zip` (located in the root level of the project folder) to import the `hair_salon` database.
* In the original terminal window, you should still be in the root of the project folder. Type `cd web` and start PHP with `php -S localhost:8000`
* In your web browser, navigate to `localhost:8000`, which will open the home page.

* If you would like to verify my PHPUnit class tests, use PHPMyAdmin to make a copy of the `hair_salon` database and name it `hair_salon_test` database.
* To run PHPUnit tests from the project root, enter `vendor/bin/phpunit tests` into the terminal.

## Known Bugs

No known bugs at this time.

## Support and contact details

If you run into any issues or have questions, ideas or concerns, please feel free to contact me at maggie.harrington@gmail.com

## Technologies Used

Written using Git Bash, Atom, PHP, Composer, Silex, Twig, PHPUnit, MySQL, MAMP and Bootstrap.

### MIT License

Copyright (c) 2017 Maggie Harrington


## Specifications

0. Create `hair_salon` production database with stylists and clients tables and make a copy into `hair_salon_test` for development.

1. Create Stylist class with construct, create and test getters & setters.

2. Create tests and methods for the following Stylist functions:
    * save
    * getAll
    * deleteAll
    * find - single instance
    * update - single instance
    * delete - single instance

3. Write Silex routes for Stylist in app.php after all tests pass.

4. Create Client class with construct, create and test getters & setters.

5. Create tests and methods for the following Client functions:
    * save
    * getAll
    * deleteAll
    * find - single instance
    * update - single instance
    * delete - single instance

6. Construct and test a method to return all of a stylist's clients

7. Write Silex routes for Client in app.php after all tests pass.

8. Create home page to list all stylists at the salon, including a form to add new stylists.

9. Create clients page to display all clients a particular stylist has, including a form to add more clients to a stylist.

10. Add edit and delete buttons to home page, with a new page for the edit form.

11. Add edit and delete buttons to clients page, with a new page for the edit form.

12. Export `hair_salon` and `hair_salon_test` databases to include in project folder.


## MySQL Commands Used

/Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot

CREATE DATABASE hair_salon;

USE hair_salon;

SELECT DATABASE();

CREATE TABLE stylists (id SERIAL PRIMARY KEY, name VARCHAR (255));

CREATE TABLE clients (id SERIAL PRIMARY KEY, name VARCHAR (255), stylist_id BIGINT);

DESCRIBE stylists;

| Field | Type                | Null | Key | Default | Extra          |
|-------|---------------------|------|-----|---------|----------------|
| id    | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| name  | varchar(255)        | YES  |     | NULL    |                |

DESCRIBE clients;

| Field      | Type                | Null | Key | Default | Extra          |
|------------|---------------------|------|-----|---------|----------------|
| id         | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| name       | varchar(255)        | YES  |     | NULL    |                |
| stylist_id | bigint(20)          | YES  |     | NULL    |                |
