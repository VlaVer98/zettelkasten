<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'createTag-form',
    'options' => [
        'fieldClass' => 'form-group'
    ],
]) ?>

<?= $form->field($model, 'name')->textInput(); ?>
    <div class="form-group">
        <div class="box-footer">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>