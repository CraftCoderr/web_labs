<?php include 'base.view.php' ?>

<?php startblock('content') ?>
<h2>Blog posts</h2>
<?php foreach ($model['posts'] as $post) { ?>
    <div class="post">
        <h3><?=$post['title']?></h3>
        <h6><?=$post['date']?></h6>
        <?php if ($post['image'] != null) { ?>
            <img src="/uploaded/<?=$post['image']?>">
        <?php } ?>
        <p><?=$post['text']?></p>
    </div>
<?php } ?>
<?php endblock() ?>
