<?php include 'base.view.php' ?>

<?php startblock('content') ?>
<div id="container">
</div>
<?php endblock() ?>

<?php startblock('dynamic') ?>
<div id="modal" class="photo-modal">
    <div class="photo-container">
        <i id="modal-close" class="fa fa-times"></i>
        <img id="photo-img">
        <div class="modal-footer">
            <i id="btn-prev" class="fa fa-angle-left modal-icon"></i>
            <p id="image-number" class="modal-status"></p>
            <i id="btn-next" class="fa fa-angle-right modal-icon"></i>
        </div>
    </div>
</div>
<?php endblock() ?>

<?php startblock('scripts') ?>
<script src='js/photos.js'></script>
<?php endblock() ?>
