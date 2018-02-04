using System;
using System.ComponentModel.DataAnnotations;

namespace Festbon.Model
{
    public class Bestand : BaseModel
    {
        private string _name;
        private double _menge;
        private string _einheit;

        public Bestand() {
            _name = "neuer Bestand";
            _menge = 0;
            _einheit = "Stück";
        }

        public Bestand(int id, string name, string einheit, double menge)
        {
            ID = id;
            _name = name;
            _menge = menge;
            _einheit = einheit;
        }

        [Required(ErrorMessage = "Kein Name wurde eingegeben")]
        public string Name { get { return _name; } set { _name = value; } }
   
        public Double Menge { get { return _menge; } set { _menge = value; } }

        public string Einheit { get { return _einheit; } set { _einheit = value; } }

        public override bool Equals(object obj)
        {
            if (obj == null || !(obj is Bestand))
                return false;

            return ((Bestand)obj).ID == this.ID;
        }

        public override string ToString()
        {
            return Name + ", " + Menge + " " + Einheit;
        }
    }
}
