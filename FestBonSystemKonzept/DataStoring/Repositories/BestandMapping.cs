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
    public class BestandMapping : EntityTypeConfiguration<BestandEntitý>
    {
        public BestandMapping()
        {
            this.ToTable("t_bestand");

            this.Property(p => p.ID).HasColumnName("id_bestand").HasDatabaseGeneratedOption(DatabaseGeneratedOption.Identity);
            this.Property(p => p.Name).HasColumnName("name_bestand");
            this.Property(p => p.Einheit).HasColumnName("einheit_bestand");
            this.Property(p => p.Menge).HasColumnName("menge_bestand");
        }
    }
}





