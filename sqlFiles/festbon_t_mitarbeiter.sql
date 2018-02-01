CREATE TABLE festbon.t_mitarbeiter
(
    id_mitarbeiter int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    vorname_mitarbeiter varchar(45) NOT NULL,
    nachname_mitarbeiter varchar(45) NOT NULL,
    geburtsdatum_mitarbeiter date NOT NULL,
    passwort_mitarbeiter varchar(45) NOT NULL,
    aktiv_mitarbeiter tinyint(4) NOT NULL
);
INSERT INTO festbon.t_mitarbeiter (id_mitarbeiter, vorname_mitarbeiter, nachname_mitarbeiter, geburtsdatum_mitarbeiter, passwort_mitarbeiter, aktiv_mitarbeiter) VALUES (1, 'Tobias', 'Keßler', '1992-01-13', 'asd', 1);