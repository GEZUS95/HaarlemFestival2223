# zorg dat de eventueele tabel die we willen aan maken verwijderd is
DROP TABLE IF EXISTS user;

# maak nieuwe tabel
CREATE TABLE user(
                     id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
                     name varchar(255),
                     email varchar(255),
                     passwordhash varchar(255),
                     description varchar(255),
                     role_id int,
                     foreign key (role_id) REFERENCES role(id)
);

# Voer data in de tabel
INSERT INTO user VALUES (1, 'gebruiker', 'gebruiker@email.com', '$2y$10$/LNXF0yNrbWuzNXXGU8uP.wpWnkTbqzHYx0Ex.Ks2t8p4tBDarnJO', 'dit is een normale test gebruiker', 1);
INSERT INTO user VALUES (2, 'admin', 'admin@email.com', '$2y$10$/LNXF0yNrbWuzNXXGU8uP.wpWnkTbqzHYx0Ex.Ks2t8p4tBDarnJO', 'dit is een admin account', 2);
INSERT INTO user VALUES (3, 'super-admin', 'superadmin@email.com', '$2y$10$/LNXF0yNrbWuzNXXGU8uP.wpWnkTbqzHYx0Ex.Ks2t8p4tBDarnJO','dit is een Super-administrator account',3);

# passwords zijn: welkom1234