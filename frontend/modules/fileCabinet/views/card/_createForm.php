<?php

use mihaildev\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

//$model->tags =  ['red', 'green']; // initial value
$form = ActiveForm::begin([
    'id' => 'createCard-form',
    'options' => [
        'fieldClass' => 'form-group'
    ],
]) ?>

<?= $form->field($model, 'header')->textInput(); ?>
<?= $form->field($model, 'text')->widget(CKEditor::className(), [
    'editorOptions' => [
        'preset' => 'basic', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
        'inline' => false, //по умолчанию false
    ],
]) ?>
<?= $form->field($model, 'tags')->widget(Select2::classname(), [
    'data' => ArrayHelper::map($tags, 'name', 'name'),
    'options' => ['placeholder' => 'Выберите теги', 'multiple' => true],
    'pluginOptions' => [
        'tags' => false,
        'tokenSeparators' => [',', ' '],
        'maximumInputLength' => 10
    ],
])->label(); ?>
<?= $form->field($model, 'relationCards')->widget(Select2::classname(), [
    'data' => ArrayHelper::map($cards, 'header', 'header'),
    'options' => ['placeholder' => 'Выберите карточку с которой хотите связать', 'multiple' => true],
    'pluginOptions' => [
        'tags' => false,
        'tokenSeparators' => [',', ' '],
        'maximumInputLength' => 10
    ],
])->label(); ?>

    <div class="form-group">
        <div class="box-footer">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>