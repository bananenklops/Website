using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.ComponentModel.DataAnnotations.Schema;
using System.Data.Entity.ModelConfiguration;
using Data;

namespace DataStoring.Repositories
{
    public class TrinkenMapping : EntityTypeConfiguration<TrinkenkEntity>
    {

        public TrinkenMapping()
        {
            this.ToTable("t_trinken");

            //Mappings der Spalten
            this.Property(p => p.Id).HasColumnName("id_trinken").HasDatabaseGeneratedOption(DatabaseGeneratedOption.Identity);
            this.Property(p => p.Name).HasColumnName("name_trinken");
            this.Property(p => p.Preis).HasColumnName("preis_trinken");
            this.Property(p => p.Datum).HasColumnName("datum_trinken");
            this.Property(p => p.Portion).HasColumnName("portion_trinken");
            this.Property(p => p.Id_Bestand).HasColumnName("id_bestand");
        }

    }
}
