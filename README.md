# E_lib
a symfony app online library 



before installing this repo make sure you have composer , symfony , mysql installed 

use ` sudo apt install php-mysql `
    ` sudo apt install curl `
    ` sudo apt install xml-php`
    ` sudo apt install git ` 
    ` sudo apt install php-cli php-mbstring `

next you need to  create a new user in mysql 
    `CREATE USER 'newuser'@'localhost' IDENTIFIED BY 'user_password';`

create database :
    ` CREATE DATABASE _db_;`
 
use database :
    ` USE _db_;`
 
 
create table:
    ` CREATE TABLE book(`
    `   ->id INT AUTO_INCREMENT PRIMARY KEY,`
    `   ->name VARCHAR(255) NOT NULL,`
    `   ->year INT NOT NULL,`
    `   ->author VARCHAR(255));`
    


Grant access to database 
    `GRANT ALL PRIVILEGES ON _db_.* TO 'database_user'@'localhost';`
    
 
    
    

edit your .env username , password , database to match the two sql line above


and you can run the server by typing `symfony server:start`
