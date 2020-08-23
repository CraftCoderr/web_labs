<?php include 'base.view.php' ?>

<?php startblock('content') ?>
<?php if ($model['post_success']) { ?>
    <div style="color: green; font-weight: bold;" >SUCCESSFULLY POSTED</div>
<?php } ?>
<h2>Создать пост</h2>
<form name="new_post" action="/blog/post" method="POST" enctype="multipart/form-data">
    <div class="field">
        <label for="title">Заголовок</label>
        <?php renderErrors($model, 'title') ?>
        <input type="text" id="title" name="title" value="<?=keepValue($model, 'title')?>">
    </div>
    <label for="text">Сообщение</label>
    <?php renderErrors($model, 'text') ?>
    <textarea placeholder="Текст" name="text" id="text"><?=keepValue($model, 'text')?></textarea>
    <div class="field">
        <label for="image">Изображение</label>
        <input type="file" id="image" name="image">
    </div>
    <p>
        <input id="submitbtn" type="submit" value="Отправить">
        <input type="reset" value="Очистить">
    </p>
</form>

<h2>Импортировать</h2>
<?php if ($model['import_success']) { ?>
    <div style="color: green; font-weight: bold;" >SUCCESSFULLY IMPORTED</div>
<?php } ?>
<form name="import_posts" action="/blog/import" method="POST" enctype="multipart/form-data">
    <div class="field">
        <label for="posts">Посты в формате .csv</label>
        <input type="file" id="posts" name="posts">
    </div>
    <p>
        <input id="submitbtn" type="submit" value="Отправить">
        <input type="reset" value="Очистить">
    </p>
</form>

<?php endblock() ?>
