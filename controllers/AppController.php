<?php
namespace app\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;


class AppController extends Controller
{
   
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'controllers' => ['user'],
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],                    					

                ], 
				'only' => ['sadar','adarsa','barura','chandina','daudkandi','laksam','brahmanpara','burichong','chauddagram','homna','muradnagar','nangalkot','meghna','titas','monohorgonj'],                
                    [                      
                        'allow' => true,
                        'roles' => ['@'],
                    ],

            ], 

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ], 

        ]; 

    } 

} 
