<?php include 'base.view.php' ?>

<?php startblock('content') ?>
<h2>Аутентификация</h2>
<form name="auth" action="/auth" method="POST">
    <?php renderErrors($model, 'login') ?>
    <div class="field">
        <label for="username">Имя пользователя</label>
        <?php renderErrors($model, 'username') ?>
        <input type="text" id="username" name="username" value="<?=keepValue($model, 'username')?>">
    </div>
    <div class="field">
        <label for="password">Пароль</label>
        <?php renderErrors($model, 'password') ?>
        <input type="password" id="password" name="password">
    </div>
    <p>
        <input id="submitbtn" type="submit" value="Войти">
    </p>
</form>
<?php endblock() ?>
