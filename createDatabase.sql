DROP DATABASE IF EXISTS DuacodeMarcosRandulfe;
CREATE DATABASE DuacodeMarcosRandulfe;
USE DuacodeMarcosRandulfe;

CREATE TABLE CIUDAD (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    NOMBRE VARCHAR(255) UNIQUE
);


CREATE TABLE EQUIPO(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    NOMBRE VARCHAR(255),
    CIUDAD_ID INT,
    CONSTRAINT FK_CIUDAD_ID FOREIGN KEY (CIUDAD_ID) REFERENCES CIUDAD(ID),
    DEPORTE VARCHAR(255),
    FECHA_FUNDACION DATE
);

INSERT INTO CIUDAD (NOMBRE)
VALUES ('Madrid'), ('Barcelona'), ('Valencia'),
       ('Sevilla'), ('Zaragoza'), ('Málaga'),
       ('Bilbao'), ('Murcia'), ('Pontevedra'),
       ('Palma de Mallorca'), ('Las Palmas de Gran Canaria'),
       ('Santiago de Compostela'), ('A Coruña'), ('Ourense'),
       ('Vigo'), ('Lugo'), ('Ferrol');

CREATE TABLE JUGADOR (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    NOMBRE VARCHAR(255),
    NUMERO INT,
    EQUIPO_ID INT,
    CONSTRAINT FK_EQUIPO_ID FOREIGN KEY (EQUIPO_ID) REFERENCES EQUIPO(ID),
    ES_CAPITAN BOOLEAN,
    CONSTRAINT UNIQUE_NUMERO_EQUIPO UNIQUE (NUMERO, EQUIPO_ID)
);