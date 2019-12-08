CREATE DATABASE todolist;

USE todolist;

CREATE TABLE User 
(
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(60) NOT NULL,
    lastName VARCHAR (60) NOT NULL,
    nickName VARCHAR (40) NOT NULL UNIQUE,
    email VARCHAR(60) NOT NULL UNIQUE,
    password VARCHAR (60) NOT NULL,
    sex char(1) NOT NULL,
    imageProfile VARCHAR(10) NOT NULL,

    PRIMARY KEY (id)
);

CREATE TABLE Task
(
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(60) NOT NULL,
    description VARCHAR(60) NOT NULL,
    status VARCHAR(60) NOT NULL,
    isImportant TINYINT(1),
    dateStart DATE NOT NULL,
    dateEnd DATE,

    idUser INT NOT NULL,

    PRIMARY KEY (id),
    FOREIGN KEY (idUser) REFERENCES User (id)
);
