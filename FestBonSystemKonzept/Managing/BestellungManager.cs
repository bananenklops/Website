using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using DataStoring.Contract;
using Data;

namespace Managing
{
    public class BestellungManager
    {
        private IRepoFactory _repoFactory;
        private IRepository<BestellungEntity> _repoBestellung;
        private List<BestellungEntity> bestellungList = new List<BestellungEntity>();
    }
}
