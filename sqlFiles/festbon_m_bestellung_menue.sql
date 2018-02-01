CREATE TABLE festbon.m_bestellung_menue
(
    id_bestellung int(11) NOT NULL,
    id_menue int(11) NOT NULL,
    menge int(11),
    CONSTRAINT m_bestellung_menue_t_bestellung_id_bestellung_fk FOREIGN KEY (id_bestellung) REFERENCES t_bestellung (id_bestellung),
    CONSTRAINT m_bestellung_menue_t_menue_id_menue_fk FOREIGN KEY (id_menue) REFERENCES t_menue (id_menue)
);
CREATE INDEX m_bestellung_menue_t_bestellung_id_bestellung_fk ON festbon.m_bestellung_menue (id_bestellung);
CREATE INDEX m_bestellung_menue_t_menue_id_menue_fk ON festbon.m_bestellung_menue (id_menue);
INSERT INTO festbon.m_bestellung_menue (id_bestellung, id_menue, menge) VALUES (4, 2, 1);
INSERT INTO festbon.m_bestellung_menue (id_bestellung, id_menue, menge) VALUES (4, 3, 1);
INSERT INTO festbon.m_bestellung_menue (id_bestellung, id_menue, menge) VALUES (7, 3, 2);
INSERT INTO festbon.m_bestellung_menue (id_bestellung, id_menue, menge) VALUES (9, 4, 1);