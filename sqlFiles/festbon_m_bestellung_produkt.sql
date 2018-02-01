CREATE TABLE festbon.m_bestellung_produkt
(
    id_bestellung int(11) NOT NULL,
    id_produkt int(11) NOT NULL,
    menge int(11) NOT NULL,
    CONSTRAINT m_bestellung_produkt_t_bestellung_id_bestellung_fk FOREIGN KEY (id_bestellung) REFERENCES t_bestellung (id_bestellung),
    CONSTRAINT m_bestellung_produkt_t_produkt_id_produkt_fk FOREIGN KEY (id_produkt) REFERENCES t_produkt (id_produkt)
);
CREATE INDEX m_bestellung_produkt_t_bestellung_id_bestellung_fk ON festbon.m_bestellung_produkt (id_bestellung);
CREATE INDEX m_bestellung_produkt_t_produkt_id_produkt_fk ON festbon.m_bestellung_produkt (id_produkt);
INSERT INTO festbon.m_bestellung_produkt (id_bestellung, id_produkt, menge) VALUES (5, 7, 1);
INSERT INTO festbon.m_bestellung_produkt (id_bestellung, id_produkt, menge) VALUES (5, 5, 1);
INSERT INTO festbon.m_bestellung_produkt (id_bestellung, id_produkt, menge) VALUES (5, 10, 1);
INSERT INTO festbon.m_bestellung_produkt (id_bestellung, id_produkt, menge) VALUES (6, 10, 2);
INSERT INTO festbon.m_bestellung_produkt (id_bestellung, id_produkt, menge) VALUES (7, 4, 1);