# E_lib
a symfony app online library 



before installing this repo make sure you have composer , symfony , mysql installed 

you can install composer using the following command :
        ` sudo apt install composer `




<ol> 
    <li> ` sudo apt install php-mysql `</li>
    <li> ` sudo apt install curl `</li>
    <li> ` sudo apt install xml-php`</li>
    <li> ` sudo apt install git ` </li>
    <li> ` sudo apt install php-cli php-mbstring `</li>
</ol>


next you need to  create a new user in mysql :


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
    `   ->author VARCHAR(255) NOT NULL);`
    


Grant access to database:

    `GRANT ALL PRIVILEGES ON _db_.* TO 'database_user'@'localhost';`
    
 
    
    

<h1> edit your .env (username , password , database_name)  </h1>

        `DATABASE_URL=mysql://user:password@127.0.0.1:3306/_db_?serverVersion=5.7`

and you can run the server by typing :
    
    `symfony server:start`
