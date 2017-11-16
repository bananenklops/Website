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
    public class EssenMapping : EntityTypeConfiguration<EssenEntity>
    {
          
        public EssenMapping()
        {
            this.ToTable("t_essen");

            //Mappings der Spalten
            this.Property(p => p.Id).HasColumnName("id_essen").HasDatabaseGeneratedOption(DatabaseGeneratedOption.Identity);
            this.Property(p => p.Name).HasColumnName("name_essen");
            this.Property(p => p.Preis).HasColumnName("preis_essen");
            this.Property(p => p.Datum).HasColumnName("datum_essen");
            this.Property(p => p.Portion).HasColumnName("portion_essen");
            this.Property(p => p.Id_Bestand).HasColumnName("id_bestand");
        }

    }
}
