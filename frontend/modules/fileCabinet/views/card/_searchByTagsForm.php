<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'searchByTagsFrom',
    'action' => 'search-by-tags',
    'method' => 'get',
    'options' => [
        'class' => 'list-group'
    ]
]);
?>
<?= $form->field($model, 'searchTags', ['template' => '{input}'])->checkboxList(ArrayHelper::map($tags, 'name', 'name'), ['item' => function ($index, $label, $name, $checked, $value) {
    if ($checked)
        $checked = 'checked';
    return '<li class="list-group-item">
                <input onchange="$(\'#searchByTagsFrom\').submit();" class = "pull-right" type="checkbox" value="' . $value . '" name="' . $name . '" ' . $checked . ' />' . Html::encode($label) . '
             </li>';
}]) ?>
<?php ActiveForm::end(); ?>