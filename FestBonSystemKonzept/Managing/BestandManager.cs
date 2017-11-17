using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using DataStoring.Contract;
using Data;

namespace Managing
{
    public class BestandManager
    {
        private IRepoFactory _repoFactory;
        private IRepository<BestandEntitý> _repoBestand;
        private List<BestandEntitý> bestandList = new List<BestandEntitý>();
    }
}
