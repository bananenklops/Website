using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Data
{
   public class MitarbeiterEntity
    {
       public int Id { get;set; }
       public string Nachname { get; set; }
       public string Vorname { get; set; }
       public DateTime Geburtsdatum { get; set; }

    }
}
