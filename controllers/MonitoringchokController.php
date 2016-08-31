<?php

namespace app\controllers;

use Yii;
use app\models\Monitoringchok;
use app\models\Notification;
use app\models\MonitoringchokSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MonitoringchokController implements the CRUD actions for Monitoringchok model.
 */
class MonitoringchokController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];		
    }

    /**
     * Lists all Monitoringchok models.
     * @return mixed
     */
    public function actionIndex()
    {
		$this->layout = 'dashboard';
        $searchModel = new MonitoringchokSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Monitoringchok model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		$this->layout = 'dashboard';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Monitoringchok model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		$this->layout = 'dashboard';
        $model = new Monitoringchok();
        $recipient_id = 41;
		$userOf = \Yii::$app->user->identity->userof;
        if ($model->load(Yii::$app->request->post())) {
	        if($model->file = UploadedFile::getInstance($model, 'scanfile'))
	        {
	            $mamlaNong = $model->mamlaNong;
				$model->file->saveAs('uploads/'.$mamlaNong.'.'.$model->file->extension);			
				$model->scanfile = 'uploads/'.$mamlaNong.'.'.$model->file->extension;
		    }
		    
		    if($userOf == 17 || $userOf == 18 || $userOf == 19 || $userOf == 20 || $userOf == 21 || $userOf == 22 || $userOf == 23 || $userOf == 24 || $userOf == 25 || $userOf == 26 || $userOf == 27 || $userOf == 28 || $userOf == 29 || $userOf == 30 || $userOf == 31 || $userOf == 32 || $userOf == 33 || $userOf == 34 || $userOf == 35 || $userOf == 36 || $userOf == 37 || $userOf == 38 || $userOf == 39 || $userOf == 40 ) {
				$model->biggAdaloterNam = \Yii::$app->user->identity->userof;
			}     					
			if($model->save()) {				
				Notification::notify(Notification::KEY_NEW_CASE, $recipient_id, $model->kromikNong);	
			}
            //return $this->redirect(['view', 'id' => $model->kromikNong]);
            return $this->redirect('index');
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Monitoringchok model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		$this->layout = 'dashboard';
        $model = $this->findModel($id);
		$oldfile = $model->getImageFile();		
        if ($model->load(Yii::$app->request->post())) {
        	$image = $model->uploadImage();
			if ($image !== false) { 
				$path = $model->getImageFile();
				$image->saveAs($path);
			} else {			
				$model->scanfile = $oldfile;
			}	        	
				$recipient_id = $model->upazilaNam;
				if (($model->emailSendingDate) == '0000-00-00' || ($model->emailSendingDate) == '' || $model->emailSendingDate <= $model->emailSendingDate) {
					Notification::notify(Notification::KEY_CASE_REMINDER_EMAIL, $recipient_id, $model->mamlaNong);
				}
				if(($model->sfReceiptDate) == '0000-00-00' || ($model->sfReceiptDate) == '' || $model->sfReceiptDate <= $model->sfReceiptDate) {
					Notification::notify(Notification::KEY_CASE_REMINDER_SF_RECEIPT_DATE, $recipient_id, $model->mamlaNong);
				}
				$recipient_id = 41;
				if(($model->sfReceiptOriginalDate) == '0000-00-00' || ($model->sfReceiptOriginalDate) == '' || $model->sfReceiptOriginalDate <= $model->sfReceiptOriginalDate) {
					Notification::notify(Notification::KEY_CASE_REMINDER_SF_ORIGINAL_RECEIPT_DATE, $recipient_id, $model->mamlaNong);
				}
				$recipient_id = $model->biggAdaloterNam;
				if(($model->sfSendToJusticeDate) == '0000-00-00' || ($model->sfSendToJusticeDate) == '' || $model->sfSendToJusticeDate <= $model->sfSendToJusticeDate) {
					Notification::notify(Notification::KEY_CASE_REMINDER_SF_DATE_FOR_COURT, $recipient_id, $model->mamlaNong);
				}
	            
            $model->save();
            return $this->redirect('index');
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Monitoringchok model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		$this->layout = 'dashboard';
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Monitoringchok model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Monitoringchok the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Monitoringchok::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
