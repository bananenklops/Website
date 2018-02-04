using System;
using System.ComponentModel.DataAnnotations;

namespace Festbon.Model
{
    public class Produkt : BaseModel
    {
        private string _name;
        private double _preis;
        private string _art;
        private double _groesse;
        private Bestand _bestand;
        private DateTime _letzteAenderung;
        private int _aktiv;

        public Produkt()
        {
            _name = "produktname";
            _preis = 0;
            _art = "Essen";
            _groesse = 0;
            _letzteAenderung = DateTime.Now;
            _aktiv = 1;
        }

        public Produkt(int id, string name, double preis, DateTime letzteAenderung, string art, double groesse, int aktiv, int bestandID, string bestandName, double bestandMenge, string bestandEinheit)
        {
            ID = id;
            _name = name;
            _preis = preis;
            _art = art;
            _groesse = groesse;
            _bestand = new Bestand(bestandID, bestandName, bestandEinheit, bestandMenge);
            _letzteAenderung = letzteAenderung;
            _aktiv = aktiv;
        }

        [Required(ErrorMessage = "Es wurde kein Name eingegeben")]
        public string Name { get { return _name; } set { _name = value; } }

        public double Preis { get { return _preis; } set { _preis = value; } }

        public string Art { get { return _art; } set { _art = value; } }

        public double Groesse { get { return _groesse; } set { _groesse = value; } }

        [Required(ErrorMessage = "Kein Bestand ausgewählt")]
        public Bestand Bestand { get { return _bestand; } set { _bestand = value; } }

        public DateTime LetzteAenderung { get { return _letzteAenderung; } set { _letzteAenderung = value; } }

        public int Aktiv { get { return _aktiv; } set { _aktiv = value; } }

        public override string ToString()
        {
            return Name + ", Größe: " + Groesse + " L/KG, Preis: " + Preis + " €";
        }
    }
}
