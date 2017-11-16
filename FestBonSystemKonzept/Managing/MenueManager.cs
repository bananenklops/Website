using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using DataStoring.Contract;
using Data;

namespace Managing
{
    public class MenueManager
    {
        private IRepoFactory _repoFactory;
        private IRepository<EssenEntity> _repoMenue;
        private List<MenueEntity> bestellungList = new List<MenueEntity>();
    }
}
