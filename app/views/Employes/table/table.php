<table class="table table-head-fixed text-nowrap">
    <thead>
    <tr>
        <th>ПІБ</th>
        <th>День Рождения</th>
        <th>Отдел</th>
        <th>Должность</th>
        <th>Тип оплаты</th>
        <th>Ставка</th>
        <th>Сумма</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $employer) :?>
        <tr>
            <td><?=$employer['pib'];?></td>
            <td><?=$employer['birthday'];?></td>
            <td><?=$employer['department'];?></td>
            <td><?=$employer['position'];?></td>
            <td><?=$employer['salaryType'];?></td>
            <td><?=$employer['rate'];?></td>
            <td><?=$employer['salary'];?></td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
