using Festbon.Data;
using Festbon.Model;
using Festbon.ViewModel;
using MahApps.Metro.Controls;

namespace Festbon.View
{
    public partial class MenueProduktliste : MetroWindow
    {
        ViewModelMenueProduktliste menueProduktlisteViewModel;
        public MenueProduktliste(Menue menue, IDatenbankService _datenbankService)
        {
            InitializeComponent();
            menueProduktlisteViewModel = new ViewModelMenueProduktliste(menue, _datenbankService);
            DataContext = menueProduktlisteViewModel;
        }
    }
}
