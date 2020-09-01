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

    .form-content {
        display: none;
    }
</style>
<?php endblock() ?>

<?php startblock('content') ?>
<h2>Blog posts</h2>
<?php foreach ($model['posts'] as $post) { ?>
    <div class="post" id="post<?=$post->getId()?>">
        <h3><?=$post->getTitle()?></h3>
        <h6><?=$post->getDate()?></h6>
        <?php if (authenticated() && user()->isAdmin()) {?>
            <button onclick="openEditModal(<?=$post->getId()?>)">Редактировать</button>
        <?php } ?>
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
            <button onclick="openCommentModal(<?=$post->getId()?>)">Оставить комментарий</button>
        <?php } ?>
    </div>
<?php } ?>
<div class="pagination">
    <?php for ($i = 1; $i <= $model['pages']; $i++) { ?>
        <a href="/blog/page/<?=$i?>"
           <?php if ($i == $model['page']) { ?>class="active"<?php } ?>
        ><?=$i?></a>
    <?php } ?>
</div>
<?php endblock() ?>

<?php startblock('dynamic') ?>
<div id="commentFormContent" class="form-content">
    <form id="commentForm" name="commentForm">
        <label for="text">Текст комментария</label>
        <ul class="errorbox" id="errorbox-text"></ul>
        <textarea id="text" name="text"></textarea>
        <input type="text" id="post_id" hidden>
        <input onclick="makeComment()" type="button" value="Отправить">
    </form>
</div>
<div id="editFormContent" class="form-content">
    <form id="editForm" name="editForm">
        <label for="title">Заголовок</label>
        <ul class="errorbox" id="errorbox-title"></ul>
        <input type="text" id="title" name="title">
        <label for="text">Текст</label>
        <ul class="errorbox" id="errorbox-text"></ul>
        <textarea id="text" name="text"></textarea>
        <input type="text" id="post_id" hidden>
        <input onclick="updatePost()" type="button" value="Обновить">
    </form>
</div>
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="modalContainer">

        </div>
    </div>
</div>
<?php endblock() ?>

<?php startblock('scripts') ?>
<script src="/js/lib/JsHttpRequest/JsHttpRequest.js"></script>
<script type="text/javascript">
  let modal = document.getElementById("modal");
  let span = document.getElementsByClassName("close")[0];
  let modalContainer = document.getElementById('modalContainer');

  let commentFormContent = document.getElementById('commentFormContent');
  let commentFormContentHTML = commentFormContent.innerHTML;
  document.body.removeChild(commentFormContent);

  let editFormContent = document.getElementById('editFormContent');
  let editFormContentHTML = editFormContent.innerHTML;
  document.body.removeChild(editFormContent);

  function getPostTitle(postId) {
    let postTag = document.getElementById('post' + postId);
    return postTag.getElementsByTagName('h3')[0].innerText;
  }

  function getPostText(postId) {
    let postTag = document.getElementById('post' + postId);
    return postTag.getElementsByTagName('p')[0].innerText;
  }


  function openCommentModal(postId) {
    modalContainer.innerHTML = commentFormContentHTML;
    modal.style.display = "block";
    let form = document.forms['commentForm'];
    form['post_id'].value = postId;
  }

  function openEditModal(postId) {
    modalContainer.innerHTML = editFormContentHTML;
    modal.style.display = "block";
    let form = document.forms['editForm'];
    form['post_id'].value = postId;
    form['title'].value = getPostTitle(postId);
    form['text'].value = getPostText(postId);
  }

  function closeModal() {
    modal.style.display = "none";
    modalContainer.innerHTML = '';
  }

  span.onclick = closeModal;
  window.onclick = function(event) {
    if (event.target === modal) {
      closeModal();
    }
  }

  function renderErrors(errors) {
    for (const [key, fieldErrors] of Object.entries(errors)) {
      let errorbox = document.getElementById('errorbox-' + key);
      errorbox.innerHTML = ''; //clear previous errors
      errorbox.style.display = 'block';
      for (const error of fieldErrors) {
        let errorTag = document.createElement('li');
        errorTag.innerText = error;
        errorbox.appendChild(errorTag);
      }
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
    let form = document.forms['commentForm'];
    JsHttpRequest.query(
      'form.POST /blog/comment',
      {
        text: form['text'].value,
        post_id: form['post_id'].value
      },
      function (result, errors) {
        if (result['result']) {
          closeModal();
          renderNewComment(result['result'], result['username'])
        } else {
          renderErrors(result['errors']);
        }
      }
    );
  }

  function rerenderPost(post) {
    let postTag = document.getElementById('post' + post['post_id']);
    postTag.getElementsByTagName('h3')[0].innerText = post['title'];
    postTag.getElementsByTagName('p')[0].innerText = post['text'];
  }

  function updatePost() {
    let form = document.forms['editForm'];
    JsHttpRequest.query(
      'script.GET /blog/post/edit',
      {
        title: form['title'].value,
        text: form['text'].value,
        post_id: form['post_id'].value
      },
      function (result, errors) {
        if (result['result']) {
          closeModal();
          rerenderPost(result['result'])
        } else {
          renderErrors(result['errors']);
        }
      }
    );
  }
</script>
<?php endblock() ?>
