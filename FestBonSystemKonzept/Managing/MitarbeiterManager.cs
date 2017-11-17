using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using DataStoring.Contract;
using Data;
using Managing.Contract;

namespace Managing
{
    public class MitarbeiterManager
    {
        private List<MitarbeiterEntity> mitarbeiterEntities = new List<MitarbeiterEntity>(); 

        public List<Mitarbeiter> GetMitarbeiter()
        {
            List<Mitarbeiter> mitarbeiterList = new List<Mitarbeiter>();

            using (var context = new DataContext())
            {
                mitarbeiterEntities = context.Set<MitarbeiterEntity>().ToList();
            }

            foreach (var item in mitarbeiterEntities)
            {
                var mitarbeiterItem = new Mitarbeiter();

                mitarbeiterItem.Id = item.Id;
                mitarbeiterItem.Nachname = item.Nachname;
                mitarbeiterItem.Vorname = item.Vorname;
                mitarbeiterItem.Geburtsdatum = item.Geburtsdatum;

                mitarbeiterList.Add(mitarbeiterItem);
            }

            return mitarbeiterList;
        }
    }
}
