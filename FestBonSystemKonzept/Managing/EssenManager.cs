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
    public class EssenManager
    {
        private List<EssenEntity> essenEntities = new List<EssenEntity>();

        public List<Essen> GetEssen()
        {
            List<Essen> essenList = new List<Essen>();

            using (var context = new DataContext())
            {
                essenEntities = context.Set<EssenEntity>().ToList();
            }

            foreach(var item in essenEntities)
            {
                var essenItem = new Essen();

                essenItem.Id = item.Id;
                essenItem.Name = item.Name;
                essenItem.Preis= item.Preis;
                essenItem.Datum = item.Datum;
                essenItem.Portion = item.Portion;
                essenItem.Id_Bestand = item.Id_Bestand;

                essenList.Add(essenItem);
            }

            return essenList;
        }


    }
}
