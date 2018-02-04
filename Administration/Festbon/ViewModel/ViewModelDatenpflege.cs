using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.Windows;
using Festbon.Data;
using Festbon.Helper;
using Festbon.Model;
using Festbon.View;

namespace Festbon.ViewModel
{
    public class ViewModelDatenpflege : NotifyPropertyChanged
    {
        StartLogin _login;
        IDatenbankService _datenbankService;
        private SQLStatementProvider _sqlsp;
        private ModelValidator _validator;
        private ObservableCollection<BaseModel> _modelle;
        private string _ausgewaehltesModel;

        public ViewModelDatenpflege(string benutzername, string passwort)
        {
            _login = new StartLogin();
            _datenbankService = new DatenbankService(benutzername, passwort);
            _sqlsp = new SQLStatementProvider();
            _validator = new ModelValidator();

            _ausgewaehltesModel = "event";
            _modelle = _datenbankService.select(AusgewaehltesModel, _sqlsp.selectStatement(AusgewaehltesModel));

            HinzufuegenCommand = new RelayCommand(neuesModelHinzufuegen);
            SpeichernCommand = new RelayCommand(modelSpeichern);
            LoeschenCommand = new RelayCommand(modelLoeschen);
            MenueBearbeitenCommand = new RelayCommand(menueBearbeiten);
            StatistikCommand = new RelayCommand(oeffneStatistikFenster);
            BestellungsDetails = new RelayCommand(zeigeBestellungsdetails);

            EinheitsListe = new string[] { "Kilogramm", "Liter", "Stück" };
            ProduktArten = new string[] { "Trinken", "Essen" };
        }

        public RelayCommand HinzufuegenCommand { get; set; }
        public RelayCommand LoeschenCommand { get; set; }
        public RelayCommand MenueBearbeitenCommand { get; set; }
        public RelayCommand SpeichernCommand { get; set; }
        public RelayCommand StatistikCommand { get; set; }
        public RelayCommand BestellungsDetails { get; set; }

        public ObservableCollection<BaseModel> Modelliste
        {
            get { return _modelle; }
            set
            {
                _modelle = value;
                RaisePropertyChanged(nameof(Modelliste));
            }
        }
        public string AusgewaehltesModel
        {
            get { return _ausgewaehltesModel; }
            set
            {
                _ausgewaehltesModel = value;
                Modelliste = _datenbankService.select(_ausgewaehltesModel, _sqlsp.selectStatement(_ausgewaehltesModel));
                if (_ausgewaehltesModel.Equals("produkt"))
                {
                    BestandsListe = _datenbankService.select("bestand", _sqlsp.selectStatement("bestand"));
                }
                RaisePropertyChanged(nameof(AusgewaehltesModel));
            }
        }
        public ObservableCollection<BaseModel> BestandsListe { get; set; }

        private void neuesModelHinzufuegen(object parameter)
        {
            BaseModel model = ModelFactory.getModel(AusgewaehltesModel);
            Modelliste.Add(model);
        }
        private void modelSpeichern(object parameter)
        {
            BaseModel model = ModelFactory.getKonvertiertesModel(parameter);
            _validator.validiereModel(model);
            if (_validator.IstOK)
            {
                if (model.ID == 0)
                {
                    string insertStatement = _sqlsp.insertStatement(model);
                    _datenbankService.executeNonQuery(insertStatement);
                } else
                {
                    string updateStatement = _sqlsp.updateStatement(model);
                    _datenbankService.executeNonQuery(updateStatement);
                }
                    Modelliste = _datenbankService.select(_ausgewaehltesModel, _sqlsp.selectStatement(_ausgewaehltesModel));
            }
            else
            {
                MessageBox.Show(_validator.Fehlermeldung, "ungültige Eingaben", MessageBoxButton.OK, MessageBoxImage.Error);
            }
        }
        private void modelLoeschen(object parameter)
        {
            MessageBoxResult result = MessageBox.Show("Möchten Sie den ausgewählten Eintrag wirklich unwiderruflich löschen", 
                "Eintrag löschen", MessageBoxButton.YesNo, MessageBoxImage.Warning);

            if (result == MessageBoxResult.Yes)
            {
                BaseModel model = ModelFactory.getKonvertiertesModel(parameter);
                Modelliste.Remove(model);
                if (model.ID > 0)
                {
                    _datenbankService.executeNonQuery(_sqlsp.deleteStatement(model));
                }
            }
        }

        private void menueBearbeiten(object parameter)
        {
            Menue ausgewaehltesMenue = (Menue)parameter;
            MenueProduktliste menueProduktliste = new MenueProduktliste(ausgewaehltesMenue, _datenbankService);
            menueProduktliste.Show();

        }
        private void oeffneStatistikFenster(object parameter)
        {
            Event _event = (Event)parameter;
            Statistik statistik = new Statistik(_event, _datenbankService);
            statistik.Show();
        }
        private void zeigeBestellungsdetails(object obj)
        {
            Bestellung ausgewaehlteBestellung = (Bestellung)obj;
            string selectProdukte = _sqlsp.bestellpositioneenEinerBestellungStatement("produkt", ausgewaehlteBestellung.ID);
            ausgewaehlteBestellung.Produkte = _datenbankService.select("bestellungsposition", selectProdukte);
            string selectMenues = _sqlsp.bestellpositioneenEinerBestellungStatement("menue", ausgewaehlteBestellung.ID);
            ausgewaehlteBestellung.Menue = _datenbankService.select("bestellungsposition", selectMenues);
            Bestellungsdetails bestellungsdetails = new Bestellungsdetails(ausgewaehlteBestellung);
            bestellungsdetails.Show();
        }
        public string[] EinheitsListe { get; set; }
        public string[] ProduktArten { get; set; }
    }
}