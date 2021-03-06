# Mysql introduction

## What?
make a CRUD page to register, login and see the profiles of the students
[here](exercise.md) is the exercise.

## How to use?
- clone repository
- make database using [import.sql](recources/import.sql)
- change user and password in the openDB() function in [connection.php](model/Connection.php)

## Checklist
### 1: the database
- [x] make a database
- [x] make a PDO connection in connection.php

### 2: insert
- [x] create index.php and insert.php
- [x] include connection.php in both
- [x] create a form to fill the table in insert.php
- [x] require all columns 
- [x] test if it works
### 3: get from database
- [x] create a table with the information on index.php
- [x] add a link to the personal profile page

### 4: the profile page
- [x] get the required user's details
- [x] print them out
- [x] include a cat picture from the api
- [x] every column of the database needs to be shown someway
- [ ] make sure it's a coherent page

### 5: register and login
- [x] create a login.php and fill up with a login form
- [x] rename insert.php to register.php and add password & password confirmation field
- [x] create auth.php and write login and registration logic
- [x] check if email is valid
- [x] check if password and password confirmation are equal
- [x] hash the password
- [x] if registration fails go back to previous form and fill in previously filled in data
- [x] if the registration succeeds go to profile.php
- [x] check if filled in email can be found on a user with that credential
- [x] check if password matched with password in database
- [x] if there is an error go back to login page giving an error
- [x] if it's correct go to index.php
- [x] make sure only logged in people can see index.php

### 6: edit and delete
- [x] on profile.php check if logged in user id is the same as profile user id
- [x] if ids are the same show edit and delete button
- [x] when the buttons are clicked check if the user has the rights to do the action
- [x] once executed edit goes back to the profile and delete goes to register page