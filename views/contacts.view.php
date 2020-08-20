<?php include 'base.view.php' ?>

<?php startblock('styles') ?>
<style>
    .valid {
        border: 0;
        border-bottom: 5px solid rgb(31, 219, 31);
    }

    .invalid {
        border: 0;
        border-bottom: 5px solid rgb(255, 75, 75);
    }
</style>
<?php endblock() ?>

<?php startblock('content') ?>
<form name="contactform" onsubmit="validation()" action="mailto:n-klyshko@mail.ru" method="get" enctype="text/plain">
    <div class="field" id="field-fio">
        <label for="fio">Фамилия Имя Отчество</label>
        <input type="text" id="fio" name="fio">
        <div id="errorbox-fio"></div>
    </div>
    <div class="field" id="field-gender">
        <label>Пол</label>
        <div>
            <input type="radio" id="radio1" name="gender">
            <label for="radio1">мужской</label>
        </div>
        <div>
            <input type="radio" id="radio2" name="gender">
            <label for="radio2">женский</label>
        </div>
        <div id="errorbox-gender"></div>
    </div>
    <div class="field" id="field-dob">
        <label for="age">Возраст</label>
        <select id="age" name="age">
            <option disabled selected>Выберите возраст</option>
        </select>
        <div id="errorbox-age"></div>
    </div>
    <div class="field">
        <label for="dob">Дата рождения</label>
        <input type="text" id="dob" name="dob" autocomplete="off">
        <div class="calendar" id="calendar">
            <div class="calendar-header">
                <div>
                    <select id="calendar-month"></select>
                    <select id="calendar-year"></select>
                </div>
            </div>
            <table class="calendar-days">
                <tr>
                    <th>Su</th>
                    <th>Mo</th>
                    <th>Tu</th>
                    <th>We</th>
                    <th>Th</th>
                    <th>Fr</th>
                    <th>Sa</th>
                </tr>
                <tr id="week1"></tr>
                <tr id="week2"></tr>
                <tr id="week3"></tr>
                <tr id="week4"></tr>
                <tr id="week5"></tr>
                <tr id="week6"></tr>
            </table>
        </div>
        <div id="errorbox-dob"></div>
    </div>
    <div class="field">
        <label for="phone">Телефон</label>
        <input type="text" id="phone" name="phone">
        <div id="errorbox-phone"></div>
    </div>
    <div class="field">
        <label for="email">E-mail</label>
        <input type="text" id="email" name="email">
        <div id="errorbox-email"></div>
    </div>
    <textarea placeholder="Сообщение" name="message" id="message"></textarea>
    <div id="errorbox-message"></div>
    <p>
        <input disabled id="submitbtn" type="button" value="Отправить">
        <input type="reset" value="Очистить">
    </p>
</form>
<?php endblock() ?>

<?php startblock('dynamic') ?>
<div id="modal" class="modal-window">
    <div class="modal-dialog">
        <p>Confirm data send?</p>
        <div class="modal-footer">
            <div id="yes-btn" class="button">Yes</div>
            <div id="no-btn" class="button">No</div>
        </div>
    </div>
</div>
<?php endblock() ?>

<?php startblock('scripts') ?>
<script src="js/validation.js"></script>
<script src="js/calendar.js"></script>
<script src="js/popover.js"></script>
<script src="js/modal.js"></script>
<script>
  var ageSelect = document.getElementById("age")
  var form = document.forms['contactform']
  for (var i = 1; i <= 100; i++) {
    var option = document.createElement("option")
    option.value = i
    option.text = i
    ageSelect.appendChild(option)
  }

  function validateEmpty(value) {
    return !($.trim(value) == '')
  }

  function validateAge(value) {
    return !(value === "Выберите возраст")
  }

  function validateFIO(value) {
    var words = value.split(' ');
    return words.length == 3 && words.every((val, i, arr) => val.length > 0)
  }

  function validatePhone(value) {
    if (!(value.length >= 10 && value.length <= 12 && value[0] == '+' && (value[1] == '7' || value[1] == '3'))) {
      return false
    }
    for (var i = 2; i < value.length; i++) {
      if (value[i] < '0' || value[i] > '9') {
        return false
      }
    }
    return true
  }

  var validations = {
    "fio": [
      {
        message: "Не зполнено поле ФИО",
        validation: validateEmpty
      },
      {
        message: "Поле ФИО должно содержать три слова, разделенные одним пробелом",
        validation: validateFIO
      }
    ],
    "gender": [
      {
        message: "Не зполнено поле Пол",
        validation: validateEmpty
      }
    ],
    "age":[
      {
        message: "Не зполнено поле Возраст",
        validation: validateAge
      }
    ],
    "dob": [
      {
        message: "Дата рождения не заполнена",
        validation: (value) => { return parseDate(value) !== undefined}
      }
    ],
    "phone": [
      {
        message: "Неправильный формат телефона",
        validation: validatePhone
      }
    ],
    "email": [
      {
        message: "Не зполнено поле E-mail",
        validation: validateEmpty
      }
    ],
    "message": [
      {
        message: "Не зполнено поле Сообщение",
        validation: validateEmpty
      }
    ]
  }

  errorboxes = {}

  function setupValidation(validations) {
    updateSubmitState = (_) => {
      document.getElementById('submitbtn').disabled = !validateForm(form, validations, false)
    }
    fieldValidation = (event) => {
      var element = event.target
      var key = element.id
      var fieldValidations = validations[key]
      var errorbox = errorboxes[key]
      removePopover($(`#${key}`))
      for (var i = 0; i < fieldValidations.length; i++) {
        var validation = fieldValidations[i]
        if (validation.validation(element.value)) {
          element.classList.remove('invalid')
          element.classList.add('valid')
          errorbox.style.display = 'none'
        } else {
          errorbox.innerText = validation.message
          errorbox.style.display = 'block'
          element.classList.remove('valid')
          element.classList.add('invalid')
          setPopover($(`#${key}`), validation.message)
          break
        }
      }
      updateSubmitState()
    }
    for (var key in validations) {
      var element = document.getElementById(key)
      if (element !== null) {
        var errorbox = document.getElementById('errorbox-' + key)
        errorbox.classList.add('errorbox')
        errorbox.style.display = 'none'
        errorboxes[key] = errorbox
        element.addEventListener('keyup', fieldValidation, false)
        element.addEventListener('change', fieldValidation, false)
      }
    }
    document.getElementById('radio1').addEventListener('change', updateSubmitState, false)
    document.getElementById('radio2').addEventListener('change', updateSubmitState, false)
  }
  setupValidation(validations)

  $('#submitbtn').click(function() {
    showModal(
      () => {
        document.forms['contactform'].submit()
        closeModal()
      },
      () => {
        closeModal()
      }
    )
  })
</script>
<?php endblock() ?>

