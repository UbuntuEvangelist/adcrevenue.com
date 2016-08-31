<?php
namespace app\controllers;

use app\models\User;
use app\models\UserSearch;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Setup;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use Yii;


class UserController extends AppController
{
    
    protected $_pageSize = 10;

   
    public function actionIndex()
    {
		$this->layout = 'dashboard';
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $this->_pageSize);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	public function behaviors()
	{
		return [
			'timestamp' => [
				'class' => TimestampBehavior::className(),
				'attributes' => [
					ActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
					ActiveRecord::EVENT_BEFORE_UPDATE => 'update_at',
				],
				'value' => function() { 
					return date('U'); // unix timestamp 
				},
			],
		];
	}
   
    public function actionView($id)
    {
		$this->layout = 'dashboard';
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

  
    public function actionCreate()
    {
		$this->layout = 'dashboard';
        $user = new User(['scenario' => 'create']);

        if (!$user->load(Yii::$app->request->post())) {
            return $this->render('create', ['user' => $user]);
        }
        
	if ($user->file = UploadedFile::getInstance($user,'photo')) 
	{
	        $userName = $user->username;
		$user->file->saveAs('uploads/'.$userName.'.'.$user->file->extension);			
		$user->photo = 'uploads/'.$userName.'.'.$user->file->extension;
	}
	
        $user->setPassword($user->password);
        $user->generateAuthKey();
		//$user->created_at = date('Y-m-d h:m:s');		

        if (!$user->save()) {
            return $this->render('create', ['user' => $user]);
        }

        $auth = Yii::$app->authManager;
        $role = $auth->getRole($user->item_name);
        $info = $auth->assign($role, $user->getId());

        if (!$info) {
            Yii::$app->session->setFlash('error', Yii::t('app', 'There was some error while saving user role.'));
        }

        return $this->redirect('index');
    }

   
    public function actionUpdate($id)
    {
		$this->layout = 'dashboard';
       
        $user = $this->findModel($id);

        $auth = Yii::$app->authManager;        
       
        if ($roles = $auth->getRolesByUser($id)) {
          
            $role = array_keys($roles)[0]; 
        }

        
        $oldRole = (isset($role)) ? $auth->getRole($role) : $auth->getRole('officeassistant');

        
        $user->item_name = $oldRole->name;

        if (!$user->load(Yii::$app->request->post())) {
            return $this->render('update', ['user' => $user, 'role' => $user->item_name]);
        }

      
        if ($user->password) {
            $user->setPassword($user->password);
        }

       
        if ($user->status == User::STATUS_ACTIVE && $user->account_activation_token != null) {
            $user->removeAccountActivationToken();
        }         
	if ($user->load(Yii::$app->request->post())) {
		if( $user->save() ) {			
		if ($user->photo !== false) { 
			if ($user->file = UploadedFile::getInstance($user,'photo')) 
			{
				$userName = $user->username;				
				$user->file->saveAs('uploads/'.$userName.'.'.$user->file->extension);			
				$user->photo = 'uploads/'.$userName.'.'.$user->file->extension;
				
			} else {
				$oldfile = $user->getImageFile();
				//$oldfile = 'uploads/profilePhoto.jpg';
				$user->photo = $oldfile;	 	 					 
				// echo '<h1>'.'Add Profile Photo'.'</h1>';
				// return $this->render('update', ['user' => $user, 'role' => $user->item_name]);
			}
		    }
		}
	}
        if (!$user->save()) {
            return $this->render('update', ['user' => $user, 'role' => $user->item_name]);
        }

        
        $newRole = $auth->getRole($user->item_name);
        
        $userId = $user->getId();
        
        
        if ($auth->revoke($oldRole, $userId)) {
            $info = $auth->assign($newRole, $userId);
        }

      
        if (!isset($role)) {
            $info = $auth->assign($newRole, $userId);
        }

        if (!$info) {
            Yii::$app->session->setFlash('error', Yii::t('app', 'There was some error while saving user role.'));
        }

       
		return $this->redirect('index');
    }

   
    public function actionDelete($id)
    {
		$this->layout = 'dashboard';        
        if (!$this->findModel($id)->delete()) {
            throw new ServerErrorHttpException(Yii::t('app', 'We could not delete this user.'));
        }

        $auth = Yii::$app->authManager;
        $info = true; 

       
        if ($roles = $auth->getRolesByUser($id)) {
          
            $role = array_keys($roles)[0]; 
        }

       
        if (isset($role)) {
            $info = $auth->revoke($auth->getRole($role), $id);
        }

        if (!$info) {
            Yii::$app->session->setFlash('error', Yii::t('app', 'There was some error while deleting user role.'));
            return $this->redirect(['index']);
        }

        Yii::$app->session->setFlash('success', Yii::t('app', 'You have successfuly deleted user and his role.'));
        
        return $this->redirect(['index']);
    }

  
    protected function findModel($id)
    {
        $model = User::findOne($id);

        if (is_null($model)) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        } 

        return $model;
    }
}
