<?php
namespace app\models;

use kartik\password\StrengthValidator;
use yii\base\InvalidParamException;
use yii\base\Model;
use Yii;

/**
 * Password reset form.
 */
class ResetPasswordForm extends Model
{
    public $password;

   
    private $_user;
    
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException(Yii::t('app', 'Password reset token cannot be blank.'));
        }

        $this->_user = User::findByPasswordResetToken($token);

        if (!$this->_user) {
            throw new InvalidParamException(Yii::t('app', 'Wrong password reset token.'));
        }

        parent::__construct($config);
    }
    
    public function rules()
    {
        return [
            ['password', 'required'],
          
            $this->passwordStrengthRule(),
        ];
    }
   
    private function passwordStrengthRule()
    {        
        $fsp = Yii::$app->params['fsp'];
       
        $strong = [['password'], StrengthValidator::className(), 'min' => 8, 'lower' => 2, 'upper' => 2, 
            'digit' => 2, 'special' => 0, 'hasUser' => false, 'hasEmail' => false];
        
        $normal = ['password', 'string', 'min' => 6];
        
        return ($fsp) ? $strong : $normal;
    }

    public function attributeLabels()
    {
        return [
            'password' => Yii::t('app', 'Password'),
        ];
    }

    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();

        return $user->save();
    }
}
