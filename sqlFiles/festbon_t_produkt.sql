CREATE TABLE festbon.t_produkt
(
    id_produkt int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name_produkt varchar(150) NOT NULL,
    preis_produkt int(11) NOT NULL,
    letztesUpdate_produkt datetime NOT NULL,
    id_bestand int(11) NOT NULL,
    art_produkt enum('Essen', 'Trinken') NOT NULL,
    portion_produkt int(11) NOT NULL,
    aktiv_produkt tinyint(1) DEFAULT '1' NOT NULL,
    CONSTRAINT t_produkt_t_bestand_id_bestand_fk FOREIGN KEY (id_bestand) REFERENCES t_bestand (id_bestand)
);
CREATE INDEX t_produkt_t_bestand_id_bestand_fk ON festbon.t_produkt (id_bestand);
INSERT INTO festbon.t_produkt (id_produkt, name_produkt, preis_produkt, letztesUpdate_produkt, id_bestand, art_produkt, portion_produkt, aktiv_produkt) VALUES (3, 'kleine Cola', 240, '2018-02-01 08:27:48', 2, 'Trinken', 300, 1);
INSERT INTO festbon.t_produkt (id_produkt, name_produkt, preis_produkt, letztesUpdate_produkt, id_bestand, art_produkt, portion_produkt, aktiv_produkt) VALUES (4, 'große Cola', 300, '2018-02-01 08:29:09', 2, 'Trinken', 500, 1);
INSERT INTO festbon.t_produkt (id_produkt, name_produkt, preis_produkt, letztesUpdate_produkt, id_bestand, art_produkt, portion_produkt, aktiv_produkt) VALUES (5, 'Pommes', 349, '2018-02-01 08:29:55', 3, 'Essen', 1, 1);
INSERT INTO festbon.t_produkt (id_produkt, name_produkt, preis_produkt, letztesUpdate_produkt, id_bestand, art_produkt, portion_produkt, aktiv_produkt) VALUES (6, 'Pommes', 421, '2018-02-01 08:30:43', 3, 'Essen', 1, 0);
INSERT INTO festbon.t_produkt (id_produkt, name_produkt, preis_produkt, letztesUpdate_produkt, id_bestand, art_produkt, portion_produkt, aktiv_produkt) VALUES (7, 'Hamburger', 329, '2018-02-01 08:31:14', 1, 'Essen', 1, 1);
INSERT INTO festbon.t_produkt (id_produkt, name_produkt, preis_produkt, letztesUpdate_produkt, id_bestand, art_produkt, portion_produkt, aktiv_produkt) VALUES (8, 'kleines Bier', 199, '2018-02-01 08:32:01', 4, 'Trinken', 300, 1);
INSERT INTO festbon.t_produkt (id_produkt, name_produkt, preis_produkt, letztesUpdate_produkt, id_bestand, art_produkt, portion_produkt, aktiv_produkt) VALUES (9, 'Bier', 249, '2018-02-01 08:32:46', 4, 'Trinken', 400, 1);
INSERT INTO festbon.t_produkt (id_produkt, name_produkt, preis_produkt, letztesUpdate_produkt, id_bestand, art_produkt, portion_produkt, aktiv_produkt) VALUES (10, 'Maß', 599, '2018-02-01 08:33:28', 4, 'Trinken', 1000, 1);
INSERT INTO festbon.t_produkt (id_produkt, name_produkt, preis_produkt, letztesUpdate_produkt, id_bestand, art_produkt, portion_produkt, aktiv_produkt) VALUES (11, 'Currywurst', 329, '2018-02-01 08:34:20', 5, 'Essen', 1, 1);