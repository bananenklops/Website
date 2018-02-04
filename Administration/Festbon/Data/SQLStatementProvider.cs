using System;
using Festbon.Model;

namespace Festbon.Data
{
    public class SQLStatementProvider
    {
        private int wandelEuropreisInCentpreis(double euro)
        {
            return Convert.ToInt32((euro * 100));
        }

        private string formatiereDatum(DateTime date)
        {
            return date.ToString("yyyy-MM-dd HH:mm:ss");
        }

        private string ersetzeKommaMitPunkt(double value)
        {
            return value.ToString().Replace(",", ".");
        }

        public string selectStatement(string model)
        {
            if (model.Equals("produkt"))
            {
                return "SELECT * FROM festbon.t_produkt as Produkt INNER JOIN festbon.t_bestand as Bestand ON Produkt.id_bestand = Bestand.id_bestand WHERE aktiv_produkt = 1";
            }
            else if (model.Equals("bestand"))
            {
                return "SELECT * FROM festbon.t_" + model;
            }
            else if (model.Equals("bestellung"))
            {
                return "SELECT id_bestellung, datum_bestellung, Mitarbeiter.id_mitarbeiter, vorname_mitarbeiter, nachname_mitarbeiter, _Event.id_event, name_event, ort_event FROM festbon.t_bestellung as Bestellung INNER JOIN festbon.t_mitarbeiter as Mitarbeiter ON Bestellung.id_mitarbeiter = Mitarbeiter.id_mitarbeiter INNER JOIN festbon.t_event as _Event ON Bestellung.id_event = _Event.id_event;";
            }
            else
            {
                return "SELECT * FROM festbon.t_" + model + " WHERE aktiv_" + model + "=1";
            }
        }

        public string insertStatement(BaseModel entity)
        {
            if (entity.GetType() == typeof(Bestand))
            {
                Bestand bestand = (Bestand)entity;
                return "INSERT INTO `festbon`.`t_bestand` (`name_bestand`, `menge_bestand`, `einheit_bestand`) VALUES ('"
                    + bestand.Name + "', '"
                    + ersetzeKommaMitPunkt(bestand.Menge)
                    + "','" + bestand.Einheit + "');";
            }
            else if (entity.GetType() == typeof(Event))
            {
                Event _event = (Event)entity;
                return "INSERT INTO `festbon`.`t_event` (`name_event`, `ort_event`, `datum_event`, `beginn_event`, `ende_event`, `aktiv_event`, `maxBestellung_event`) VALUES('"
                    + _event.Name + "', '"
                    + _event.Ort + "', '"
                    + formatiereDatum(_event.Datum) + "', '"
                    + _event.Beginn + "', '" 
                    + _event.Ende + "', '1','"
                    + _event.maxBestellungProStunde + "'); ";
            }
            else if (entity.GetType() == typeof(Produkt))
            {
                Produkt produkt = (Produkt)entity;
                return "INSERT INTO `festbon`.`t_produkt` (`name_produkt`, `preis_produkt`, `letztesUpdate_produkt`, `id_bestand`, `art_produkt`, `portion_produkt`, `aktiv_produkt`) VALUES ('"
                    + produkt.Name + "', '"
                    + wandelEuropreisInCentpreis(produkt.Preis) + "', '"
                    + formatiereDatum(DateTime.Now) + "', '"
                    + produkt.Bestand.ID + "', '"
                    + produkt.Art + "', '"
                    + (ersetzeKommaMitPunkt(produkt.Groesse*1000)) + "', '1'); ";
            }
            else if (entity.GetType() == typeof(Menue))
            {
                Menue menue = (Menue)entity;
                return "INSERT INTO `festbon`.`t_menue` (`name_menue`, `beschreibung_menue`, `preis_menue`, `datum_menue`, `aktiv_menue`) VALUES ('"
                    + menue.Name + "', '"
                    + menue.Beschreibung + "', '"
                    + wandelEuropreisInCentpreis(menue.Preis) + "', '"
                    + formatiereDatum(DateTime.Now) + "', '1'); ";
            }
            else if (entity.GetType() == typeof(MenueProdukt))
            {
                MenueProdukt menue = (MenueProdukt)entity;
                return "INSERT festbon.m_menue_produkte VALUES ("
                    + menue.MenuID + ","
                    + menue.ProduktID + ","
                    + menue.Produktmenge + ");";
            }
            else
            {
                Mitarbeiter mitarbeiter = (Mitarbeiter)entity;
                return "INSERT INTO `festbon`.`t_mitarbeiter` (`vorname_mitarbeiter`, `nachname_mitarbeiter`, `geburtsdatum_mitarbeiter`, `passwort_mitarbeiter`, `aktiv_mitarbeiter`) VALUES ('"
                    + mitarbeiter.Vorname + "', '"
                    + mitarbeiter.Nachname + "', '"
                    + formatiereDatum(mitarbeiter.Geburtsdatum) + "', '"
                    + mitarbeiter.Passwort + "', '1'); ";
            }
        }

