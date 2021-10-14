/* 

INGENIERIA EN DESARROLLO DE SOFTWARE (IDS)
5 SEMESTRE 
TURNO VESPERTINO
 
 BASE DE DATOS II
 EXAMEN UNIDAD II - III
 
EQUIPO:
ALVAREZ LUGO DARA ELIENAI
EMILIANO PRADO ISAAC EDUARDO

*/

DROP DATABASE IF EXISTS examen_bd;
CREATE DATABASE examen_bd;
USE examen_bd;

CREATE TABLE usuarios(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    primer_apellido VARCHAR(100) NOT NULL,
    segundo_apellido VARCHAR(100),
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(150) NOT NULL    
);

CREATE TABLE cuentas(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    tipo_cuenta ENUM('Normal', 'Premium') NOT NULL,
    cantidad FLOAT,
    usuario_id INT NOT NULL,
    CONSTRAINT FK_CUENTAS_USUARIOS
    FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE movimientos(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    cuenta_origen INT NOT NULL,
    cuenta_destino INT NOT NULL,
    cantidad FLOAT NOT NULL,
    descripcion VARCHAR(200) NOT NULL,
    fecha DATE NOT NULL,
    CONSTRAINT FK_MOVIMIENTOS_CUENTAS_ORIGEN
    FOREIGN KEY(cuenta_origen) REFERENCES cuentas(id)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
    CONSTRAINT FK_MOVIMIENTOS_CUENTAS_DESTINO
    FOREIGN KEY(cuenta_destino) REFERENCES cuentas(id)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);

DELIMITER $$
	CREATE PROCEDURE SP_CREATE_USER_PROFILE(
		IN nombre VARCHAR(100),
		IN primer_apellido VARCHAR(100),
		segundo_apellido VARCHAR(100),
		email VARCHAR(100),
		password VARCHAR(150))
		BEGIN
			START TRANSACTION;
			IF email NOT REGEXP('^[a-zA-Z0-9][a-zA-Z0-9._-]*[a-zA-Z0-9._-]@[a-zA-Z0-9][a-zA-Z0-9._-]*[a-zA-Z0-9]\\.[a-zA-Z]{2,63}$') THEN
				ROLLBACK;
                SIGNAL SQLSTATE '45000'
				SET MESSAGE_TEXT = 'Correo invalido';
			ELSEIF LENGTH(password) < 8 THEN
				ROLLBACK;
                SIGNAL SQLSTATE '45000'
					SET MESSAGE_TEXT = 'La password debe ser mayor o igual a 8 caracteres';
			END IF;
            
			INSERT INTO usuarios(nombre, primer_apellido, segundo_apellido, email, password)
			VALUES (nombre, primer_apellido, segundo_apellido, email, password);
            
            COMMIT;
		END$$
DELIMITER ;

DELIMITER $$
	CREATE PROCEDURE SP_OPEN_ACCOUNT(
		IN tipo_cuenta ENUM('Normal', 'Premium'),
		IN cantidad FLOAT,
		IN usuario_id INT)
		BEGIN
			START TRANSACTION;
			IF cantidad < 0 THEN
				ROLLBACK;
                SIGNAL SQLSTATE '45000'
				SET MESSAGE_TEXT = 'Cantidad incorrecta';
			END IF;
            
			INSERT INTO cuentas(tipo_cuenta, cantidad, usuario_id)
			VALUES (tipo_cuenta, cantidad, usuario_id);
            
            COMMIT;
		END$$
DELIMITER ;

DELIMITER $$
	CREATE PROCEDURE SP_REGISTER_MOVEMENT(
		IN cuenta_origen INT,
        IN cuenta_destino INT,
        IN cantidad FLOAT,
        IN descripcion VARCHAR(200),
        IN fecha DATE)
        BEGIN
            
            INSERT INTO movimientos(cuenta_origen, cuenta_destino, cantidad, descripcion, fecha) 
            VALUES (cuenta_origen, cuenta_destino, cantidad, descripcion, fecha);

        END$$
DELIMITER ;