using System.Collections.ObjectModel;
using System.Windows;
using Festbon.Data;
using Festbon.Helper;
using Festbon.Model;

namespace Festbon.ViewModel
{
    public class ViewModelMenueProduktliste : NotifyPropertyChanged
    {
        IDatenbankService _datenbankService;
        private SQLStatementProvider _sqlsp = new SQLStatementProvider();
        private ObservableCollection<BaseModel> _alleProdukte;
        private ObservableCollection<BaseModel> _produktliste;
        private RelayCommand _speichernCommand;
        private RelayCommand _loeschCommand;
        private RelayCommand _fensterSchliessenCommand;

        public ViewModelMenueProduktliste(Menue menue, IDatenbankService datenbankService)

        {
            Menue = menue;
            _datenbankService = datenbankService;
            MengenAuswahl = mengenCbxFuellen();
            Menge = MengenAuswahl[0];
            _produktliste = _datenbankService.select("menueprodukt", _sqlsp.menueproduktStatement(Menue.ID));
            _alleProdukte = _datenbankService.select("produkt", _sqlsp.selectStatement("produkt"));
            ausgewaehltesProdukt = (_alleProdukte.Count > 0) ? _alleProdukte[0] : null;
            _speichernCommand = new RelayCommand(speichern);
            _loeschCommand = new RelayCommand(loeschen);
            _fensterSchliessenCommand = new RelayCommand(fensterSchließen);
        }

        public ObservableCollection<Model.BaseModel> AlleProdukte
        {
            get { return _alleProdukte; }
            set
            {
                _alleProdukte = value;
                RaisePropertyChanged(nameof(AlleProdukte));
            }
        }

        public ObservableCollection<BaseModel> Produktliste
        {
            get { return _produktliste; }
            set
            {
                _produktliste = value;
                RaisePropertyChanged(nameof(Produktliste));
            }
        }

        public RelayCommand SpeichernCommand { get { return _speichernCommand; } set { _speichernCommand = value; } }

        public RelayCommand LoeschenCommand { get { return _loeschCommand; } set { _loeschCommand = value; } }

        public RelayCommand FensterSchliessen { get { return _fensterSchliessenCommand; } set { _fensterSchliessenCommand = value; } }

        public int[] MengenAuswahl { get; set; }

        public int Menge { get; set; }

        public Menue Menue { get; set; }

        public BaseModel ausgewaehltesProdukt { get; set; }


        private void speichern(object parameter)
        {
            if (ausgewaehltesProdukt != null)
            {
                Produkt p = (Produkt)ausgewaehltesProdukt;
                MenueProdukt mp = new MenueProdukt(Menue.ID, p.ID, Menge, p.Name, p.Art);
                Produktliste.Add(mp);
                string insert = _sqlsp.insertStatement(mp);
                _datenbankService.executeNonQuery(insert);
            }
            else
            {
                MessageBox.Show("kein Produkt ausgewählt", "ungültige Eingaben", MessageBoxButton.OK, MessageBoxImage.Error);
            }
        }

        private void loeschen(object parameter)
        {
            MessageBoxResult result = MessageBox.Show("Möchten Sie den ausgewählten Eintrag wirklich unwiderruflich löschen", "Eintrag löschen", MessageBoxButton.YesNo, MessageBoxImage.Warning);

            if (result == MessageBoxResult.Yes)
            {
                MenueProdukt mp = (MenueProdukt)parameter;
                if (ausgewaehltesProdukt != null)
                {
                    Produktliste.Remove(mp);
                    string delete = _sqlsp.deleteStatement(mp);
                    _datenbankService.executeNonQuery(delete);
                }
            }
        }

        private void fensterSchließen(object fenster)
        {
            Window aktuellesFenster = fenster as Window;
            aktuellesFenster.Close();
        }

        private int[] mengenCbxFuellen()
        {
            int[] mengenauswahl = new int[20];
            for (int i = 0; i < mengenauswahl.Length; i++)
            {
                mengenauswahl[i] = i + 1;
            }
            return mengenauswahl;
        }
    }
}
