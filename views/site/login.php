<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\rbac\models\AuthItem;
use yii\helpers\ArrayHelper;
use himiklab\yii2\recaptcha\ReCaptchaValidator;

$this->title = 'দেওয়ানী ও সার্ভে ট্রাইব্যুনাল মামলার মনিটরিং সিষ্টেম';
?>
        <!-- Top content -->
        <div class="top-content">        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong><?= Html::encode($this->title) ?></strong></h1>
                            <div class="description">
                            	
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        		<h3>মনিটরিং টুল লগ-ইন</h3>
                            		<!--<h6>লগ-ইন করার জন্য লগ-ইন সংক্রান্ত তথ্যাদি এবং ব্যবহারকারীর পরিচয় লিখুন:</h6>-->
									<h6><?= Yii::t('app', 'Please fill out the following fields to login:') ?></h6>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-key"></i>
                        		</div>
                            </div>
							<!-- ActiveForm -->
							<?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['style' => 'background:#eeeeee; padding-bottom:30px; padding-left:20px; padding-right:20px;']]); ?>
							
							<?php if ($model->scenario === 'lwe'): ?>
								<div class="form-group" style="padding-top:20px;">
									<label class="sr-only" for="example">ব্যবহারকারীর ই-মেইল</label>								
								<?php echo $form->field($model, 'email', [
											   'inputOptions' => ['autofocus' => true, 'class' => 'form-control transparent']
										 ])->textInput()->input('email', ['placeholder' => "ব্যবহারকারীর ই-মেইল"])->label(false); ?>
								</div>
							<?php else: ?>
								
								<div class="form-group" style="padding-top:20px;">
									<label class="sr-only" for="example">ব্যবহারকারীর নাম</label>
									<?php echo $form->field($model, 'username', [
												   'inputOptions' => ['autofocus' => true, 'class' => 'form-control transparent']
											 ])->textInput()->input('username', ['placeholder' => "ব্যবহারকারীর নাম"])->label(false); ?>
								</div>
							<?php endif ?>
							
							<div class="form-group" style="padding-top:0px;">
								<label class="sr-only" for="example">প্যাসওয়ার্ড</label>
								<?php echo $form->field($model, 'password', [
										   'inputOptions' => ['autofocus' => false, 'class' => 'form-control transparent']
									 ])->textInput()->input('password', ['placeholder' => "প্যাসওয়ার্ড"])->label(false); ?>
							</div>
												
							<div style="color:#999;margin:1em 0">
								<?= Yii::t('app', 'If you forgot your password you can') ?>
								<?= Html::a(Yii::t('app', 'reset it'), ['site/request-password-reset']) ?>.
							</div>

							<div class="form-group">
								<?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
							</div>

							<?php ActiveForm::end(); ?>
							<!-- ActiveForm End-->
                        </div>
                    </div>                   
                </div>
				<font color="white">টেকনিকেল সাপোর্ট&nbsp;স্কুল অফ ফ্রীল্যানসিং&nbsp;এবং &nbsp;এলটিবি</font>
            </div>
        </div>                          