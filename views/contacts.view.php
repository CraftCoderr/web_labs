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
<?php if ($model['sent_success']) {?>
    <div style="color: green; font-weight: bold;" >SUCCESSFULLY SENT</div>
<?php } ?>
<form name="contactform" action="/contacts" method="POST">
    <div class="field">
        <label for="fio">Фамилия Имя Отчество</label>
        <?php renderErrors($model, 'fio') ?>
        <input type="text" id="fio" name="fio" value="<?=keepValue($model, 'fio')?>">
    </div>
    <div class="field">
        <label>Пол</label>
        <?php renderErrors($model, 'gender') ?>
        <div>
            <input type="radio" id="radio1" name="gender" value="male" <?=keepCheckedValue($model, 'gender', 'male')?>>
            <label for="radio1">мужской</label>
        </div>
        <div>
            <input type="radio" id="radio2" name="gender" value="female" <?=keepCheckedValue($model, 'gender', 'female')?>>
            <label for="radio2">женский</label>
        </div>
    </div>
    <div class="field">
        <label for="age">Возраст</label>
        <?php renderErrors($model, 'age') ?>
        <select id="age" name="age">
            <option selected><?=keepValue($model, 'age') ?: 'Выберите возраст'?></option>
        </select>
    </div>
    <div class="field">
        <label for="dob">Дата рождения</label>
        <?php renderErrors($model, 'dob') ?>
        <input type="text" id="dob" name="dob" autocomplete="off" value="<?=keepValue($model, 'dob')?>">
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
    </div>
    <div class="field">
        <label for="phone">Телефон</label>
        <?php renderErrors($model, 'phone') ?>
        <input type="text" id="phone" name="phone" value="<?=keepValue($model, 'phone')?>">
    </div>
    <div class="field">
        <label for="email">E-mail</label>
        <?php renderErrors($model, 'email') ?>
        <input type="text" id="email" name="email" value="<?=keepValue($model, 'email')?>">
    </div>
    <label for="message">Сообщение</label>
    <?php renderErrors($model, 'message') ?>
    <textarea placeholder="Сообщение" name="message" id="message"><?=keepValue($model, 'message')?></textarea>
    <p>
        <input id="submitbtn" type="submit" value="Отправить">
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
</script>
<?php endblock() ?>

