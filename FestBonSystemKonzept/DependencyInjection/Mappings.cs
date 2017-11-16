using Ninject.Modules;
using Data;
using ProduktManaging;
using ProduktManaging.Contract;
using DataStoring;
using DataStoring.Contract;

namespace DependencyInjection
{
    public class Mappings : NinjectModule
    {
        public override void Load()
        {
            Bind<DataContext>().ToSelf().InSingletonScope();
            Bind<IRepoFactory>().To<RepoFactory>();
            // Bind<IAbrechnung>().To<Abrechnung>();
        }
    }
}
