<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model frontend\modules\fileCabinet\models\PasswordResetRequestForm;*/

$this->title = 'Письмо подтверждение';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

?>

<div class="login-box">
    <div class="login-logo">
        <a href="#">My <b>Zettelkasten</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <h3 class="login-box-msg">Выслать письмо подтверждение повторно</h3>

        <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form', 'enableClientValidation' => true]); ?>

        <?= $form
            ->field($model, 'email', $fieldOptions1)
            ->label()
            ->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>

        <div class="row">
            <div class="col-xs-4">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary btn-flat', 'name' => 'request-password-reset-button']) ?>
            </div>
            <!-- /.col -->
        </div>


        <?php ActiveForm::end(); ?>
        <p class="">Пожалуйста, заполните вашу электронную почту и вам повторно придет письмо для подтверждения вашего аккаунта</p>
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->

