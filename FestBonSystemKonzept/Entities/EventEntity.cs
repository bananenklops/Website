using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Data
{
   public class EventEntity
    {
       public int ID { get; set; }

       public string Name { get; set; }

       public string Ort { get; set; }

       public DateTime Datum { get; set; }

       public int Dauer { get; set; }
    }
}
