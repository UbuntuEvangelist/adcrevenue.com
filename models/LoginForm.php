<?php
namespace app\models;

use yii\base\Model;
use Yii;
use app\rbac\models\AuthItem;


class LoginForm extends Model
{
    public $username;
    public $email;
    public $password;
	public $role;
    public $rememberMe = true;
    public $status;
	public $captcha;


    private $_user = false;

    
    public function rules()
    {
        return [
            ['email', 'email'],
            ['password', 'validatePassword'],
            ['rememberMe', 'boolean'],            
            [['username', 'password'], 'required', 'on' => 'default'],            
            [['email', 'password'], 'required', 'on' => 'lwe'],			
			// [['role'], 'required','message'=> 'ব্যবহারকারীর ধরন ফাঁকা রাখা যাবে না.'],
			// ['role', 'validateRole', 'skipOnEmpty' => false, 'skipOnError' => false],
			//['captcha',\himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => '6LdfhyETAAAAAB-naqs5S8sRlKfeWFfr_XKrKLIy'],
        ];
    }

  
    public function validatePassword($attribute, $params)
    {
        if ($this->hasErrors()) {
            return false;
        }

        $user = $this->getUser();

        if (!$user || !$user->validatePassword($this->password)) {
            
            $field = ($this->scenario === 'lwe') ? 'email' : 'username' ;

            $this->addError($attribute, 'Incorrect '.$field.' or password.');
        }
    }
	
	// public function validateRole($attribute, $params)
    // {				
		// $user_id = $this->getUser()->id;
		// $user = \Yii::$app->authManager->getRolesByUser($user_id);
		// if (!in_array($this->$attribute, [$user])) {
			// $this->addError($attribute, 'ব্যবহারকারী টাইপ মিলছে না');
		// }
        
    // }

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'email' => Yii::t('app', 'Email'),
            'rememberMe' => Yii::t('app', 'Remember me'),
        ];
    }


    public function login()
    {
        if (!$this->validate()) {
            return false;
        }

        $user = $this->getUser();

        if (!$user) {
            return false;
        }

        
        if ($user->status == User::STATUS_INACTIVE) {
            $this->status = $user->status;
            return false;
        }
 
        return Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
    }


    private function findUser()
    {
        if (!($this->scenario === 'lwe')) {
            return User::findByUsername($this->username);
        }

        return $this->_user = User::findByEmail($this->email);   
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = $this->findUser();
        }

        return $this->_user;
    }
}
