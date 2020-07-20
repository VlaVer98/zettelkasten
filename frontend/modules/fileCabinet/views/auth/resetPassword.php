<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model frontend\modules\fileCabinet\models\ResetPasswordForm;*/

$this->title = 'Новый пароль';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];

?>

<div class="login-box">
    <div class="login-logo">
        <a href="#">My <b>Zettelkasten</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <h3 class="login-box-msg">Введите новый пароль</h3>

        <?php $form = ActiveForm::begin(['id' => 'reset-password-form', 'enableClientValidation' => true]); ?>

        <?= $form
            ->field($model, 'password', $fieldOptions1)
            ->label()
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

        <div class="row">
            <div class="col-xs-4">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'reset-password-button']) ?>
            </div>
            <!-- /.col -->
        </div>

        <?php ActiveForm::end(); ?>

    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->

