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
    public class EventMapping : EntityTypeConfiguration<EventEntity>
    {
        public EventMapping()
        {
            this.ToTable("t_event");

            this.Property(p => p.ID).HasColumnName("id_event").HasDatabaseGeneratedOption(DatabaseGeneratedOption.Identity);
            this.Property(p => p.Name).HasColumnName("neme_event");
            this.Property(p => p.Ort).HasColumnName("ort_event");
            this.Property(p => p.Datum).HasColumnName("datum_event");
            this.Property(p => p.Dauer).HasColumnName("dauer_event");
        }
    }
}
