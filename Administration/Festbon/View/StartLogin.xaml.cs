using System.Windows;
using Festbon.Data;
using MahApps.Metro.Controls;

namespace Festbon.View
{
    public partial class StartLogin : MetroWindow
    {
        private IDatenbankService _datenbankService;
    
        public StartLogin()
        {
            InitializeComponent();
        }

        private void anmeldenBtn_Click(object sender, System.Windows.RoutedEventArgs e)
        {
            _datenbankService = new DatenbankService(benutzernameTbx.Text, passwortTbx.Password.ToString());
            if (_datenbankService.OpenConnection() == true)
            {
                Datenpflege datenpflege = new Datenpflege(benutzernameTbx.Text, passwortTbx.Password.ToString());
                datenpflege.Show();
                _datenbankService.CloseConnection();
                this.Close();
            }
        }
    }
}