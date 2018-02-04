using System.Windows;
using System.Windows.Controls;
using Festbon.Model;

namespace Festbon.View
{
    public class ItemTemplateSelector : DataTemplateSelector
    {
        public override DataTemplate SelectTemplate(object item, DependencyObject container)
        {
            FrameworkElement element = container as FrameworkElement;

            if (element != null && item != null)
            {
                if (item.GetType() == typeof(Bestand))
                {
                    return element.FindResource("BestandTemplate") as DataTemplate;
                }
                else if (item.GetType() == typeof(Bestellung))
                {
                    return element.FindResource("BestellungTemplate") as DataTemplate;
                }
                else if (item.GetType() == typeof(Event))
                {
                    return element.FindResource("EventTemplate") as DataTemplate;
                }
                else if (item.GetType() == typeof(Produkt))
                {
                    return element.FindResource("ProduktTemplate") as DataTemplate;
                }
                else if (item.GetType() == typeof(Menue))
                {
                    return element.FindResource("MenueTemplate") as DataTemplate;
                }
                else if (item.GetType() == typeof(Mitarbeiter))
                {
                    return element.FindResource("MitarbeiterTemplate") as DataTemplate;
                }
            }
            return base.SelectTemplate(item, container);
        }
    }
}