        public string updateStatement(BaseModel entity)
        {
            if (entity.GetType() == typeof(Bestand))
            {
                Bestand bestand = (Bestand)entity;
                return "UPDATE `festbon`.`t_bestand` SET "
                        + "`name_bestand`='" + bestand.Name
                        + "', `einheit_bestand`='" + bestand.Einheit
                        + "', `menge_bestand`='" + ersetzeKommaMitPunkt(bestand.Menge)
                        + "' WHERE `id_bestand`='" + bestand.ID + "';";
            }
            else if (entity.GetType() == typeof(Event))
            {
                Event _event = (Event)entity;
                return "UPDATE `festbon`.`t_event` SET "
                        + "`name_event`= '" + _event.Name
                        + "', `ort_event`= '" + _event.Ort
                        + "', `datum_event`= '" + formatiereDatum(_event.Datum)
                        + "', `beginn_event`= '" + _event.Beginn
                        + "', `ende_event`= '" + _event.Ende
                        + "', `aktiv_event`= '1"
                        + "', `maxBestellung_event`= '" + _event.maxBestellungProStunde 
                        + "' WHERE `id_event`= '" + _event.ID + "'; ";
            }
            else if (entity.GetType() == typeof(Produkt))
            {
                Produkt produkt = (Produkt)entity;
                return "UPDATE `festbon`.`t_produkt` SET `"
                        + "name_produkt`='" + produkt.Name
                        + "', `preis_produkt`='" + wandelEuropreisInCentpreis(produkt.Preis)
                        + "', `letztesUpdate_produkt`='" + formatiereDatum(DateTime.Now)
                        + "', `id_bestand`='" + produkt.Bestand.ID
                        + "', `art_produkt`='" + produkt.Art
                        + "', `portion_produkt`='" + ersetzeKommaMitPunkt(produkt.Groesse*1000)
                        + "', `aktiv_produkt`='1'"
                        + " WHERE `id_produkt`='" + produkt.ID + "';";
            }
            else if (entity.GetType() == typeof(Menue))
            {
                Menue menue = (Menue)entity;
                return "UPDATE `festbon`.`t_menue` SET "
                        + "`name_menue`= '" + menue.Name
                        + "', `beschreibung_menue`= '" + menue.Beschreibung
                        + "', `preis_menue`= '" + wandelEuropreisInCentpreis(menue.Preis)
                        + "', `datum_menue`= '" + formatiereDatum(DateTime.Now)
                        + "', `aktiv_menue`= '1'"
                        + " WHERE `id_menue`= '" + menue.ID + "'; ";
            }
            else
            {
                Mitarbeiter mitarbeiter = (Mitarbeiter)entity;
                return "UPDATE `festbon`.`t_mitarbeiter` SET "
                        + "`vorname_mitarbeiter`='" + mitarbeiter.Vorname
                        + "', `nachname_mitarbeiter`='" + mitarbeiter.Nachname
                        + "', `geburtsdatum_mitarbeiter`='" + formatiereDatum(mitarbeiter.Geburtsdatum)
                        + "', `passwort_mitarbeiter`= '" + mitarbeiter.Passwort
                        + "', `aktiv_mitarbeiter`='1"
                        + "' WHERE `id_mitarbeiter`='" + mitarbeiter.ID + "';";
            }
        }

        public string deleteStatement(BaseModel entity)
        {
            if (entity.GetType() == typeof(Bestand))
            {
                return "DELETE FROM festbon.t_bestand WHERE festbon.t_bestand.id_bestand=" + entity.ID;
            }
            else if (entity.GetType() == typeof(MenueProdukt))
            {
                MenueProdukt mp = (MenueProdukt)entity;
                return "DELETE FROM festbon.m_menue_produkte where id_menue = " + mp.MenuID
                    + " AND id_produkt=" + mp.ProduktID;
            }
            else
            {
                string modelType = entity.GetType().ToString().ToLower().Substring(14);
                return "UPDATE `festbon`.`t_" + modelType + "` SET `aktiv_" + modelType
                    + "`='0' WHERE `id_" + modelType + "`='" + entity.ID + "';";
            }
        }

        public string menueproduktStatement(int menueID)
        {
            return "SELECT id_menue, p.id_produkt, menge, name_produkt, art_produkt FROM festbon.m_menue_produkte as mmp inner join festbon.t_produkt as p on mmp.id_produkt=p.id_produkt where id_menue =" + menueID + " AND p.aktiv_produkt =1";
        }

        public string bestellungenBeiEinemEventStatement(int eventID)
        {
            return "SELECT id_bestellung, datum_bestellung, Mitarbeiter.id_mitarbeiter, vorname_mitarbeiter, nachname_mitarbeiter, _Event.id_event, name_event, ort_event FROM festbon.t_bestellung as Bestellung INNER JOIN festbon.t_mitarbeiter as Mitarbeiter ON Bestellung.id_mitarbeiter = Mitarbeiter.id_mitarbeiter INNER JOIN festbon.t_event as _Event ON Bestellung.id_event = _Event.id_event" +
                    " WHERE Bestellung.id_event = " + eventID;
        }

        public string bestellpositioneenEinerBestellungStatement(string model, int bestellungID)
        {
            if ("produkt".Equals(model))
            {
                return "SELECT id_bestellung, Produkt.id_produkt, menge, name_produkt, preis_produkt, art_produkt FROM festbon.m_bestellung_produkt as BP INNER JOIN festbon.t_produkt as Produkt ON BP.id_produkt = Produkt.id_produkt WHERE id_bestellung = " + bestellungID;
            }
            else
            {
                return "SELECT 	id_bestellung, MENU.id_menue, menge, name_menue, preis_menue, beschreibung_menue FROM festbon.m_bestellung_menue AS BM INNER JOIN festbon.t_menue AS MENU ON BM.id_menue = MENU.id_menue WHERE id_bestellung = " + bestellungID;
            }
        }
    }
}

