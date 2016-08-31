<?php
namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;
use yii\helpers\Html;
use yii\web\UploadedFile;
use Yii;

/**
 * UserIdentity class for "user" table.
 * This is a base user class that is implementing IdentityInterface.
 * User model should extend from this model, and other user related models should
 * extend from User model.
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $designation
 * @property string $address
 * @property string $username
 * @property string $email
 * @property integer $mobile_no
 * @property string $password_hash
 * @property integer $status
 * @property integer $userof
 * @property string $auth_key
 * @property string $password_reset_token
 * @property string $account_activation_token
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property Monitoringchok[] $monitoringchoks
 * @property Userof $userof0
 */
class UserIdentity extends ActiveRecord implements IdentityInterface
{
    /**
     * Declares the name of the database table associated with this AR class.
     *
     * @return string
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => User::STATUS_ACTIVE]);
    }
    
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
   
    public function getId()
    {
        return $this->getPrimaryKey();
    }
  
    public function getAuthKey()
    {
        return $this->auth_key;
    }
   
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

	public function authenticate()
	{
		$users= [			
			'beet'=>'sara',
		];
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}
	
	
   
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
   
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }        
    
    public function getImageurl()
	{		
		if(!empty($this->photo)) {
			return Html::img(Yii::$app->request->baseUrl.'/'.$this->photo,['alt'=>'', 'class' => 'img-circle', 'width'=>'40px','height'=>'40px','title'=>'']);	 
		} else {
return Html::img(Yii::$app->request->baseUrl.'/'.'uploads/'.'profilePhoto.jpg',['alt'=>'', 'class' => 'img-circle', 'width'=>'40px','height'=>'40px','title'=>'']);	 
		}		
	}
    public function getPhotourl()
	   {	
	   	if(!empty($this->photo))
	   	{					
			return Html::img(Yii::$app->request->baseUrl.'/'.$this->photo,['alt'=>'', 'class' => 'img-circle', 'width'=>'40px','height'=>'40px','title'=>'image title']);
		} else {
	return Html::img(Yii::$app->request->baseUrl.'/'.'uploads/'.'profilePhoto.jpg',['alt'=>'', 'class' => 'img-circle', 'width'=>'40px','height'=>'40px','title'=>'image title']);
		}	 
	   }

	public function getImageFile() 
    	{
		if(isset($this->photo)){
			return $this->photo;
		}        
    	}
	
    public function uploadImage() {
        $image = UploadedFile::getInstance($this, 'photo');			              
        
	if (empty($image)) {
            return false;
        }		
	$this->file = $image->name;
        $ext = end((explode(".", $image->name)));        
        $this->photo = Yii::$app->security->generateRandomString().".{$ext}";
        
        return $image;
        
    }
}