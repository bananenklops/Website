using System.Reflection;
using System.Data.Entity;
using Data;

namespace DataStoring.Contract
{
    public class DataContext : DbContext
    {
        public DataContext()
            : base("name=FestBonDb")
        {

        }

        protected override void OnModelCreating(DbModelBuilder modelBuilder)
        {
            modelBuilder.Configurations.AddFromAssembly(Assembly.GetExecutingAssembly());
            modelBuilder.Entity<EssenEntity>().ToTable("t_essen");
          

        }

    }

}
