using System;
using Festbon.Model;

namespace Festbon.Data
{
    public class ModelFactory
    {
        public static BaseModel getModel(string model)
        {
            switch (model)
            {
                case "bestand":
                    return new Bestand();
                case "bestellung":
                    return new Bestellung();
                case "produkt":
                    return new Produkt();
                case "event":
                    return new Event();
                case "menue":
                    return new Menue();
                case "mitarbeiter":
                    return new Mitarbeiter();
                case "menueprodukt":
                    return new MenueProdukt();
                default:
                    return null;
            }
        }

        public static BaseModel getInstanziiertesModel(string model, object[] values)
        {
            if ("bestand".Equals(model))
            {
                return new Bestand(Convert.ToInt32(values[0]), values[1].ToString(), values[2].ToString(), Convert.ToDouble(values[3]));
            }
            else if ("bestellung".Equals(model))
            {
                return new Bestellung(Convert.ToInt32(values[0]), DateTime.Parse(values[1].ToString()), Convert.ToInt32(values[2]), values[3].ToString(), values[4].ToString(), Convert.ToInt32(values[5]), values[6].ToString(), values[7].ToString());
            }
            else if ("event".Equals(model))
            {
                return new Event(Convert.ToInt16(values[0]), values[1].ToString(), values[2].ToString(), DateTime.Parse(values[3].ToString()), TimeSpan.Parse(values[4].ToString()), TimeSpan.Parse(values[5].ToString()), Convert.ToInt16(values[6]), Convert.ToInt16(values[7]));
            }
            else if ("produkt".Equals(model))
            {
                return new Produkt(
                    Convert.ToInt32(values[0]), 
                    values[1].ToString(), 
                    (Convert.ToDouble(values[2]) / 100.00), 
                    DateTime.Parse(values[3].ToString()), 
                    values[5].ToString(), 
                    (Convert.ToDouble(values[6])/1000), 
                    Convert.ToInt32(values[7]), 
                    Convert.ToInt32(values[8]), 
                    values[9].ToString(), 
                    Convert.ToDouble(values[11]), 
                    values[10].ToString());
            }
            else if ("menue".Equals(model))
            {
                return new Menue(Convert.ToInt16(values[0]), values[1].ToString(), values[2].ToString(), (Convert.ToDouble(values[3]) / 100.00), DateTime.Parse(values[4].ToString()), Convert.ToInt16(values[5]));
            }
            else if ("menueprodukt".Equals(model))
            {
                return new MenueProdukt(Convert.ToInt32(values[0]), Convert.ToInt32(values[1]), Convert.ToInt32(values[2]), values[3].ToString(), values[4].ToString());
            }
            else if ("bestellungsposition".Equals(model))
            {
                return new Bestellposition(Convert.ToInt16(values[0]), Convert.ToInt16(values[1]), Convert.ToInt16(values[2]), values[3].ToString(), (Convert.ToDouble(values[4]) / 100.00), values[5].ToString());
            }
            else
            {
                return new Mitarbeiter(Convert.ToInt16(values[0]), values[1].ToString(), values[2].ToString(), DateTime.Parse(values[3].ToString()), values[4].ToString(), Convert.ToInt16(values[5]));
            }
        }

        public static BaseModel getKonvertiertesModel(object parameter)

        {
            if (parameter.GetType() == typeof(Bestand))
            {
                Bestand bestand = (Bestand)parameter;
                return bestand;
            }
            else if (parameter.GetType() == typeof(Bestellung))
            {
                Bestellung bestellung = (Bestellung)parameter;
                return bestellung;
            }
            else if (parameter.GetType() == typeof(Event))
            {
                Event _event = (Event)parameter;
                return _event;
            }
            else if (parameter.GetType() == typeof(Produkt))
            {
                Produkt produkt = (Produkt)parameter;
                return produkt;
            }
            else if (parameter.GetType() == typeof(Menue))
            {
                Menue menue = (Menue)parameter;
                return menue;
            }
            else if (parameter.GetType() == typeof(MenueProdukt))
            {
                MenueProdukt menueProdukt = (MenueProdukt)parameter;
                return menueProdukt;
            }
            else if (parameter.GetType() == typeof(Bestellposition))
            {
                Bestellposition bestellungsposition = (Bestellposition)parameter;
                return bestellungsposition;
            }
            else
            {
                Mitarbeiter mitarbeiter = (Mitarbeiter)parameter;
                return mitarbeiter;
            }
        }
    }
}
