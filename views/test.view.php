<?php include 'base.view.php' ?>

<?php startblock('content') ?>
<?php if ($model['passed']) { ?>
    <div style="color: green; font-weight: bold;" >TEST PASSED</div>
<?php } else { ?>
<h2>Тест по дисциплине "Теория вероятностей и математическая статистика"</h2>
<form name="testform" action="test" method="POST">
    <div>
        <label for="fio">Фамилия Имя Отчество</label>
        <?php renderErrors($model, 'fio') ?>
        <input type="text" id="fio" name="fio" value="<?=keepValue($model, 'fio')?>">
        <label for="group">Группа</label>
        <?php renderErrors($model, 'group') ?>
        <select id="group" name="group">
            <option selected><?=keepValue($model, 'group') ?: 'Выберите группу'?></option>
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
        <?php renderErrors($model, 'answer1') ?>
        <p>Мощность критерия – это:</p>
        <!--вероятность не допустить ошибку второго рода-->
        <textarea id="answer1" name="answer1"><?=keepValue($model, 'answer1')?></textarea>
    </div>
    <div class="question">
        <h4>Вопрос 2</h4>
        <?php renderErrors($model, 'answer2') ?>
        <p>Какие из названных распределений используются при проверке гипотезы о числовом значении математического ожидания при неизвестной дисперсии?</p>
        <div>
            <input type="radio" id="radio1" name="answer2" value="1" <?=keepCheckedValue($model, 'answer2', '1')?>>
            <label for="radio1">распределение Стьюдента</label>
        </div>
        <div>
            <input type="radio" id="radio2" name="answer2" value="2" <?=keepCheckedValue($model, 'answer2', '2')?>>
            <label for="radio2">распределение Фишера</label>
        </div>
        <div>
            <input type="radio" id="radio3" name="answer2" value="3" <?=keepCheckedValue($model, 'answer2', '3')?>>
            <label for="radio3">нормальное распределение</label>
        </div>
        <div>
            <input type="radio" id="radio4" name="answer2" value="4" <?=keepCheckedValue($model, 'answer2', '4')?>>
            <label for="radio4">распределение хи-квадрат</label>
        </div>
    </div>
    <div class="question">
        <h4>Вопрос 3</h4>
        <?php renderErrors($model, 'answer3') ?>
        <p>Какое из утверждений относительно генеральной и выборочной совокупностей является верным?</p>
        <select name="answer3">
            <option selected><?=keepValue($model, 'answer3') ?: 'Выберите ответ'?></option>
            <option>выборочная совокупность – часть генеральной</option>
            <option>генеральная совокупность – часть выборочной</option>
        </select>
    </div>
    <p>
        <input type="submit" value="Отправить">
        <input type="reset" value="Очистить">
    </p>
</form>
<?php } ?>
<?php endblock() ?>
