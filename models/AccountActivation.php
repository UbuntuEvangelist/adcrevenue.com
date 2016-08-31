<?php
namespace app\models;

use yii\base\InvalidParamException;
use yii\base\Model;
use Yii;

class AccountActivation extends Model
{    
    private $_user;
   
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException(Yii::t('app', 'Account activation token cannot be blank.'));
        }

        $this->_user = User::findByAccountActivationToken($token);

        if (!$this->_user) {
            throw new InvalidParamException(Yii::t('app', 'Wrong account activation token.'));
        }

        parent::__construct($config);
    }
    
    public function activateAccount()
    {
        $user = $this->_user;
        
        $user->status = User::STATUS_ACTIVE;
        $user->removeAccountActivationToken();

        return $user->save();
    }
   
    public function getUsername()
    {
        $user = $this->_user;

        return $user->username;
    }
}
