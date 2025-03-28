CREATE DATABASE DuacodeMarcosRandulfe;
USE DuacodeMarcosRandulfe;

CREATE TABLE EQUIPO (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    NOMBRE VARCHAR(255),
    CIUDAD VARCHAR(255),
    DEPORTE VARCHAR(255),
    FECHA_FUNDACION DATE
);