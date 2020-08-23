<?php include 'base.view.php' ?>

<?php startblock('content') ?>
<?php if (array_key_exists('upload_success', $model)) { ?>
    <?php if ($model['upload_success']) { ?>
        <div style="color: green; font-weight: bold;" >UPLOADED SUCCESSFULLY</div>
    <?php } else { ?>
        <div style="color: darkred; font-weight: bold;" >UPLOAD FAILED</div>
    <?php } ?>
<?php }?>
<h2>Загрузка книги отзывов</h2>
<form name="upload" action="/feedback/upload" method="POST" enctype="multipart/form-data">
    <div class="field">
        <label for="messages">Файл messages.inc</label>
        <input type="file" id="messages" name="messages">
    </div>
    <p>
        <input id="submitbtn" type="submit" value="Отправить">
        <input type="reset" value="Очистить">
    </p>
</form>
<?php endblock() ?>
