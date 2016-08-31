<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\Monitoringchok;

$this->title = 'বিজ্ঞ সহকারী জজ, নাঙ্গলকোট আদালত';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="col-lg-12">
<?php
	$query = Monitoringchok::find();
	$dataProvider = new ActiveDataProvider([
		'query' => $query,
	]);
	$query->andFilterWhere(['biggAdaloterNam' => 32])
		->groupBy('mamlarBochor')
		->orderBy('mamlaNong');
	$query->andFilterwhere(['!=', 'status', '10'])
			->andFilterwhere(['=', 'status', '1']);
?>
<?= GridView::widget([
        'dataProvider' => $dataProvider,       
        'columns' => [          
            ['class' => 'yii\grid\SerialColumn',
				 'header' => 'ক্রমিক নং',
			],			
            'noticeReceivedDate:date',           
			[
				'attribute' => 'upazilaNam',
				'label' => 'উপজেলার নাম',
				'value' => function ($model) {
					return $model->upazilaNam0->upazila_nam;
				},
			],
			[
				'label' => 'মামলা নং',
				'attribute' => 'mamlaNong',
				'value' => function ($model) {
					return $model->mamlaNong . '/' . $model->mamlarBochor;
				},
			],                        
			[
				'attribute' => 'biggAdaloterNam',
				'label' => 'বিজ্ঞ আদালতের নাম',
				'value' => function ($model) {
					return $model->biggAdaloterNam0->biggAdaloterNam;
				},
			],
            'emailSendingDate:date',
            'sfReceiptDate:date',
			[
				'attribute' => 'sfReceiptOriginalDate',
				'format' => 'raw',				
				'value' => function ($model) {     
					if (($model->sfReceiptOriginalDate) == '0000-00-00' || ($model->sfReceiptOriginalDate) == '' || $model->sfReceiptOriginalDate <= $model->sfReceiptDate) {
						return '<div  class="text-center" style="background-color:green; color:#fff;"><strong>'.$model->sfReceiptOriginalDate.'</strong></div>';
					} else {
						return '<div class="text-center" style="background-color:red; color:#fff;">'.$model->sfReceiptOriginalDate.'</strong></div>';
					}
				},
			],		            
			[
				'attribute' => 'sfSendToJusticeDate',
				'format' => 'raw',
				'value' => function ($model) {     
					if (($model->sfSendToJusticeDate == '') || ($model->sfSendToJusticeDate == '0000-00-00') ) {
						return '<div class="text-center" style="background-color:red; color:#fff;"><strong>Not Send to Justice</strong></div>';											
					} else {
						return '<div  class="text-center" style="background-color:green; color:#fff;"><strong>'.$model->sfSendToJusticeDate.'</strong></div>';
					}
				},
			],							
            'montobo',            
        ],
    ]); ?>

</section>
