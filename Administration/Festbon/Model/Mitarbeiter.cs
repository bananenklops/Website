using System;
using System.ComponentModel.DataAnnotations;

namespace Festbon.Model
{
    public class Mitarbeiter : BaseModel
    {
        private string _vorname;
        private string _nachname;
        private DateTime _geburtsdatum;
        private string _passwort;
        private int _aktiv;

        public Mitarbeiter()
        {
            _nachname = "nachname";
            _vorname = "vorname";
            _geburtsdatum = DateTime.Today;
            _passwort = "passwort";
            _aktiv = 1;
        }

        public Mitarbeiter(int id, string vorname, string nachname, DateTime geburtsdatum, string passwort, int aktiv)
        {
            ID = id;
            _nachname = nachname;
            _vorname = vorname;
            _geburtsdatum = geburtsdatum;
            _passwort = passwort;
            _aktiv = aktiv;
        }


        [Required(ErrorMessage = "Es wurde kein Vorname eingegeben")]
        public string Vorname { get { return _vorname; } set { _vorname = value; } }

        [Required(ErrorMessage = "Es wurde kein Nachname eingegeben")]
        public string Nachname { get { return _nachname; } set { _nachname = value; } }

        public DateTime Geburtsdatum { get { return _geburtsdatum; } set { _geburtsdatum = value; } }

        [Required(ErrorMessage = "Es wurde kein Passwort eingegeben")]
        public string Passwort { get { return _passwort; } set { _passwort = value; } }

        public int Aktiv { get { return _aktiv; } set { _aktiv = value; } }
    }
}