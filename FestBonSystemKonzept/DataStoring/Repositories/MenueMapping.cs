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
    public class MenueMapping : EntityTypeConfiguration<MenueEntity>
    {
        public MenueMapping()
        {
            this.ToTable("t_menue");
                
             //Mappings der Spalten
            this.Property(p => p.Id).HasColumnName("id_menue").HasDatabaseGeneratedOption(DatabaseGeneratedOption.Identity);
            this.Property(p => p.Name).HasColumnName("name_menue");
            this.Property(p => p.Beschreibung).HasColumnName("bescheibung_menue");
            this.Property(p => p.Rabatt).HasColumnName("rabatt_menue");
            this.Property(p => p.Datum).HasColumnName("datum_menue");
        }
       
    }
}
