<?php

$this->title = 'Загрузка';

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'],
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 col-form-label'],
    ],
    ]); ?>

<?= $form->field($modeluf, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

<div class="form-group mt-5">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end() ?>
