# Mysql introduction

## What?
make a CRUD page to register, login and see the profiles of the students
[here](exercise.md) is the exercise.

## Checklist
### 1: the database
- [x] make a database
- [x] make a PDO connection in connection.php

### 2: insert
- [ ] create index.php and insert.php
- [ ] include connection.php in both
- [ ] create a form to fill the table in insert.php
- [ ] require all columns 
- [ ] test if it works
### 3: get from database
- [ ] create a table with the information on index.php
- [ ] add a link to the personal profile page

### 4: the profile page
- [ ] get the required user's details
- [ ] print them out
- [ ] include a be like bill meme from the api
- [ ] every column of the database needs to be shown someway
- [ ] make sure it's a coherent page

### 5: register and login
- [ ] create a login.php and fill up with a login form
- [ ] rename insert.php to register.php and add password & password confirmation field
- [ ] create auth.php and write login and registration logic
- [ ] check if email is valid
- [ ] check if password and password confirmation are equal
- [ ] hash the password
- [ ] if registration fails go back to previous form and fill in previously filled in data
- [ ] if the registration succeeds go to profile.php
- [ ] check if filled in email can be found on a user with that credential
- [ ] check if password matched with password in database
- [ ] if there is an error go back to login page giving an error
- [ ] if it's correct go to index.php
- [ ] make sure only logged in people can see index.php

### 6: edit and delete
- [ ] on profile.php check if logged in user id is the same as profile user id
- [ ] if id's are the same show edit and delete button
- [ ] when the buttons are clicked check if the user has he rights to do the action
- [ ] once executed edit goes back to the profile and delete goes to register page