<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\Monitoringchok;

$this->title = 'লাকসাম';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="col-lg-12">

<?php
	$query = Monitoringchok::find();
	$dataProvider = new ActiveDataProvider([
		'query' => $query,
	]);
	$query->andFilterWhere(['upazilaNam' => 4])
		->groupBy('mamlarBochor')
		->orderBy('mamlaNong');	
	$query->andFilterwhere(['!=', 'status', '10'])
			->andFilterwhere(['!=', 'status', '1'])
			->andFilterwhere(['=', 'status', '0']);	
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
<section class="col-lg-12">
<?php $model = Monitoringchok::find()->where(['=', 'status', '1'])
->andWhere(['upazilaNam'=> 4])->all();	?>						

<div class="nav-tabs-custom">
	<ul class="nav nav-tabs pull-right">
		<li class="active"><a href="#revenue-chart" data-toggle="tab">প্রতিবেদন</a></li>
		<li><a href="#sales-chart" data-toggle="tab"></a></li>
		<li class="pull-left header"><i class="fa fa-inbox"></i>Pending S.F</li>
	</ul>
	<div class="tab-content no-padding">				 
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th class="text-center">দেওয়ানী মোকাদ্দমা নং</th>																		
						<th class="text-center">উপজেলা ভূমি অফিস হতে এসএফ প্রাপ্তির জন্য নির্ধারিত তারিখ</th>
						<th class="text-center">উপজেলা ভূমি অফিস হতে এসএফ প্রাপ্তির প্রকৃত তারিখ</th>
						<th class="text-center">বিজ্ঞ আদালত/সরকারি কৌশুলির কাছে এসএফ প্রেরণের তারিখ</th>
						<th class="text-center">মন্তব্য</th>							
					</tr>
					
				</thead>
				<tbody>																  				
					<?php 
						foreach($model as $sf)
						{
							echo '<tr class="info">'.'<td class="text-center">'.$sf['mamlaNong'].'/'.$sf['mamlarBochor'].'</td>'.'<td class="text-center">'.$sf['sfReceiptDate'].'</td>'.'<td class="text-center">'.$sf['sfReceiptOriginalDate'].'</td>'.'<td class="text-center">'.$sf['sfSendToJusticeDate'].'</td>'.'<td class="text-center">'.$sf['montobo'].'</td>'.'</tr>'; 
						}
					?>													  							
				</tbody>
			</table>	
		</div>            				
	</div>
</div>

</section>