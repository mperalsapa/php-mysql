# Creacio de la base de dades
CREATE DATABASE agenda;

# Creacio de la taula de dades de contacte de persones
CREATE TABLE persona(
   id INT PRIMARY KEY AUTO_INCREMENT,
   nom VARCHAR(10),
   cognom VARCHAR(10),
   email VARCHAR(20),
   mobil VARCHAR(13),
   fix VARCHAR(13),
   grup VARCHAR(10),
   INDEX (id) 
);

# Inserció de de prova
INSERT INTO persona(nom,cognom,email,mobil,fix,grup) VALUES ("Pere","Pi","ppi@sapalomera.cat","+34666777888","+3493567234","Profes");

# Usuari per accedir a la base de dades
## Creacio del usuari agenda per poder accedir a aquesta base de dades
CREATE USER 'agenda'@'%' IDENTIFIED BY 'P@t@t@';

## Garantitzacio de permisos per l'anterior usuari en la base de dades creada
GRANT ALL PRIVILEGES ON agenda.* TO 'agenda'@'%' WITH GRANT OPTION;
