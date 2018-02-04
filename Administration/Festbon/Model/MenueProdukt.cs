namespace Festbon.Model
{
    public class MenueProdukt : BaseModel
    {
        private int _menuID;
        private int _produktID;
        private int _produktmenge;
        private string _produktName;
        private string _produktArt;

        public MenueProdukt()
        {
            _menuID = 0;
            _produktID = 0;
            _produktmenge = 0;
            _produktName = "Produkt";
            _produktArt = "Essen";
        }

        public MenueProdukt(int menuId, int produktId, int produktmenge, string produktName, string produktArt)
        {
            _menuID = menuId;
            _produktID = produktId;
            _produktmenge = produktmenge;
            _produktName = produktName;
            _produktArt = produktArt;
        }

        public int MenuID { get { return _menuID; } set { _menuID = value; } }

        public int Produktmenge { get { return _produktmenge; } set { _produktmenge = value; } }

        public int ProduktID { get { return _produktID; } set { _produktID = value; } }

        public string ProduktName { get { return _produktName; } set { _produktName = value; } }

        public string ProduktArt { get { return _produktArt; } set { _produktArt = value; } }
    }
}
