using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Data
{
    public class EssenEntity
    {
        public int Id { get; set; }

        public string Name { get; set; }

        public double Preis { get; set; }

        public DateTime Datum{ get; set; }

        public double Portion { get; set; }

        public double Id_Bestand { get; set; }
        }
}
