using System.Collections.ObjectModel;
using Festbon.Model;

namespace Festbon.Data
{
    public interface IDatenbankService
    {
        ObservableCollection<BaseModel> select(string tabelle, string sqlStatement);

        bool OpenConnection();
        bool CloseConnection();

        void executeNonQuery(string sqlStatement);
    }
}
