using System;
using System.ComponentModel.DataAnnotations;

namespace Festbon.Model
{
    public class Event : BaseModel
    {
        private string _name;
        private string _ort;
        private DateTime _datum;
        private TimeSpan _beginn;
        private TimeSpan _ende;
        private int _maxBestellungProStunde;
        private int _aktiv;

        public Event() {
            _name = "neuesEvent";
            _ort = "Musterort";
            _datum = DateTime.Now;
            _beginn = TimeSpan.Zero;
            _ende = TimeSpan.Zero;
            _maxBestellungProStunde = 0;
            _aktiv = 1;
        }

        public Event(int id, string name, string ort, DateTime datum, TimeSpan beginn, TimeSpan ende, int aktiv, int maxBestellungProStunde)
        {
            ID = id;
            _name = name;
            _ort = ort;
            _datum = datum;
            _beginn = beginn;
            _ende = ende;
            _maxBestellungProStunde = maxBestellungProStunde;
            _aktiv = aktiv;
        }

        [Required(ErrorMessage = "Es wurde kein Name eingegeben")]
        public string Name { get { return _name; } set { _name = value; } }

        [Required(ErrorMessage = "Es wurde kein Ort angegeben")]
        public string Ort { get { return _ort; } set { _ort = value; } }

        public DateTime Datum { get { return _datum; } set { _datum = value; } }

        public TimeSpan Beginn { get { return _beginn; } set { _beginn = value; } }

        public TimeSpan Ende { get { return _ende; } set { _ende = value; } }

        public int maxBestellungProStunde { get { return _maxBestellungProStunde; } set { _maxBestellungProStunde = value; } }

        public int Aktiv { get { return _aktiv; } set { _aktiv = value; } }

        public override string ToString()
        {
            return this.Name + " in " + this.Ort + " um " + this.Datum;
        }    
    }
}
