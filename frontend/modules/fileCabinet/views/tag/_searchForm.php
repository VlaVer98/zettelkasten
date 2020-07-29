<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'searchTag-form',
    'action' => 'all',
    'method' => 'get',
    'options' => ['class' => 'navbar-form navbar-right'],
]) ?>
<?= $form->field($model, 'name', [
    'template' => "{input}",
    'inputOptions' =>
        [
            'class' => 'form-control'
        ]
])->textInput(['placeholder' => 'Поиск...'])->label(false)->error(false) ?>

<?= Html::submitButton('Поиск', ['class' => 'btn btn-default']) ?>

<?php ActiveForm::end() ?>