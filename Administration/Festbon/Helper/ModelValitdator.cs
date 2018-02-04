using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using Festbon.Model;

namespace Festbon.Helper
{
    public class ModelValidator
    {
        private bool _istOK = false;
        private string _fehlermeldung = "Folgende Eingaben sind ungültig:";

        public void validiereModel(BaseModel model)
        {
            ValidationContext context = new ValidationContext(model);
            List<ValidationResult> results = new List<ValidationResult>();
            _istOK = Validator.TryValidateObject(model, context, results, true);
            foreach (ValidationResult result in results)
            {
                _fehlermeldung += "\n" + result.ErrorMessage;
            }
        }

        public bool IstOK { get { return _istOK; } }
        public string Fehlermeldung { get { return _fehlermeldung; } }
    }
}
