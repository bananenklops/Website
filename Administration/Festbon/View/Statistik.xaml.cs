using Festbon.Data;
using Festbon.Model;
using Festbon.ViewModel;
using MahApps.Metro.Controls;

namespace Festbon.View
{
    public partial class Statistik : MetroWindow
    {
        ViewModelStatistik viewModelStatistik;
        public Statistik(Event _event, IDatenbankService _datenbankService)
        {
            InitializeComponent();
            viewModelStatistik = new ViewModelStatistik(_event, _datenbankService);
            DataContext = viewModelStatistik;
        }
    }
}