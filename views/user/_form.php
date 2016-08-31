<?php
use app\rbac\models\AuthItem;
use kartik\password\PasswordInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Userof;

/* @var $this yii\web\View */
/* @var $user app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        
		<?= $form->field($user, 'first_name')->textInput(
                ['placeholder' => Yii::t('app', 'First Name'), 'autofocus' => true])->label(false) ?>
				
		<?= $form->field($user, 'last_name')->textInput(
                ['placeholder' => Yii::t('app', 'Last Name'), 'autofocus' => true])->label(false) ?>
								
		<?= $form->field($user, 'designation')->textInput(
                ['placeholder' => Yii::t('app', 'Designation'), 'autofocus' => true])->label(false) ?>	
								
		<?= $form->field($user, 'address')->textInput(
                ['placeholder' => Yii::t('app', 'Address'), 'autofocus' => true])->label(false) ?>		
		
		<?= $form->field($user, 'username')->textInput(
                ['placeholder' => Yii::t('app', 'Create username'), 'autofocus' => true])->label(false) ?>
        
        <?= $form->field($user, 'email')->input('email', ['placeholder' => Yii::t('app', 'Enter e-mail')])->label(false) ?>
		
		<?= $form->field($user, 'mobile_no')->input('mobile_no', ['placeholder' => Yii::t('app', 'মোবাইল নাম্বার')])->label(false) ?>		

        <?php if ($user->scenario === 'create'): ?>

            <?= $form->field($user, 'password')->widget(PasswordInput::classname(), 
                ['options' => ['placeholder' => Yii::t('app', 'Password')]]) ?>

        <?php else: ?>

            <?= $form->field($user, 'password')->widget(PasswordInput::classname(),
                     ['options' => ['placeholder' => Yii::t('app', 'Password')]]) ?> 

        <?php endif ?>

    <div class="row">
    <div class="col-md-6">
        
		<?= $form->field($user, 'status')->dropDownList($user->statusList, ['prompt' => 'পদমর্যাদা অনুসারে'])->label(false) ?>
        <?php foreach (AuthItem::getRoles() as $item_name): ?>			
            <?php $roles[$item_name->name] = $item_name->name ?>			
        <?php endforeach ?>
		<?php $userId = \Yii::$app->user->identity->id; ?>
		<?php if( $userId== 2 && ($key = array_search('admin', $roles)) !== false) {
				unset($roles[$key]); ?>				
		<?php } ?>
		
		<?= $form->field($user, 'item_name')->dropDownList($roles, ['prompt' => 'পদমর্যাদা'])->label(false) ?>
		
        <?= $form->field($user, 'userof')->dropDownList(
			ArrayHelper::map(Userof::find()->all(), 'userof_id', 'title'),
			['prompt' => 'ব্যবহারকারী']
		) ?>
		
		<?= $form->field($user, 'photo')->fileInput(); ?>

    </div>
    </div>

    <div class="form-group">     
        <?= Html::submitButton($user->isNewRecord ? Yii::t('app', 'Create') 
            : Yii::t('app', 'Update'), ['class' => $user->isNewRecord 
            ? 'btn btn-success' : 'btn btn-primary']) ?>

        <?= Html::a(Yii::t('app', 'Cancel'), ['user/index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
 
</div>
