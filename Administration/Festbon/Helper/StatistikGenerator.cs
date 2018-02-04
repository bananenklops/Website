using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using Festbon.Model;

namespace Festbon.Helper
{
    public class StatistikGenerator
    {
        private ObservableCollection<BaseModel> _bestellungen;
        private List<StatistikElement> _essen = new List<StatistikElement>();
        private List<StatistikElement> _trinken = new List<StatistikElement>();
        private List<StatistikElement> _menue = new List<StatistikElement>();
        private List<StatistikElement> _mitarbeiter = new List<StatistikElement>();
        private List<KeyValuePair<DateTime, double>> _umsatzverlauf = new List<KeyValuePair<DateTime, double>>();
        private List<KeyValuePair<string, double>> _umsatzverteilung = new List<KeyValuePair<string, double>>();
        private double essensUmsatz = 0;
        private double trinkenUmsatz = 0;
        private double menueUmsatz = 0;

        public StatistikGenerator(ObservableCollection<BaseModel> alleBestellungen)
        {
            _bestellungen = alleBestellungen;
            statistikGenerieren();
            umsatzverteilungBerechnen();
        }

        public List<StatistikElement> Essen { get { return _essen; } }
        public List<StatistikElement> Trinken { get { return _trinken; } }
        public List<StatistikElement> Menue { get { return _menue; } }
        public List<StatistikElement> Mitarbeiter { get { return _mitarbeiter; } }
        public List<KeyValuePair<DateTime, double>> Umsatzverlauf { get { return _umsatzverlauf; } }
        public List<KeyValuePair<string, double>> Umsatzverteilung { get { return _umsatzverteilung; } }
        private void umsatzverteilungBerechnen()
        {
            _umsatzverteilung.Add(new KeyValuePair<string, double>("Essen", essensUmsatz));
            _umsatzverteilung.Add(new KeyValuePair<string, double>("Trinken", trinkenUmsatz));
            _umsatzverteilung.Add(new KeyValuePair<string, double>("Menü", menueUmsatz));
        }
        private void statistikGenerieren()
        {
            foreach (Bestellung bestellung in _bestellungen)
            {
                double produktUmsatz = bestellpositionZuordnen(bestellung.Produkte);
                double menueUmsatz = bestellpositionZuordnen(bestellung.Menue);
                double gesamtUmsatz = produktUmsatz + menueUmsatz;
                Umsatzverlauf.Add(new KeyValuePair<DateTime, double>(bestellung.Datum, gesamtUmsatz));
                StatistikElement mitarbeiter = new StatistikElement();
                mitarbeiter.ID = bestellung.MitarbeiterID;
                mitarbeiter.Name = bestellung.MitarbeiterName;
                mitarbeiter.Umsatzsumme = gesamtUmsatz;
                hinzufuegen(_mitarbeiter, mitarbeiter);
            }
        }
        private double bestellpositionZuordnen(ObservableCollection<BaseModel> bestellpositionen)
        {
            double bestellsumme = 0;
            foreach (Bestellposition bp in bestellpositionen)
            {
                StatistikElement element = new StatistikElement();
                element.ID = bp.ArtikelID;
                element.Name = bp.Name;
                element.Menge = bp.Menge;
                element.Umsatzsumme = bp.Menge * bp.Preis;
                listeBestimmen(bp.Art, element);
                bestellsumme += element.Umsatzsumme;
            }
            return bestellsumme;
        }
        private void listeBestimmen(string model, StatistikElement element)
        {
            if (model.Equals("Essen"))
            {
                hinzufuegen(_essen, element);
                essensUmsatz += element.Umsatzsumme;
            }
            else if (model.Equals("Trinken"))
            {
                hinzufuegen(_trinken, element);
                trinkenUmsatz += element.Umsatzsumme;
            }
            else
            {
                hinzufuegen(_menue, element);
                menueUmsatz += element.Umsatzsumme;
            }
        }
        private void hinzufuegen(List<StatistikElement> liste, StatistikElement einheit)
        {
            int position = indexOf(liste, einheit.ID);
            if (position == -1)
            {
                liste.Add(einheit);
            }
            else
            {
                liste[position].Menge += einheit.Menge;
                liste[position].Umsatzsumme += einheit.Umsatzsumme;
            }
        }
        private int indexOf(List<StatistikElement> liste, int id)
        {
            int position = -1;
            for (int i = 0; i < liste.Count; i++)
            {
                if (liste[i].ID == id)
                {
                    return position = i;
                }
            }
            return position;
        }
    }
}

public class StatistikElement
{
    private int _id;
    private string _name;
    private int _menge;
    private double _umsatzsumme;

    public StatistikElement()
    {
    }

    public int ID { get { return _id; } set { _id = value; } }
    public string Name { get { return _name; } set { _name = value; } }
    public int Menge { get { return _menge; } set { _menge = value; } }
    public double Umsatzsumme { get { return _umsatzsumme; } set { _umsatzsumme = value; } }
}



