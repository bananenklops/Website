using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Data
{
    public class BestellungEntity
    {
        public int ID { get; set; }
        public DateTime Datum { get; set; }
        public int MitarbeiterID { get; set; }
        public int EventID { get; set; }
    }
}
