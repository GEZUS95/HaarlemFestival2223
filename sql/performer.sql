# als de DB nog niet bestaat maak er 1
#CREATE DATABASE IF NOT EXISTS haarlemFestival;

# selecteer de juiste db
#USE haarlemFestival;

# zorg dat de eventueele tabel die we willen aan maken verwijderd is
DROP TABLE IF EXISTS performer;

# maak nieuwe tabel
CREATE TABLE performer(
                     id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
                     name varchar(255),
                     description varchar(255)
);

# Voer data in de tabel
INSERT INTO performer VALUES (1, 'Hardwell', '');
INSERT INTO performer VALUES (2, 'Armin van Buren', '');
INSERT INTO performer VALUES (3, 'Tiësto', '');


