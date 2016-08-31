<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Request password reset');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-request-password-reset">

    <h1 style="color:#fff; padding-top:100px;"><?= Html::encode($this->title) ?></h1>
	<div class="col-md-4"></div>
    <div class="col-md-4 well bs-component">

        <p><?= Yii::t('app', 'A link to reset password will be sent to your email.') ?></p>

        <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

            <?php // $form->field($model, 'email')->input('email', 
                //['placeholder' => Yii::t('app', 'Please fill out your email.'), 'autofocus' => true]) ?>
			<?php echo $form->field($model, 'email', [
					   'inputOptions' => ['autofocus' => true, 'class' => 'form-control transparent']
				 ])->textInput()->input('email', ['placeholder' => 'আপনার ই-মেইল পূরণ করুন'])->label(false); ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn btn-primary']) ?>
            </div>

        <?php ActiveForm::end(); ?>

    </div>
	<div class="col-md-4"></div>
</div>
