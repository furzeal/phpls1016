<div>
    <img src="../photos/<?= $data['user']->avatar ?>" alt=""
         style="min-width: 200px; height: 200px">
</div>
<div>
    Имя: <?= $data['user']->name ?>
</div>
<div>
    Возраст: <?= $data['user']->age ?>
</div>
<div>
    Описание: <?= $data['user']->description ?>
</div>

<div>
    Список загруженных файлов:
    <ul>
        <?php
        if (isset($data['user']->photos)){
        foreach ($data['user']->photos as $photo): ?>
            <div><?= $photo['filename'] ?></div>
        <?php endforeach; }?>
    </ul>
</div>

<div>
    Список пользователей:
    <table>
        <tr>
            <th>Имя</th>
            <th>Возраст</th>
            <th>Совершеннолетие</th>
        </tr>
        <?php foreach ($data['users'] as $user): ?>
            <tr>
                <td><?= $user->name ?></td>
                <td><?= $user->age ?></td>
                <td><?= $user->ageType ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>