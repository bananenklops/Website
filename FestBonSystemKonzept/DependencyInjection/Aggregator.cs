using Ninject.Modules;

namespace DependencyInjection
{
    public class Aggregator
    {
        public NinjectModule[] GetMappings()
        {
            return new NinjectModule[] { new Mappings() };
        }
    }
}