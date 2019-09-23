## Login
This is extreamly simple login system. 
## Features
You can:
- login 
- register as new user
- create/update profile
- add/delete tasks

## Requirements

- PHP 7.0+
- MySQL
- mod_rewrite activated
- installed Composer

## Installation 
Start by setting up enviroment variables for database and host. 

Enviroment variable names can be found in **/src/Config/database.php** and **/src/Config/app.php** files.

Then run composer to install dependencies:
```bash
composer install
```
Next, import database tables from **database.sql**. Also make sure that web server have enabled mod_rewrite module.

After that you should be able to access **/register** endpoint where you can register new user.

**NOTE:** New user should have password with length **minimum 10 characters**
