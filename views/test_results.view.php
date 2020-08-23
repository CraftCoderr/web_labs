<?php include 'base.view.php' ?>

<?php startblock('content') ?>
<table>
    <tr>
        <th>Дата</th>
        <th>ФИО</th>
        <th>Группа</th>
        <th>Ответ1</th>
        <th>Ответ2</th>
        <th>Ответ3</th>
        <th>Результат</th>
    </tr>
    <?php foreach ($model['data'] as $result) { ?>
        <tr>
            <td><?=$result['date']?></td>
            <td><?=$result['fio']?></td>
            <td><?=$result['group']?></td>
            <td><?=$result['answer1']?></td>
            <td><?=$result['answer2']?></td>
            <td><?=$result['answer3']?></td>
            <td><?=$result['result'] ? 'Пройден' : 'Не пройден'?></td>
        </tr>
    <?php } ?>
</table>
<?php endblock() ?>
