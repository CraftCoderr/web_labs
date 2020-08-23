<?php include 'base.view.php' ?>

<?php startblock('content') ?>
<?php if ($model['sent_success']) { ?>
    <div style="color: green; font-weight: bold;" >SUCCESSFULLY SENT</div>
<?php } ?>
<h2>Книга отзывов</h2>
<h3>Добавить отзыв</h3>
<form name="contactform" action="/feedback" method="POST">
    <div class="field">
        <label for="fio">Фамилия Имя Отчество</label>
        <?php renderErrors($model, 'fio') ?>
        <input type="text" id="fio" name="fio" value="<?=keepValue($model, 'fio')?>">
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

<table>
    <tr>
        <th>Дата</th>
        <th>ФИО</th>
        <th>E-mail</th>
        <th>Текст отзыва</th>
    </tr>
    <?php foreach ($model['data'] as $feedback) { ?>
        <tr>
            <td><?=$feedback['date']?></td>
            <td><?=$feedback['name']?></td>
            <td><?=$feedback['email']?></td>
            <td><?=$feedback['text']?></td>
        </tr>
    <?php } ?>
</table>
<?php endblock() ?>
