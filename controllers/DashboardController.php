<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\UserSearch;

class DashboardController extends Controller
{    
    public function behaviors()
    {		
        return [
			'access' => [
				'class' =>AccessControl::className(),
				'only' => ['index'],
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@'],
					]
				
				]
			],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
    
    public function actionIndex()
    {
        $this->layout = 'dashboard';
	$searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);		
		return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }   
}