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
    public class TrinkenManager
    {
        private List<TrinkenEntity> trinkenEntities = new List<TrinkenEntity>();

        public List<Trinken> GetTrinken()
        {
            List<Trinken> trinkenList = new List<Trinken>();

            using (var context = new DataContext())
            {
                trinkenEntities = context.Set<TrinkenEntity>().ToList();
            }

            foreach (var item in trinkenEntities)
            {
                var trinkenItem = new Trinken();

                trinkenItem.Id = item.Id;
                trinkenItem.Name = item.Name;
                trinkenItem.Preis = item.Preis;
                trinkenItem.Datum = item.Datum;
                trinkenItem.Portion = item.Portion;
                trinkenItem.Id_Bestand = item.Id_Bestand;

                trinkenList.Add(trinkenItem);
            }

            return trinkenList;
        }
    }
}
