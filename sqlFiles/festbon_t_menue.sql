CREATE TABLE festbon.t_menue
(
    id_menue int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name_menue varchar(150) NOT NULL,
    beschreibung_menue text NOT NULL,
    preis_menue int(11) NOT NULL,
    datum_menue datetime NOT NULL,
    aktiv_menue tinyint(1) NOT NULL
);
INSERT INTO festbon.t_menue (id_menue, name_menue, beschreibung_menue, preis_menue, datum_menue, aktiv_menue) VALUES (2, 'Menü 1', 'Currywurst mit Pommes', 599, '2018-02-01 09:07:21', 1);
INSERT INTO festbon.t_menue (id_menue, name_menue, beschreibung_menue, preis_menue, datum_menue, aktiv_menue) VALUES (3, 'Menü 2', 'Hamburger mit Pommes', 599, '2018-02-01 09:07:39', 1);
INSERT INTO festbon.t_menue (id_menue, name_menue, beschreibung_menue, preis_menue, datum_menue, aktiv_menue) VALUES (4, 'Menü 3', 'Currywurst mit Pommes und Cola', 799, '2018-02-01 09:08:06', 1);
INSERT INTO festbon.t_menue (id_menue, name_menue, beschreibung_menue, preis_menue, datum_menue, aktiv_menue) VALUES (5, 'Menü 4', 'Hamburger mit Pommes und Cola', 799, '2018-02-01 09:08:23', 1);