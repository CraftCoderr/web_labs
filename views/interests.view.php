<?php include 'base.view.php' ?>

<?php startblock('content') ?>
<h2 id="title">Interests</h2>
<div id="categorylist">
    <ol>
    </ol>
</div>

<div id="categories">
    <div class="category">
        <a id="hobby"></a>
        <h3>Hobby</h3>
        <img src="img/hobby.jpg" alt="I'm in the cave.">
    </div>
    <div class="category">
        <a id="book"></a>
        <h3>Book</h3>
        <img src="img/book.jpg" alt="Kent Beck. Test Driven Development. Book.">
    </div>
    <div class="category">
        <a id="music"></a>
        <h3>Music</h3>
        <img src="img/music.jpg" alt="Mashina Vremeni. Musical group.">
    </div>
    <div class="category">
        <a id="film"></a>
        <h3>Film</h3>
        <img src="img/film.jpg" alt="The Hitman's Bodyguard. Film.">
    </div>
</div>
<?php endblock() ?>

<?php startblock('scripts') ?>
<script src="js/interests.js"></script>
<script>
  function categories() {
    var argc = arguments.length
    var ul = document.getElementById('categorylist').children[0]
    for (var i = 0; i < argc; i++) {
      var li = document.createElement('li')
      li.className = 'categorylink'
      li.innerHTML = `<a href="#${arguments[i]}">${arguments[i].toUpperCase()}</a>`
      ul.appendChild(li)
    }
  }
  categories('hobby', 'book', 'music', 'film')
</script>
<?php endblock() ?>
