
using System;
using System.Collections.ObjectModel;

namespace Festbon.Model
{
    public class Bestellung : BaseModel
    {
        private DateTime _datum;
        private int _mitarbeiterID;
        private string _mitarbeiterName;
        private int _eventID;
        private string _eventInfo;
        private ObservableCollection<BaseModel> _produkte;
        private ObservableCollection<BaseModel> _menues;

        public Bestellung()
        {
            _datum = DateTime.Now;
            _mitarbeiterID = 0;
            _mitarbeiterName = "Max Mustermann";
            _eventID = 0;
            _eventInfo = "Event in Musterort";
            _produkte = new ObservableCollection<BaseModel>();
            _menues = new ObservableCollection<BaseModel>();
        }

        public Bestellung(int id, DateTime datum, int mitarbeiterID, string mitarbeiterVorname, string mitarbeiterNachname, int eventID, string eventName, string eventOrt)
        {
            ID = id;
            _datum = datum;
            _mitarbeiterID = mitarbeiterID;
            _mitarbeiterName = mitarbeiterVorname + " " + mitarbeiterNachname;
            _eventID = eventID;
            _eventInfo = eventName + " in " + eventOrt;
        }

        public DateTime Datum { get { return _datum; } set { _datum = value; } }

        public int MitarbeiterID { get { return _mitarbeiterID; } set { _mitarbeiterID = value; } }

        public string MitarbeiterName { get { return _mitarbeiterName; } set { _mitarbeiterName = value; } }

        public int EventID { get { return _eventID; } set { _eventID = value; } }

        public string EventInfo { get { return _eventInfo; } set { _eventInfo = value; } }

        public ObservableCollection<BaseModel> Produkte { get { return _produkte; } set { _produkte = value; } }

        public ObservableCollection<BaseModel> Menue { get { return _menues; } set { _menues = value; } }
    }
}
