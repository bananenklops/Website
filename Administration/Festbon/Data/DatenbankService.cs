using System;
using System.Collections.ObjectModel;
using System.Windows;
using Festbon.Model;
using MySql.Data.MySqlClient;

namespace Festbon.Data
{
    public class DatenbankService : IDatenbankService
    {
        private string _server;
        private string _datenbank;
        private string _benutzername;
        private string _passwort;
        private MySqlConnection _connection;
        private MySqlCommand _command;

        public DatenbankService(string benutzername, string passwort)
        {
            _server = "SERVER=localhost;";
            _datenbank = "DATABASE=festbon;";
            _benutzername = "UID="+ benutzername + ";";
            _passwort = "PASSWORD=" + passwort + ";";
            _connection = new MySqlConnection(_server + _datenbank + _benutzername + _passwort);
        }

        public bool OpenConnection()
        {
            try
            {
                _connection.Open();
                return true;
            }
            catch (MySqlException ex)
            {
                MessageBox.Show("Verbindung konnte nicht hergestellt werden\n" + ex.ToString());
                return false;
            }
        }

        public bool CloseConnection()
        {
            try
            {
                _connection.Close();
                return true;
            }
            catch (MySqlException ex)
            {
                MessageBox.Show(ex.Message);
                return false;
            }
        }

        public ObservableCollection<BaseModel> select(string tabelle, string selectAllSQLStatement)
        {
            ObservableCollection<BaseModel> ergebnisse = new ObservableCollection<BaseModel>();
            if (OpenConnection() == true)
            {
                ergebnisse = getEntitylist(tabelle, selectAllSQLStatement);
            }
            CloseConnection();
            return ergebnisse;
        }
        private ObservableCollection<BaseModel> getEntitylist(string tabelle, string sqlStatement)
        {
            ObservableCollection<BaseModel> resultate = new ObservableCollection<BaseModel>();
            _command = new MySqlCommand(sqlStatement, _connection);
            MySqlDataReader reader = _command.ExecuteReader();
            while (reader.Read())
            {
                Object[] values = new Object[reader.FieldCount];
                int fieldCount = reader.GetValues(values);
                BaseModel entity = ModelFactory.getInstanziiertesModel(tabelle, values);
                resultate.Add(entity);
            }
            return resultate;
        }
        public void executeNonQuery(string sqlStatement)
        {
            if (OpenConnection() == true)
            {
                execute(sqlStatement);
            }
        }
        private void execute(string sqlStatement)
        {
            _command = new MySqlCommand(sqlStatement, _connection);
            _command.ExecuteNonQuery();
            CloseConnection();
        }
    }
}
