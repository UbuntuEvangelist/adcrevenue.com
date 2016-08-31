<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\helpers\CssHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MonitoringchokSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Monitoringchoks');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="monitoringchok-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php 
    	$userOf = \Yii::$app->user->identity->userof;
	if($userOf === 17 || $userOf === 18 || $userOf === 19 || $userOf === 20 || $userOf === 21 || $userOf === 22 || $userOf === 23 || $userOf === 24 || $userOf === 25 || $userOf === 26 || $userOf === 27 || $userOf === 28 || $userOf === 29 || $userOf === 30 || $userOf === 31 || $userOf === 32 || $userOf === 33 || $userOf === 34 || $userOf === 35 || $userOf === 36 || $userOf === 37 || $userOf === 38 || $userOf === 39 || $userOf === 40 )
	{
		echo Html::a(Yii::t('app', 'Create Monitoringchok'), ['create'], ['class' => 'btn btn-success']);
	}
     ?>    
<?php Pjax::begin(); ?>    
<?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
       //'htmlOptions' => ['style' => 'font-size: 30px;'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
				 'header' => 'ক্রমিক নং',
				 'contentOptions' =>['style'=>'font-size:10px;'],
			],

           // 'kromikNong',
            		[
				'attribute' => 'noticeReceivedDate',
				'format' => 'date',
				'contentOptions' =>['style'=>'font-size:10px;'],
			], 
            		         
			[
				'attribute' => 'upazilaNam',
				'label' => 'উপজেলার নাম',
				'contentOptions' =>['style'=>'font-size:10px;'],
				'value' => function ($model) {
					return $model->upazilaNam0->upazila_nam;
				},
			],
			[
				'label' => 'মামলা নং',
				'attribute' => 'mamlaNong',
				'contentOptions' =>['style'=>'font-size:10px;'],
				'value' => function ($model) {
					return $model->mamlaNong . '/' . $model->mamlarBochor;
				},
			],                        
			[
				'attribute' => 'biggAdaloterNam',
				'label' => 'বিজ্ঞ আদালতের নাম',
				'contentOptions' =>['style'=>'font-size:10px;'],
				'value' => function ($model) {
					return $model->biggAdaloterNam0->biggAdaloterNam;
				},
			],
            		[
				'attribute' => 'emailSendingDate',
				'format' => 'date',
				'contentOptions' =>['style'=>'font-size:10px;'],
			],
            		[
				'attribute' => 'sfReceiptDate',
				'format' => 'date',
				'contentOptions' =>['style'=>'font-size:10px;'],
			],
			[
				'attribute' => 'sfReceiptOriginalDate',
				'format' => 'raw',
				//'dateFormat' => 'dd/mm/yyyy',
				'contentOptions' =>['style'=>'font-size:10px;'],
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
				'contentOptions' =>['style'=>'font-size:10px;'],
				'format' => 'raw',
				'value' => function ($model) {     
					if (($model->sfSendToJusticeDate == '') || ($model->sfSendToJusticeDate == '0000-00-00') ) {
						return '<div class="text-center" style="background-color:red; color:#fff;"><strong>Not Send to Justice</strong></div>';											
					} else {
						return '<div  class="text-center" style="background-color:green; color:#fff;"><strong>'.$model->sfSendToJusticeDate.'</strong></div>';
					}
				},
			],		
            [
                'attribute'=>'কাজের অগ্রগতি',
                'filter' => $searchModel->statusList,
                'value' => function ($data) {
                    return $data->getStatusName($data->status);
                },
                'contentOptions'=>function($model, $key, $index, $column) {
                    return ['class'=>CssHelper::monitoringchokStatusCss($model->status),'style'=>'font-size:10px'];
                }
            ],  
            
            [
		'header' => 'স্ক্যান ফাইল',
		'format' => 'html',		
		'value'=>function($data) { return $data->scanfileurl; },
	    ],	
            [
		'attribute' => 'montobo',
		'contentOptions' =>['style'=>'font-size:10px;'],			
	    ],          
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

            	['class' => 'yii\grid\ActionColumn',
	            'header' => "মেনু",	            
	            'template' => '{view} {update} {delete}',
	                'buttons' => [
	                    'view' => function ($url, $model, $key) {
	                        return Html::a('', $url, ['title'=>'View user', 'class'=>'glyphicon glyphicon-eye-open']);
	                    },
	                    'update' => function ($url, $model, $key) {
	                        return Html::a('', $url, ['title'=>'Manage user', 'class'=>'glyphicon glyphicon-pencil']);
	                    },
	                    'delete' => function ($url, $model, $key) {
	                        return Html::a('', $url, 
	                        ['title'=>'Delete user', 
	                            'class'=>'glyphicon glyphicon-trash',
	                            'data' => [
	                                'confirm' => Yii::t('app', 'Are you sure you want to delete this user?'),
	                                'method' => 'post']
	                        ]);
	                    }
	                ]
	
           	 ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
