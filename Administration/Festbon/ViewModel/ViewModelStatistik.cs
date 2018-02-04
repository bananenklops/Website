using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.IO;
using Festbon.Data;
using Festbon.Helper;
using Festbon.Model;
using Microsoft.Win32;

namespace Festbon.ViewModel
{
    public class ViewModelStatistik : NotifyPropertyChanged
    {
        IDatenbankService _datenbankService;
        private SQLStatementProvider _sqlsp = new SQLStatementProvider();
        private StatistikGenerator _statistik;
        private RelayCommand _datenExport;

        public ViewModelStatistik(Event _event, IDatenbankService datenbankService)
        {
            _datenbankService = datenbankService;
            _datenExport = new RelayCommand(datenExportieren);
            ObservableCollection<BaseModel> bestellungen = getBestellungenVomEvent(_event.ID);
            _statistik = new StatistikGenerator(bestellungen);
        }

        public StatistikGenerator Statistik { get { return _statistik; } set { _statistik = value; } }
        private ObservableCollection<BaseModel> getBestellungenVomEvent(int eventID)
        {
            ObservableCollection<BaseModel> bestellungen = _datenbankService.select("bestellung", _sqlsp.bestellungenBeiEinemEventStatement(eventID));
            foreach (Bestellung bestellung in bestellungen)
            {
                bestellung.Produkte = _datenbankService.select("bestellungsposition", _sqlsp.bestellpositioneenEinerBestellungStatement("produkt", bestellung.ID));
                bestellung.Menue = _datenbankService.select("bestellungsposition", _sqlsp.bestellpositioneenEinerBestellungStatement("menue", bestellung.ID));
            }

            return bestellungen;
        }

        public RelayCommand DatenExport { get { return _datenExport; } set { _datenExport = value; } }
        private void datenExportieren(object parameter)
        {
            string essen = datenFuerExportAufbereiten(_statistik.Essen);
            string trinken = datenFuerExportAufbereiten(_statistik.Trinken);
            string menue = datenFuerExportAufbereiten(_statistik.Menue);
            string gesamt = "Verkauf von Essen" + "\n" + essen + "\n"
                          + "\nVerkauf von Getränken" + "\n" + trinken + "\n"
                          + "\nVerkauf von Menüs" + "\n" + menue + "\n";
            SaveFileDialog sfd = new SaveFileDialog();
            sfd.Filter = "Text File | *.txt";
            if (sfd.ShowDialog() == true)
            {
                File.WriteAllText(sfd.FileName, gesamt);
            }
        }
        private string datenFuerExportAufbereiten(List<StatistikElement> umsatzliste)
        {
            string inhalt = "";
            foreach (StatistikElement eintrag in umsatzliste)
            {
                inhalt += eintrag.Name + ", Verkaufsmenge: " + eintrag.Menge + ", erzielter Umsatz: " + eintrag.Umsatzsumme + "\n";
            }
            return inhalt;
        }
    }
}

