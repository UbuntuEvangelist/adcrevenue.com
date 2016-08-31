<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Upazila;
use app\models\BiggAdalot;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Monitoringchok */
/* @var $form yii\widgets\ActiveForm */
$userOf = \Yii::$app->user->identity->userof;
?>
<?php if (Yii::$app->user->can('admin')){ ?>
<div class="monitoringchok-form">

   <?php $form = ActiveForm::begin(['id' => 'form-user','options' => ['enctype' => 'multipart/form-data']]); ?>    
    
	<?= $form->field($model, 'upazilaNam')->dropDownList(
		ArrayHelper::map(Upazila::find()->all(), 'upazila_nong', 'upazila_nam'),
		['prompt' => 'উপজেলা নির্বাচন করুন']
	) ?>
	
	<div class="row">
		<?= Html::activeLabel($model, 'mamlaNong', [
			'label'=> 'মামলা নং', 
			'class'=>'col-lg-1 control-label'
		]) ?>
		<div class="col-lg-2">			
			<?php echo $form->field($model, 'mamlaNong', [
					   'inputOptions' => ['autofocus' => false, 'class' => 'form-control transparent']
				 ])->textInput()->input('mamlaNong', ['placeholder' => 'মামলা নাম্বার'])->label(false); ?>
		</div>
		<div class="col-lg-2">			
			<?php echo $form->field($model, 'mamlarBochor', [
					   'inputOptions' => ['autofocus' => false, 'class' => 'form-control transparent']
				 ])->textInput()->input('mamlarBochor', ['placeholder' => 'মামলার বছর'])->label(false); ?>
		</div>
		<div class="col-lg-8"></div>
    </div>    
	<?php /*echo $form->field($model, 'biggAdaloterNam', [
			   'inputOptions' => ['autofocus' => false, 'class' => 'form-control transparent']
		 ])->textInput()->input('biggAdaloterNam', ['placeholder' => 'আদালত তিন']) */?>
	<?= $form->field($model, 'biggAdaloterNam')->dropDownList(
		ArrayHelper::map(BiggAdalot::find()->all(), 'biggAdalot_id', 'biggAdaloterNam'),
		['prompt' => 'বিজ্ঞ আদালত নির্বাচন করুন']
	) ?>
	
	<?= $form->field($model, 'noticeReceivedDate')->widget(DatePicker::className(), [			
		'value' => date('Y-m-d'),
		'type' => DatePicker::TYPE_COMPONENT_APPEND,
		'removeButton' => [
			'icon'=>'trash',
		],
		'pickerButton' => [
			'icon'=>'ok',
		],
		'pluginOptions' => [
			'autoclose'=>true,
			'format' => 'yyyy-mm-dd'
		]
	]) ?> 
		 
	<?= $form->field($model, 'emailSendingDate')->widget(DatePicker::className(), [			
		'value' => date('Y-m-d'),
		'type' => DatePicker::TYPE_COMPONENT_APPEND,
		'removeButton' => [
			'icon'=>'trash',
		],
		'pickerButton' => [
			'icon'=>'ok',
		],
		'pluginOptions' => [
			'autoclose'=>true,
			'format' => 'yyyy-mm-dd'
		]
	]) ?>    
	
	<?= $form->field($model, 'sfReceiptDate')->widget(DatePicker::className(), [			
		'value' => date('Y-m-d'),
		'type' => DatePicker::TYPE_COMPONENT_APPEND,
		'removeButton' => [
			'icon'=>'trash',
		],
		'pickerButton' => [
			'icon'=>'ok',
		],
		'pluginOptions' => [
			'autoclose'=>true,
			'format' => 'yyyy-mm-dd'
		]
	]) ?>  
		    
	<?= $form->field($model, 'sfReceiptOriginalDate')->widget(DatePicker::className(), [			
		'value' => date('Y-m-d'),
		'type' => DatePicker::TYPE_COMPONENT_APPEND,
		'removeButton' => [
			'icon'=>'trash',
		],
		'pickerButton' => [
			'icon'=>'ok',
		],
		'pluginOptions' => [
			'autoclose'=>true,
			'format' => 'yyyy-mm-dd'
		]
	]) ?> 
    
	<?= $form->field($model, 'sfSendToJusticeDate')->widget(DatePicker::className(), [			
		'value' => date('Y-m-d'),
		'type' => DatePicker::TYPE_COMPONENT_APPEND,
		'removeButton' => [
			'icon'=>'trash',
		],
		'pickerButton' => [
			'icon'=>'ok',
		],
		'pluginOptions' => [
			'autoclose'=>true,
			'format' => 'yyyy-mm-dd'
		]
	]) ?> 
    
	<?php echo $form->field($model, 'montobo', [
			   'inputOptions' => ['autofocus' => false, 'class' => 'form-control transparent']
		 ])->textInput()->input('montobo', ['placeholder' => 'কথা']); ?>
    
	<?= $form->field($model, 'status')->dropDownList($model->statusList, ['prompt' => 'কাজের অগ্রগতি'])->label(false) ?>
	
	<?= $form->field($model, 'scanfile')->fileInput(); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['monitoringchok/index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php } elseif($userOf === 17 || $userOf === 18 || $userOf === 19 || $userOf === 20 || $userOf === 21 || $userOf === 22 || $userOf === 23 || $userOf === 24 || $userOf === 25 || $userOf === 26 || $userOf === 27 || $userOf === 28 || $userOf === 29 || $userOf === 30 || $userOf === 31 || $userOf === 32 || $userOf === 33 || $userOf === 34 || $userOf === 35 || $userOf === 36 || $userOf === 37 || $userOf === 38 || $userOf === 39 || $userOf === 40 ) { ?>
	<div class="monitoringchok-form">

   <?php $form = ActiveForm::begin(['id' => 'form-user','options' => ['enctype' => 'multipart/form-data']]); ?>    
    
	<?= $form->field($model, 'upazilaNam')->dropDownList(
		ArrayHelper::map(Upazila::find()->all(), 'upazila_nong', 'upazila_nam'),
		['prompt' => 'উপজেলা নির্বাচন করুন']
	) ?>
	
	<div class="row">
		<?= Html::activeLabel($model, 'mamlaNong', [
			'label'=> 'মামলা নং', 
			'class'=>'col-lg-1 control-label'
		]) ?>
		<div class="col-lg-2">			
			<?php echo $form->field($model, 'mamlaNong', [
					   'inputOptions' => ['autofocus' => false, 'class' => 'form-control transparent']
				 ])->textInput()->input('mamlaNong', ['placeholder' => 'মামলা নাম্বার'])->label(false); ?>
		</div>
		<div class="col-lg-2">			
			<?php echo $form->field($model, 'mamlarBochor', [
					   'inputOptions' => ['autofocus' => false, 'class' => 'form-control transparent']
				 ])->textInput()->input('mamlarBochor', ['placeholder' => 'মামলার বছর'])->label(false); ?>
		</div>
		<div class="col-lg-8"></div>
        </div>
        
        <?= $form->field($model, 'noticeReceivedDate')->widget(DatePicker::className(), [			
		'value' => date('Y-m-d'),
		'type' => DatePicker::TYPE_COMPONENT_APPEND,
		'removeButton' => [
			'icon'=>'trash',
		],
		'pickerButton' => [
			'icon'=>'ok',
		],
		'pluginOptions' => [
			'autoclose'=>true,
			'format' => 'yyyy-mm-dd'
		]
	]) ?>   	
		 
	<?php /*= $form->field($model, 'emailSendingDate')->widget(DatePicker::className(), [			
		'value' => date('Y-m-d'),
		'type' => DatePicker::TYPE_COMPONENT_APPEND,
		'removeButton' => [
			'icon'=>'trash',
		],
		'pickerButton' => [
			'icon'=>'ok',
		],
		'pluginOptions' => [
			'autoclose'=>true,
			'format' => 'yyyy-mm-dd'
		]
	]) */?>    
	
	<?php /*= $form->field($model, 'sfReceiptDate')->widget(DatePicker::className(), [			
		'value' => date('Y-m-d'),
		'type' => DatePicker::TYPE_COMPONENT_APPEND,
		'removeButton' => [
			'icon'=>'trash',
		],
		'pickerButton' => [
			'icon'=>'ok',
		],
		'pluginOptions' => [
			'autoclose'=>true,
			'format' => 'yyyy-mm-dd'
		]
	]) */?>  
		    
	<?php /*= $form->field($model, 'sfReceiptOriginalDate')->widget(DatePicker::className(), [			
		'value' => date('Y-m-d'),
		'type' => DatePicker::TYPE_COMPONENT_APPEND,
		'removeButton' => [
			'icon'=>'trash',
		],
		'pickerButton' => [
			'icon'=>'ok',
		],
		'pluginOptions' => [
			'autoclose'=>true,
			'format' => 'yyyy-mm-dd'
		]
	]) */?> 
    
	<?php /*= $form->field($model, 'sfSendToJusticeDate')->widget(DatePicker::className(), [			
		'value' => date('Y-m-d'),
		'type' => DatePicker::TYPE_COMPONENT_APPEND,
		'removeButton' => [
			'icon'=>'trash',
		],
		'pickerButton' => [
			'icon'=>'ok',
		],
		'pluginOptions' => [
			'autoclose'=>true,
			'format' => 'yyyy-mm-dd'
		]
	]) */ ?> 
    
	<?php echo $form->field($model, 'montobo', [
			   'inputOptions' => ['autofocus' => false, 'class' => 'form-control transparent']
		 ])->textInput()->input('montobo', ['placeholder' => 'কথা']); ?>
    
	<?= $form->field($model, 'status')->dropDownList($model->statusList, ['prompt' => 'কাজের অগ্রগতি'])->label(false) ?>
	
	<?= $form->field($model, 'scanfile')->fileInput(); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['monitoringchok/index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php } else { ?>
	<div class="monitoringchok-form">
	
    <?php $form = ActiveForm::begin(['id' => 'form-user','options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php /*= $form->field($model, 'noticeReceivedDate')->widget(DatePicker::className(), [			
		'value' => date('Y-m-d'),
		'type' => DatePicker::TYPE_COMPONENT_APPEND,
		'removeButton' => [
			'icon'=>'trash',
		],
		'pickerButton' => [
			'icon'=>'ok',
		],
		'pluginOptions' => [
			'autoclose'=>true,
			'format' => 'yyyy-mm-dd'
		]
	]) */?> 
    
	<?php /*= $form->field($model, 'upazilaNam')->dropDownList(
		ArrayHelper::map(Upazila::find()->all(), 'upazila_nong', 'upazila_nam'),
		['prompt' => 'উপজেলা নির্বাচন করুন']
	) */?>
	
	 <div class="row">
		<?php /*=// Html::activeLabel($model, 'mamlaNong', [
			//'label'=> 'মামলা নং', 
			//'class'=>'col-lg-1 control-label'
		//]) */ ?>
		<div class="col-lg-2">			
			<?php /* echo $form->field($model, 'mamlaNong', [
					   'inputOptions' => ['autofocus' => false, 'class' => 'form-control transparent']
				])->textInput()->input('mamlaNong', ['placeholder' => 'মামলা নাম্বার'])->label(false); */?>
		</div>
		<div class="col-lg-2">			
			<?php //echo $form->field($model, 'mamlarBochor', [
					 //  'inputOptions' => ['autofocus' => false, 'class' => 'form-control transparent']
				// ])->textInput()->input('mamlarBochor', ['placeholder' => 'মামলার বছর'])->label(false); ?>
		</div>
		<div class="col-lg-8"></div>
    </div>   
	<?php /*echo $form->field($model, 'biggAdaloterNam', [
			   'inputOptions' => ['autofocus' => false, 'class' => 'form-control transparent']
		 ])->textInput()->input('biggAdaloterNam', ['placeholder' => 'আদালত তিন']) */?>
	<?php /* $form->field($model, 'biggAdaloterNam')->dropDownList(
		ArrayHelper::map(BiggAdalot::find()->all(), 'biggAdalot_id', 'biggAdaloterNam'),
		['prompt' => 'বিজ্ঞ আদালত নির্বাচন করুন']
	) */?>
		 
	<?php /*= $form->field($model, 'emailSendingDate')->widget(DatePicker::className(), [			
		'value' => date('Y-m-d'),
		'type' => DatePicker::TYPE_COMPONENT_APPEND,
		'removeButton' => [
			'icon'=>'trash',
		],
		'pickerButton' => [
			'icon'=>'ok',
		],
		'pluginOptions' => [
			'autoclose'=>true,
			'format' => 'yyyy-mm-dd'
		]
	]) */ ?>    
	
	<?php /* = $form->field($model, 'sfReceiptDate')->widget(DatePicker::className(), [			
		'value' => date('Y-m-d'),
		'type' => DatePicker::TYPE_COMPONENT_APPEND,
		'removeButton' => [
			'icon'=>'trash',
		],
		'pickerButton' => [
			'icon'=>'ok',
		],
		'pluginOptions' => [
			'autoclose'=>true,
			'format' => 'yyyy-mm-dd'
		]
	]) */?>  
		    
	<?= $form->field($model, 'sfReceiptOriginalDate')->widget(DatePicker::className(), [			
		'value' => date('Y-m-d'),
		'type' => DatePicker::TYPE_COMPONENT_APPEND,
		'removeButton' => [
			'icon'=>'trash',
		],
		'pickerButton' => [
			'icon'=>'ok',
		],
		'pluginOptions' => [
			'autoclose'=>true,
			'format' => 'yyyy-mm-dd'
		]
	]) ?> 
    
	<?php /*= $form->field($model, 'sfSendToJusticeDate')->widget(DatePicker::className(), [			
		'value' => date('Y-m-d'),
		'type' => DatePicker::TYPE_COMPONENT_APPEND,
		'removeButton' => [
			'icon'=>'trash',
		],
		'pickerButton' => [
			'icon'=>'ok',
		],
		'pluginOptions' => [
			'autoclose'=>true,
			'format' => 'yyyy-mm-dd'
		]
	]) */?> 
    
	<?php echo $form->field($model, 'montobo', [
			   'inputOptions' => ['autofocus' => false, 'class' => 'form-control transparent']
		 ])->textInput()->input('montobo', ['placeholder' => 'কথা']); ?>    	
	
	<?php /*= $form->field($model, 'scanfile')->fileInput(); */ ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>	

</div>
<?php } ?>
