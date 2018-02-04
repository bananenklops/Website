using Festbon.Data;
using Festbon.Model;
using Festbon.ViewModel;
using MahApps.Metro.Controls;

namespace Festbon.View
{
    public partial class Bestellungsdetails : MetroWindow
    {
        ViewModelBestellungsdetails viewModelBestellungsdetails;
        public Bestellungsdetails(Bestellung bestellung)
        {
            InitializeComponent();
            viewModelBestellungsdetails = new ViewModelBestellungsdetails(bestellung);
            DataContext = viewModelBestellungsdetails;
        }
    }
}
