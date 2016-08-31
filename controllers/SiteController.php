<?php
namespace app\controllers;

use app\models\User;
use app\models\LoginForm;
use app\models\AccountActivation;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\SignupForm;
use app\models\ContactForm;
use yii\helpers\Html;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;


class SiteController extends Controller
{
   
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                			
				'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'signup'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

   
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    public function actionIndex()
    {
        return $this->render('index');
    }	
	
	public function actionAdarsa()
    {
		$this->layout = 'dashboard';
        return $this->render('adarsa');
    }
	
	public function actionSadar()
    {
		$this->layout = 'dashboard';
        return $this->render('sadar');
    }
	
	public function actionBarura()
    {
		$this->layout = 'dashboard';
        return $this->render('barura');
    }
	
	public function actionChandina()
    {
		$this->layout = 'dashboard';
        return $this->render('chandina');
    }
	
	public function actionDaudkandi()
    {
		$this->layout = 'dashboard';
        return $this->render('daudkandi');
    }
	
	public function actionLaksam()
    {
		$this->layout = 'dashboard';
        return $this->render('laksam');
    }
	
	public function actionBrahmanpara()
    {
		$this->layout = 'dashboard';
        return $this->render('brahmanpara');
    }
	
	public function actionBurichong()
    {
		$this->layout = 'dashboard';
        return $this->render('burichong');
    }
	
	public function actionChauddagram()
    {
		$this->layout = 'dashboard';
        return $this->render('chauddagram');
    }
	
	public function actionDebidwar()
    {
		$this->layout = 'dashboard';
        return $this->render('debidwar');
    }
	
	public function actionHomna()
    {
		$this->layout = 'dashboard';
        return $this->render('homna');
    }
	
	public function actionMuradnagar()
    {
		$this->layout = 'dashboard';
        return $this->render('muradnagar');
    }
	
	public function actionNangalkot()
    {
		$this->layout = 'dashboard';
        return $this->render('nangalkot');
    }
	
	public function actionMeghna()
    {
		$this->layout = 'dashboard';
        return $this->render('meghna');
    }
	
	public function actionTitas()
    {
		$this->layout = 'dashboard';
        return $this->render('titas');
    }
	
	public function actionMonohorgonj()
    {
		$this->layout = 'dashboard';
        return $this->render('monohorgonj');
    }
    
    	public function actionAdalot1()
    {
		$this->layout = 'dashboard';
        return $this->render('adalot1');
    }
	
	public function actionAdalot2()
    {
		$this->layout = 'dashboard';
        return $this->render('adalot2');
    }
	
	public function actionAdalot3()
    {
		$this->layout = 'dashboard';
        return $this->render('adalot3');
    }
	
	public function actionAdalot4()
    {
		$this->layout = 'dashboard';
        return $this->render('adalot4');
    }
	
	public function actionAdalot5()
    {
		$this->layout = 'dashboard';
        return $this->render('adalot5');
    }
	
	public function actionAdalot6()
    {
		$this->layout = 'dashboard';
        return $this->render('adalot6');
    }
	
	public function actionAdalot7()
    {
		$this->layout = 'dashboard';
        return $this->render('adalot7');
    }
	
	public function actionAdalot8()
    {
		$this->layout = 'dashboard';
        return $this->render('adalot8');
    }
	
	public function actionAdalot9()
    {
		$this->layout = 'dashboard';
        return $this->render('adalot9');
    }
	
	public function actionAdalot10()
    {
		$this->layout = 'dashboard';
        return $this->render('adalot10');
    }
	
	public function actionAdalot11()
    {
		$this->layout = 'dashboard';
        return $this->render('adalot11');
    }
	
	public function actionAdalot12()
    {
		$this->layout = 'dashboard';
        return $this->render('adalot12');
    }
	
	public function actionAdalot13()
    {
		$this->layout = 'dashboard';
        return $this->render('adalot13');
    }
	
	public function actionAdalot14()
    {
		$this->layout = 'dashboard';
        return $this->render('adalot14');
    }
	
	public function actionAdalot15()
    {
		$this->layout = 'dashboard';
        return $this->render('adalot15');
    }
	
	public function actionAdalot16()
    {
		$this->layout = 'dashboard';
        return $this->render('adalot16');
    }
	
	public function actionAdalot17()
    {
		$this->layout = 'dashboard';
        return $this->render('adalot17');
    }
	
	public function actionAdalot18()
    {
		$this->layout = 'dashboard';
        return $this->render('adalot18');
    }
	
