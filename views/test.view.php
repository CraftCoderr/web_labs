<?php include 'base.view.php' ?>

<?php startblock('content') ?>
<h2>Тест по дисциплине "Теория вероятностей и математическая статистика"</h2>
<form name="testform" action="mailto:n-klyshko@mail.ru" onsubmit="validation()" method="get" enctype="text/plain">
    <div>
        <label for="fio">Фамилия Имя Отчество</label>
        <input type="text" id="fio" name="fio">
        <label for="group">Группа</label>
        <select id="group" name="group">
            <option disabled selected>Выберите группу</option>
            <optgroup label="1 курс">
                <option>ИС-11</option>
                <option>ИС-12</option>
            </optgroup>
            <optgroup label="2 курс">
                <option>ИС-21</option>
                <option>ИС-22</option>
            </optgroup>
            <optgroup label="3 курс">
                <option>ИС-31</option>
                <option>ИС-32</option>
            </optgroup>
            <optgroup label="4 курс">
                <option>ИС-41</option>
                <option>ИС-42</option>
            </optgroup>
        </select>
    </div>
    <div class="question">
        <h4>Вопрос 1</h4>
        <p>Мощность критерия – это:</p>
        <!--вероятность не допустить ошибку второго рода-->
        <textarea id="answer1" name="answer1"></textarea>
    </div>
    <div class="question">
        <h4>Вопрос 2</h4>
        <p>Какие из названных распределений используются при проверке гипотезы о числовом значении математического ожидания при неизвестной дисперсии?</p>
        <div>
            <input type="radio" id="radio1" name="answer2" value="1">
            <label for="radio1">распределение Стьюдента</label>
        </div>
        <div>
            <input type="radio" id="radio2" name="answer2" value="2">
            <label for="radio2">распределение Фишера</label>
        </div>
        <div>
            <input type="radio" id="radio3" name="answer2" value="3">
            <label for="radio3">нормальное распределение</label>
        </div>
        <div>
            <input type="radio" id="radio4" name="answer2" value="4">
            <label for="radio4">распределение хи-квадрат</label>
        </div>
    </div>
    <div class="question">
        <h4>Вопрос 3</h4>
        <p>Какое из утверждений относительно генеральной и выборочной совокупностей является верным?</p>
        <select name="answer3">
            <option disabled selected>Выберите ответ</option>
            <option>выборочная совокупность – часть генеральной</option>
            <option>генеральная совокупность – часть выборочной</option>
        </select>
    </div>
    <p>
        <input type="submit" value="Отправить">
        <input type="reset" value="Очистить">
    </p>
</form>
<?php endblock() ?>

<?php startblock('scripts') ?>
<script src="js/validation.js"></script>
<script>
  function validateEmpty(value) {
    return !($.trim(value) == '');
  }

  function validateGroup(value) {
    return !(value === "Выберите группу")
  }

  function validateEmptyAnswer3(value) {
    return !(value === "Выберите ответ")
  }

  function validateFIO(value) {
    var words = value.split(' ');
    return words.length == 3 && words.every((val, i, arr) => val.length > 0);
  }

  function validateAnswer1(value) {
    return value == 'вероятность не допустить ошибку второго рода';
  }

  function validateAnswer2(value) {
    return value == 1;
  }

  function validateAnswer3(value) {
    return value == 'выборочная совокупность – часть генеральной';
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
    "group": [
      {
        message: "Не заполнено поле Группа",
        validation: validateGroup
      }
    ],
    "answer1": [
      {
        message: "Не заполнен Вопрос 1",
        validation: validateEmpty
      },
      {
        message: "Неправильный ответ на Вопрос 1",
        validation: validateAnswer1
      }
    ],
    "answer2": [
      {
        message: "Не заполнен Вопрос 2",
        validation: validateEmpty
      },
      {
        message: "Неправильный ответ на Вопрос 2",
        validation: validateAnswer2
      }
    ],
    "answer3": [
      {
        message: "Не заполнен Вопрос 3",
        validation: validateEmptyAnswer3
      },
      {
        message: "Неправильный ответ на Вопрос 3",
        validation: validateAnswer3
      }
    ]
  }

  var form = document.forms["testform"];
  function validation() {
    validateForm(form, validations);
  }
</script>
<?php endblock() ?>