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
    public class MitarbeiterMapping : EntityTypeConfiguration<MitarbeiterEntity>
    {
        public MitarbeiterMapping()
        {
            this.ToTable("t_mitarbeiter");

            //Mappings der Spalten
            this.Property(p => p.Id).HasColumnName("id_mitarbeiter").HasDatabaseGeneratedOption(DatabaseGeneratedOption.Identity);
            this.Property(p => p.Nachname).HasColumnName("vorname_mitarbeiter");
            this.Property(p => p.Vorname).HasColumnName("nachname_mitarbeiter");
            this.Property(p => p.Geburtsdatum).HasColumnName("geburtsdatum_mitarbeiter");            
        }
    }
}
