namespace Festbon.Model
{
    public class Bestellposition : BaseModel
    {
        private int _bestellungID;
        private int _artikelID;
        private int _menge;
        private string _name;
        private double _preis;
        private string _art;

        public Bestellposition()
        {
            _bestellungID = 0;
            _artikelID = 0;
            _menge = 0;
            _name = "Bestellposition";
            _preis = 0;
            _art = "Essen";
        }

        public Bestellposition(int bestellungID, int artikelID, int menge, string name, double preis, string art)
        {
            _bestellungID = bestellungID;
            _artikelID = artikelID;
            _menge = menge;
            _name = name;
            _preis = preis;
            _art = art;
        }

        public int BestellungID { get { return _bestellungID; } set { _bestellungID = value; } }

        public int ArtikelID { get { return _artikelID; } set { _artikelID = value; } }

        public int Menge { get { return _menge; } set { _menge = value; } }

        public string Name { get { return _name; } set { _name = value; } }

        public double Preis { get { return _preis; } set { _preis = value; } }

        public string Art { get { return _art; } set { _art = value; } }

        public override string ToString()
        {
            return "Name: " + Name + ", verkaufte Menge: " + Menge + ", Preis pro Stück: " + Preis.ToString("C");
        }

    }
}
