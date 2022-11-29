<?php $this->title = 'Просмотр'; ?>

<div class="d-flex align-items-center justify-content-end">
<div class="col-md-2 text-right sort-wrapper">
    <label class="control-label" for="input-sort">Сортировать по:</label>
    <div class="sort-inner">
        <select onchange="window.location.href=this.options[this.selectedIndex].value">
            <option value="<?= \yii\helpers\Url::to(['view?sort=nameup']) ?>" <?= ($selected=='nameup') ? 'selected' : null; ?>>Названию A-Z</option>
            <option value="<?= \yii\helpers\Url::to(['view?sort=namedown']) ?>" <?= ($selected=='namedown') ? 'selected' : null; ?>>Названию Z-A</option>
            <option value="<?= \yii\helpers\Url::to(['view?sort=dateup']) ?>" <?= ($selected=='dateup') ? 'selected' : null; ?>>Дате загрузки ▲</option>
            <option value="<?= \yii\helpers\Url::to(['view?sort=datedown']) ?>" <?= ($selected=='datedown') ? 'selected' : null; ?>>Дате загрузки ▼</option>
        </select>
    </div>
</div>
</div>

<table class="table table-hover align-middle">
    <thead>
    <tr>
        <th scope="col">Файл</th>
        <th scope="col">Загружен</th>
        <th scope="col">img</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($images as $image): ?>
    <tr>
        <td><?= $image->name ?></td>
        <td><?= date( 'd.m.y H:i', strtotime($image->created_at) ) ?></td>
        <td><a target="_blank" href='<?= \yii\helpers\Url::to(["@web/upload/{$image->name}"]) ?>'>
                <?= yii\helpers\Html::img("@web/upload/{$image->name}", ['class' => 'thumbnail']) ?>
            </a></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php
