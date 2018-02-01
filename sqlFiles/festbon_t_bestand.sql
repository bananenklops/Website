CREATE TABLE festbon.t_bestand
(
    id_bestand int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name_bestand varchar(150) NOT NULL,
    einheit_bestand enum('Kilogramm', 'Liter', 'Stück') NOT NULL,
    menge_bestand double NOT NULL
);
INSERT INTO festbon.t_bestand (id_bestand, name_bestand, einheit_bestand, menge_bestand) VALUES (1, 'Hamburger', 'Stück', 1000);
INSERT INTO festbon.t_bestand (id_bestand, name_bestand, einheit_bestand, menge_bestand) VALUES (2, 'Cola', 'Liter', 1000);
INSERT INTO festbon.t_bestand (id_bestand, name_bestand, einheit_bestand, menge_bestand) VALUES (3, 'Pommes', 'Stück', 1000);
INSERT INTO festbon.t_bestand (id_bestand, name_bestand, einheit_bestand, menge_bestand) VALUES (4, 'Bier', 'Liter', 1000);
INSERT INTO festbon.t_bestand (id_bestand, name_bestand, einheit_bestand, menge_bestand) VALUES (5, 'Currywurst', 'Stück', 1000);