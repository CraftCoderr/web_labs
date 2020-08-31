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

<?php startblock('scripts') ?>
<script>

  let input = document.getElementById('username')
  input.addEventListener('change', checkUsername, false)
  input.addEventListener('keyup', checkUsername, false)

  function checkUsername() {
    let username = input.value
    fetch('/register/check', {
      method: 'POST',
      headers: {
        'Accept': 'application/xml',
        'Content-Type': 'application/xml'
      },
      body: '<data username="' + username + '" />'
    })
    .then(response => response.text().then(xml => {
      let parser = new DOMParser();
      let xmlDoc = parser.parseFromString(xml, "text/xml");
      const result = xmlDoc.getElementsByTagName('check')[0].getAttribute('username');
      if (result === 'valid') {
        input.classList.remove('invalid');
        input.classList.add('valid');
      } else {
        input.classList.remove('valid');
        input.classList.add('invalid');
      }
    }))
    .catch(error => console.log(error));
  }
</script>
<?php endblock() ?>
