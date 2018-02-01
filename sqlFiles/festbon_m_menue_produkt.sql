CREATE TABLE festbon.m_menue_produkt
(
    id_menue int(11) NOT NULL,
    id_produkt int(11) NOT NULL,
    CONSTRAINT m_menue_produkt_t_menue_id_menue_fk FOREIGN KEY (id_menue) REFERENCES t_menue (id_menue),
    CONSTRAINT m_menue_produkt_t_produkt_id_produkt_fk FOREIGN KEY (id_produkt) REFERENCES t_produkt (id_produkt)
);
CREATE INDEX m_menue_produkt_t_menue_id_menue_fk ON festbon.m_menue_produkt (id_menue);
CREATE INDEX m_menue_produkt_t_produkt_id_produkt_fk ON festbon.m_menue_produkt (id_produkt);
INSERT INTO festbon.m_menue_produkt (id_menue, id_produkt) VALUES (2, 11);
INSERT INTO festbon.m_menue_produkt (id_menue, id_produkt) VALUES (2, 5);
INSERT INTO festbon.m_menue_produkt (id_menue, id_produkt) VALUES (3, 7);
INSERT INTO festbon.m_menue_produkt (id_menue, id_produkt) VALUES (3, 5);
INSERT INTO festbon.m_menue_produkt (id_menue, id_produkt) VALUES (4, 11);
INSERT INTO festbon.m_menue_produkt (id_menue, id_produkt) VALUES (4, 5);
INSERT INTO festbon.m_menue_produkt (id_menue, id_produkt) VALUES (4, 3);
INSERT INTO festbon.m_menue_produkt (id_menue, id_produkt) VALUES (5, 7);
INSERT INTO festbon.m_menue_produkt (id_menue, id_produkt) VALUES (5, 5);
INSERT INTO festbon.m_menue_produkt (id_menue, id_produkt) VALUES (5, 3);