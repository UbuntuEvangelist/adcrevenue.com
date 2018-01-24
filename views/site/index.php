<?php
/* @var $this yii\web\View */

$this->title = Yii::t('app', Yii::$app->name);
use yii\helpers\Html;
?>
<div class="top-content">        	
	<div class="inner-bg">
		<div class="container">                    
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3 form-box" >
					<div class="form-top">						
						<div class="text-center" style="padding-top:20px;">
							<?php 			
								if (!Yii::$app->user->isGuest) { echo Html::a('প্রস্থান', ['/site/logout'], ['class' => 'btn btn-success btn-flat', 'data-method'=>'post']);
								 } else { echo Html::a('লগ ইন', ['/site/login'], ['class' => 'btn btn-success btn-flat']);	} ?>					 							
						</div> 						
					</div>
					<div class="form-bottom hidden-xs">
						<h5 class="text-center" style="color:navy">দেওয়ানী ও সার্ভে ট্রাইব্যুনাল মামলার মনিটরিং সিষ্টেম ©</h5><br><h5 class="text-center">কারিগরি সহায়তায়:&nbsp;স্কুল অফ ফ্রীল্যানসিং&nbsp;এবং&nbsp;এলটিবি</h5>																										                        		                        								  														   							                    
					</div>
					<div class="form-bottom visible-xs">
						<h6 class="text-center" style="font-size:10px; color:navy">দেওয়ানী ও সার্ভে ট্রাইব্যুনাল মামলার মনিটরিং সিষ্টেম ©</h6><br><h6 class="text-center" style="font-size:10px;">কারিগরি সহায়তায়:&nbsp;স্কুল অফ ফ্রীল্যানসিং&nbsp;এবং&nbsp;এলটিবি</h6>																										                        		                        								  														   							                    
					</div>		
				</div>
			</div>                   
		</div>				
	</div>
</div>        
	