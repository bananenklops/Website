using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Managing.Contract
{
    public class Mitarbeiter
    {
        private int id;
        private string nachname;
        private string vorname;
        private DateTime geburtsdatum;

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

        public string Nachname
        {
            get
            {
                return nachname;
            }

            set
            {
                nachname = value;
            }
        }

        public string Vorname
        {
            get
            {
                return vorname;
            }

            set
            {
                vorname = value;
            }
        }

        public DateTime Geburtsdatum
        {
            get
            {
                return geburtsdatum;
            }

            set
            {
                geburtsdatum = value;
            }
        }
    }
}
