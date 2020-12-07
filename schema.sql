DROP DATABASE IF EXISTS BugMe;
CREATE DATABASE BugMe;
USE BugMe;

DROP TABLE IF EXISTS Users;
CREATE TABLE Users (
   id INT AUTO_INCREMENT,
   firstname VARCHAR(64),
   lastname VARCHAR(64),
   password VARCHAR(64),
   email VARCHAR(64),
   date_joined DATETIME DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY(id));

DROP TABLE IF EXISTS Issues;
CREATE TABLE Issues (
   id INT AUTO_INCREMENT,
   title VARCHAR(64),
   description TEXT(256),
   type VARCHAR(16),
   priority VARCHAR(16),
   status VARCHAR(16),
   assigned_to INT,
   created_by INT,
   created DATETIME DEFAULT CURRENT_TIMESTAMP,
   updated DATETIME DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY(id));

/*INSERT INTO Users( firstname, lastname, password,
 email, date_joined)
  VALUES ('Admin', 'Login', MD5('password123'), 'admin@project2.com', '2020-12-02 12:13:06');*/

INSERT INTO Users( firstname, lastname, password, email)
  VALUES ('Admin', 'Login', MD5('password123'), 'admin@project2.com');
