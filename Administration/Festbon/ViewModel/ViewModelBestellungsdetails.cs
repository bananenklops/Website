using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.IO;
using System.Windows;
using Festbon.Data;
using Festbon.Helper;
using Festbon.Model;
using Microsoft.Win32;

namespace Festbon.ViewModel
{
    public class ViewModelBestellungsdetails : NotifyPropertyChanged
    {
        private Bestellung _bestellung;
        private string _titel;
        private double _gesamtsumme;
        private List<Bestellposition> _bestellpositionen;
        private RelayCommand _datenExportCommand;
        private RelayCommand _fensterSchliessenCommand;

        public ViewModelBestellungsdetails(Bestellung bestellung)

        {
            _bestellung = bestellung;
            _titel = "Die Bestellung, die von " + _bestellung.MitarbeiterName + " um " + _bestellung.Datum + " bei " + _bestellung.EventInfo + " ausgelöst wurde, enthält folgende Positionen:\n";
            _bestellpositionen = new List<Bestellposition>();
            bestellpositionenListViewFuellen(_bestellung.Produkte);
            bestellpositionenListViewFuellen(_bestellung.Menue);
            _datenExportCommand = new RelayCommand(datenExportieren);
            _fensterSchliessenCommand = new RelayCommand(fensterSchließen);
        }

        public string Titel { get { return _titel; } }

        public List<Bestellposition> Bestellpositionen { get { return _bestellpositionen; } }

        public double Gesamtsumme { get { return _gesamtsumme; } set { _gesamtsumme = value; } }

        public RelayCommand DatenExportCommand
        {
            get { return _datenExportCommand; }
            set { _datenExportCommand = value; }
        }

        public RelayCommand FensterSchliessenCommand
        {
            get { return _fensterSchliessenCommand; }
            set { _fensterSchliessenCommand = value; }
        }

        private void bestellpositionenListViewFuellen(ObservableCollection<BaseModel> bestellpositionen)
        {
            foreach (Bestellposition bp in bestellpositionen)
            {
                _bestellpositionen.Add(bp);
                _gesamtsumme += bp.Menge * bp.Preis;
            }
        }

        private void datenExportieren(object parameter)
        {
            string inhalt = dateiInhaltAufbereiten();
            SaveFileDialog sfd = new SaveFileDialog();
            sfd.FileName = "Bestellung"+ _bestellung.ID + "_"+ _bestellung.Datum.ToString("yyyy_MMM_dd_hh_mm") + "_" + _bestellung.MitarbeiterName;
            sfd.Filter = "Text File | *.txt";
            if (sfd.ShowDialog() == true)
            {
                File.WriteAllText(sfd.FileName, inhalt);
            }
        }
        private string dateiInhaltAufbereiten()
        {
            string inhalt = "";
            inhalt += "\n" + _titel;
            foreach (Bestellposition bp in _bestellpositionen)
            {
                inhalt += bp.ToString() + "\n";
            }
            inhalt += "Gesamtsumme der Bestellung: " + _gesamtsumme.ToString("C");
            return inhalt;
        }
        private void fensterSchließen(object fenster)
        {
            Window aktuellesFenster = fenster as Window;
            aktuellesFenster.Close();
        }
    }
}
