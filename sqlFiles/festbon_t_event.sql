CREATE TABLE festbon.t_event
(
    id_event int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name_event varchar(100) NOT NULL,
    ort_event varchar(100) NOT NULL,
    datum_event date NOT NULL,
    beginn_event time NOT NULL,
    ende_event time NOT NULL,
    aktiv_event tinyint(4) NOT NULL,
    maxBestellung_event int(11) NOT NULL
);
INSERT INTO festbon.t_event (id_event, name_event, ort_event, datum_event, beginn_event, ende_event, aktiv_event, maxBestellung_event) VALUES (1, 'Schützenfest 2018', 'Alter Sportplatz Obergimpern', '2018-04-29', '00:00:02', '00:00:00', 1, 100);
INSERT INTO festbon.t_event (id_event, name_event, ort_event, datum_event, beginn_event, ende_event, aktiv_event, maxBestellung_event) VALUES (2, 'VoFi 2018', 'Stadthalle Neckarbischofsheim', '2018-05-19', '00:00:01', '00:00:00', 1, 5);