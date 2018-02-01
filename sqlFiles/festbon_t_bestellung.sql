CREATE TABLE festbon.t_bestellung
(
    id_bestellung int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    datum_bestellung datetime NOT NULL,
    id_mitarbeiter int(11) NOT NULL,
    id_event int(11) NOT NULL,
    CONSTRAINT t_bestellung_t_mitarbeiter_id_mitarbeiter_fk FOREIGN KEY (id_mitarbeiter) REFERENCES t_mitarbeiter (id_mitarbeiter),
    CONSTRAINT t_bestellung_t_event_id_event_fk FOREIGN KEY (id_event) REFERENCES t_event (id_event)
);
CREATE INDEX t_bestellung_t_mitarbeiter_id_mitarbeiter_fk ON festbon.t_bestellung (id_mitarbeiter);
CREATE INDEX t_bestellung_t_event_id_event_fk ON festbon.t_bestellung (id_event);
INSERT INTO festbon.t_bestellung (id_bestellung, datum_bestellung, id_mitarbeiter, id_event) VALUES (4, '2018-02-01 10:27:46', 1, 2);
INSERT INTO festbon.t_bestellung (id_bestellung, datum_bestellung, id_mitarbeiter, id_event) VALUES (5, '2018-02-01 10:28:07', 1, 2);
INSERT INTO festbon.t_bestellung (id_bestellung, datum_bestellung, id_mitarbeiter, id_event) VALUES (6, '2018-02-01 10:29:18', 1, 2);
INSERT INTO festbon.t_bestellung (id_bestellung, datum_bestellung, id_mitarbeiter, id_event) VALUES (7, '2018-02-01 10:29:48', 1, 2);
INSERT INTO festbon.t_bestellung (id_bestellung, datum_bestellung, id_mitarbeiter, id_event) VALUES (9, '2018-02-01 11:02:57', 1, 2);