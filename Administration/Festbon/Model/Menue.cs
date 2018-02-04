using System;
using System.ComponentModel.DataAnnotations;

namespace Festbon.Model
{
    public class Menue : BaseModel
    {
        private string _name;
        private string _beschreibung;
        private double _preis;
        private DateTime _letzteAenderung;
        private int _aktiv;

        public Menue() {
            _name = "Menü";
            _beschreibung = "Beschreibung";
            _preis = 0;
            _letzteAenderung = DateTime.Now;
            _aktiv = 1;
        }

        public Menue(int id, string name, string beschreibung, double preis, DateTime letzteAenderung, int aktiv)
        {
            ID = id;
            _name = name;
            _beschreibung = beschreibung;
            _preis = preis;
            _letzteAenderung = letzteAenderung;
            _aktiv = aktiv;
        }

        [Required(ErrorMessage = "Name fehlt!")]
        public string Name { get { return _name; } set { _name = value; } }

        [Required(ErrorMessage = "Beschreibung fehlt!")]
        public string Beschreibung { get { return _beschreibung; } set { _beschreibung = value; } }

        public double Preis { get { return _preis; } set { _preis = value; } }

        public DateTime LetzteAenderung { get { return _letzteAenderung; } set { _letzteAenderung = value; } }

        public int Aktiv { get { return _aktiv; } set { _aktiv = value; } }
    }
}