	public function actionAdalot19()
    {
		$this->layout = 'dashboard';
        return $this->render('adalot19');
    }
	
	public function actionAdalot20()
    {
		$this->layout = 'dashboard';
        return $this->render('adalot20');
    }
	
	public function actionAdalot21()
    {
		$this->layout = 'dashboard';
        return $this->render('adalot21');
    }
	
	public function actionAdalot22()
    {
		$this->layout = 'dashboard';
        return $this->render('adalot22');
    }
	
	public function actionAdalot23()
    {
		$this->layout = 'dashboard';
        return $this->render('adalot23');
    }
	
	public function actionAdalot24()
    {
		$this->layout = 'dashboard';
        return $this->render('adalot24');
    }

    /**
     * Displays the about static page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Displays the contact static page and sends the contact email.
     *
     * @return string|\yii\web\Response
     */
    public function actionContact()
    {
        $model = new ContactForm();

        if (!$model->load(Yii::$app->request->post()) || !$model->validate()) {
            return $this->render('contact', ['model' => $model]);
        }

        if (!$model->sendEmail(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('error', Yii::t('app', 'There was some error while sending email.'));
            return $this->refresh();
        }

        Yii::$app->session->setFlash('success', Yii::t('app', 
            'Thank you for contacting us. We will respond to you as soon as possible.'));
        
        return $this->refresh();
    }


    public function actionLogin()
    {
        
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
			

       
        $lwe = Yii::$app->params['lwe'];

       
        $model = $lwe ? new LoginForm(['scenario' => 'lwe']) : new LoginForm();

        
        $successfulLogin = true;

        
        if (!$model->load(Yii::$app->request->post()) || !$model->login()) {
            $successfulLogin = false;
        }

        
        if ($model->status === User::STATUS_INACTIVE && $successfulLogin === false) {
            Yii::$app->session->setFlash('error', Yii::t('app', 
                'You have to activate your account first. Please check your email.'));
            return $this->refresh();
        } 

        
        if ($successfulLogin === false) {
            return $this->render('login', ['model' => $model]);
        }

        
		
	return $this->redirect(['monitoringchok/index']);
		
    }

  
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();

        if (!$model->load(Yii::$app->request->post()) || !$model->validate()) {
            return $this->render('requestPasswordResetToken', ['model' => $model]);
        }

        if (!$model->sendEmail()) {
            Yii::$app->session->setFlash('error', Yii::t('app', 
                'Sorry, we are unable to reset password for email provided.'));
            return $this->refresh();
        }

        Yii::$app->session->setFlash('success', Yii::t('app', 'Check your email for further instructions.'));

        return $this->goHome();
    }

  
    public function actionResetPassword($token)
    {
		
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if (!$model->load(Yii::$app->request->post()) || !$model->validate() || !$model->resetPassword()) {
            return $this->render('resetPassword', ['model' => $model]);
        }

        Yii::$app->session->setFlash('success', Yii::t('app', 'New password was saved.'));

        return $this->goHome();      
    }    
    

 
    private function signupWithActivation($model, $user)
    {
		$connection = \Yii::$app->db;
        $q = $connection->createCommand('SELECT count(id) AS user FROM ltb_user')->queryOne();		
		$r = current($q) ;				
		if ($r <= 3) 			
		{
        
        if (!$model->sendAccountActivationEmail($user)) {
           
            Yii::$app->session->setFlash('error', Yii::t('app', 
                'We couldn\'t send you account activation email, please contact us.'));

          
            Yii::error('Signup failed! User '.Html::encode($user->username).' could not sign up. 
                Possible causes: verification email could not be sent.');
        }

        
        Yii::$app->session->setFlash('success', Yii::t('app', 'Hello').' '.Html::encode($user->username). '. ' .
            Yii::t('app', 'To be able to log in, you need to confirm your registration. 
                Please check your email, we have sent you a message.'));
				
		} else {
			echo 'Dear admin you have already create 4 user';
		}
    }


    public function actionActivateAccount($token)
    {
        try {
            $user = new AccountActivation($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if (!$user->activateAccount()) {
            Yii::$app->session->setFlash('error', Html::encode($user->username). Yii::t('app', 
                ' your account could not be activated, please contact us!'));
            return $this->goHome();
        }

        Yii::$app->session->setFlash('success', Yii::t('app', 'Success! You can now log in.').' '.
            Yii::t('app', 'Thank you').' '.Html::encode($user->username).' '.Yii::t('app', 'for joining us!'));

        return $this->redirect('login');
    }
}
