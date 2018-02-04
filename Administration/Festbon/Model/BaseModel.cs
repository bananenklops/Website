namespace Festbon.Model
{
    public abstract class BaseModel
    {
        private int _id;

        public int ID { get { return _id; } set { _id = value; } }
    }
}
