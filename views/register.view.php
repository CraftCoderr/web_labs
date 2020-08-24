<?php include 'base.view.php' ?>

<?php startblock('content') ?>
<h2>Регистрация</h2>
<form name="register" action="/register" method="POST">
    <?php renderErrors($model, 'register') ?>
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
        <input id="submitbtn" type="submit" value="Зарегистирироваться">
    </p>
</form>
<?php endblock() ?>
