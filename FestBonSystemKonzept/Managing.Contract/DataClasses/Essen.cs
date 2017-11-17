using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Managing.Contract
{
    public class Essen
    {
        private int id;

        private string name;

        private double preis;

        private DateTime datum;

        private double portion;

        private double id_Bestand;

        public int Id
        {
            get
            {
                return id;
            }

            set
            {
                id = value;
            }
        }

        public string Name
        {
            get
            {
                return name;
            }

            set
            {
                name = value;
            }
        }

        public double Preis
        {
            get
            {
                return preis;
            }

            set
            {
                preis = value;
            }
        }

        public DateTime Datum
        {
            get
            {
                return datum;
            }

            set
            {
                datum = value;
            }
        }

        public double Portion
        {
            get
            {
                return portion;
            }

            set
            {
                portion = value;
            }
        }

        public double Id_Bestand
        {
            get
            {
                return id_Bestand;
            }

            set
            {
                id_Bestand = value;
            }
        }
               
    }
}
