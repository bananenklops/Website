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
    public class BestellungMapping : EntityTypeConfiguration<BestellungEntity>
    {
        public BestellungMapping()
        {
            this.ToTable("t_bestellung");

            this.Property(p => p.ID ).HasColumnName("id_bestellung").HasDatabaseGeneratedOption(DatabaseGeneratedOption.Identity);
            this.Property(p => p.Datum).HasColumnName("datum_bestellung");
            this.Property(p => p.MitarbeiterID).HasColumnName("id_mitarbeiter");
            this.Property(p => p.EventID).HasColumnName("id_event");
        }
    }
}
