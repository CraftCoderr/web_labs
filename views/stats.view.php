<?php include 'base.view.php' ?>

<?php startblock('content') ?>
<table>
    <tr>
        <th>Дата</th>
        <th>Страница</th>
        <th>Ip-адрес</th>
        <th>Имя хоста</th>
        <th>Браузер</th>
    </tr>
    <?php foreach ($model['data'] as $record) { ?>
        <tr>
            <td><?=$record['date']?></td>
            <td><?=$record['page']?></td>
            <td><?=$record['ip_address']?></td>
            <td><?=$record['hostname']?></td>
            <td><?=$record['browser']?></td>
        </tr>
    <?php } ?>
</table>

<div class="pagination">
<?php for ($i = 1; $i <= $model['pages']; $i++) { ?>
    <a href="/admin/stats/page/<?=$i?>"
       <?php if ($i == $model['page']) { ?>class="active"<?php } ?>
    ><?=$i?></a>
<?php } ?>
</div>
<?php endblock() ?>
