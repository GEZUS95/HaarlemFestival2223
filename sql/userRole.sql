# als de DB nog niet bestaat maak er 1
#CREATE DATABASE IF NOT EXISTS haarlemFestival;

# selecteer de juiste db
#USE haarlemFestival;

# zorg dat de eventueele tabel die we willen aan maken verwijderd is
DROP TABLE IF EXISTS role;

# maak nieuwe tabel
CREATE TABLE role(
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name varchar(255),
    description varchar(255)
);

# Voer data in de tabel
INSERT INTO role VALUES (1, 'user', 'Simple user account');
INSERT INTO role VALUES (2, 'admin', 'Administrator account');
INSERT INTO role VALUES (3, 'super-admin', 'Super-administrator account');


