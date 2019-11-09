function validateForm(form, validations, showalert) {
  for (var key in validations) {
    var input = form[key]
    var fieldValidations = validations[key]
    for (var i = 0; i < fieldValidations.length; i++) {
      var validation = fieldValidations[i]
      if (!validation.validation(input.value)) {
        if (showalert) {
          window.alert(validation.message)
          if (!(input instanceof RadioNodeList)) {
            input.focus()
          }
        }
        return false
      }
    }
  }
  return true
}