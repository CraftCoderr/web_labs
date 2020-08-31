<?php include 'base.view.php' ?>

<?php startblock('styles') ?>
<style>
    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 55%; /* Could be more or less, depending on screen size */
    }

    /* The Close Button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>
<?php endblock() ?>

<?php startblock('content') ?>
<h2>Blog posts</h2>
<?php foreach ($model['posts'] as $post) { ?>
    <div class="post" id="post<?=$post->getId()?>">
        <h3><?=$post->getTitle()?></h3>
        <h6><?=$post->getDate()?></h6>
        <?php if ($post->hasImage()) { ?>
            <img src="/uploaded/<?=$post->getImage()?>" alt="">
        <?php } ?>
        <p><?=$post->getText()?></p>
        <strong>Комментарии:</strong>
        <div class="comments" id="comments<?=$post->getId()?>">
            <?php foreach ($post->getComments() as $comment) { ?>
                <div class="comment">
                    <h4><?=$comment->getUser()->getUsername()?></h4>
                    <p><?=$comment->getText();?></p>
                    <h6><?=$comment->getDate()?></h6>
                </div>
            <?php } ?>
        </div>
        <?php if (authenticated()) {?>
            <button onclick="openModal(<?=$post->getId()?>)">Оставить комментарий</button>
        <?php } ?>
    </div>
<?php } ?>
<?php endblock() ?>

<?php startblock('dynamic') ?>
<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <form id="commentForm" name="commentForm">
            <label for="comment_text">Текст комментария</label>
            <textarea id="comment_text" name="comment_text"></textarea>
            <input type="text" id="post_id" hidden>
            <input onclick="makeComment()" type="button" value="Отправить">
        </form>
    </div>
</div>
<?php endblock() ?>

<?php startblock('scripts') ?>
<script src="/js/lib/JsHttpRequest/JsHttpRequest.js"></script>
<script type="text/javascript">
  // Get the modal
  var modal = document.getElementById("myModal");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  let commentForm = document.forms['commentForm'];

  // When the user clicks on the button, open the modal
  function openModal($postId) {
    commentForm['post_id'].value = $postId;
    modal.style.display = "block";
  }

  function closeModal() {
    modal.style.display = "none";
  }

  // When the user clicks on <span> (x), close the modal
  span.onclick = closeModal();

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target === modal) {
      closeModal();
    }
  }

  function renderNewComment(comment, username) {
    let comments = document.getElementById('comments' + comment['post_id']);
    let commentTag = document.createElement('div');
    commentTag.classList.add('comment');
    let commentUser = document.createElement('h4');
    commentUser.textContent = username;
    let commentText = document.createElement('p');
    commentText.textContent = comment['text'];
    let commentDate = document.createElement('h6');
    commentDate.textContent = comment['date'];
    commentTag.appendChild(commentUser)
    commentTag.appendChild(commentText)
    commentTag.appendChild(commentDate);
    comments.appendChild(commentTag);
  }

  function makeComment() {

    JsHttpRequest.query(
    'form.POST /blog/comment',
    {
      text: commentForm['comment_text'].value,
      post_id: commentForm['post_id'].value
    },
    function (result, errors) {
      if (result['result']) {
        closeModal();
        renderNewComment(result['result'], result['username'])
      } else {
        alert(JSON.stringify(result['errors']));
      }
    }
    );
    commentForm['comment_text'].value = '';
    commentForm['post_id'] = '';
  }
</script>
<?php endblock() ?>
