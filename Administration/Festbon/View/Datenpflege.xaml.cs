using System.Collections.Generic;
using System.Windows;
using Festbon.ViewModel;
using MahApps.Metro.Controls;

namespace Festbon.View
{
    public partial class Datenpflege : MetroWindow
    {
        ViewModelDatenpflege viewmodelDatenpflege;
        public Datenpflege(string benutzername, string passwort)
        {
            InitializeComponent();
            modelAuswahlCbx.ItemsSource = modelCbxFuellen();
            viewmodelDatenpflege = new ViewModelDatenpflege(benutzername, passwort);
            DataContext = viewmodelDatenpflege;
        }

        private void HauptfensterSchliessen(object sender, System.EventArgs e)
        {
            Application.Current.Shutdown();
        }

        private List<KeyValuePair<string, string>> modelCbxFuellen()
        {
            List<KeyValuePair<string, string>> keyValueListe = new List<KeyValuePair<string, string>>();
            keyValueListe.Add(new KeyValuePair<string, string>("Bestand", "bestand"));
            keyValueListe.Add(new KeyValuePair<string, string>("Produkt", "produkt"));
            keyValueListe.Add(new KeyValuePair<string, string>("Menü", "menue"));
            keyValueListe.Add(new KeyValuePair<string, string>("Event", "event"));
            keyValueListe.Add(new KeyValuePair<string, string>("Bestellung", "bestellung"));
            keyValueListe.Add(new KeyValuePair<string, string>("Mitarbeiter", "mitarbeiter"));
            return keyValueListe;
        }
    }
}
