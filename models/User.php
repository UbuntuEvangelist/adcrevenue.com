<?php
namespace app\models;

use app\rbac\models\Role;
use kartik\password\StrengthValidator;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;
use yii\helpers\Html;
use Yii;


class User extends UserIdentity
{
    
    public $file;
    const STATUS_ACTIVE   = 10;
    const STATUS_INACTIVE = 1;    

    
    public $statusList = [
        self::STATUS_ACTIVE   => 'Active',
        self::STATUS_INACTIVE => 'Inactive',        
    ];

   
    public $password;

  
    public $item_name;

  
    public function rules()
    {
        return [
            [['username','first_name','last_name','designation','address'], 'filter', 'filter' => 'trim'],
            ['username', 'required','message'=> 'ব্যবহারকারীর নাম ফাঁকা রাখা যাবে না.'],
            [['username'], 'match', 'pattern' => '/^[a-zA-Z]+$/','message'=>Yii::t('app','শুধুমাত্র বর্ণানুক্রমিক অক্ষর শব্দ টাইপ করুন।') ],
            [['first_name','last_name','designation'], 'match', 'pattern' => '/^[a-zA-Z. ]+$/','message'=>Yii::t('app','শুধুমাত্র বর্ণানুক্রমিক অক্ষর ও . শব্দ টাইপ করুন।') ],
			[['first_name','last_name','designation','address', 'mobile_no'], 'required','message'=> 'এই ক্ষেত্র পূরণ করতে হবে'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'এই ব্যবহারকারীর নাম ইতিমধ্যেই নেওয়া হয়েছে ।'],
            [['username','first_name','last_name','designation'], 'string', 'min' => 2, 'max' => 64, 'message' => 'কমপক্ষে 2 টি অক্ষর থাকা উচিত'],
			['address', 'string', 'min' => 2, 'max' => 255, 'message' => 'কমপক্ষে 2 টি অক্ষর থাকা উচিত'],
			[['mobile_no'], 'match', 'pattern' => '/^[0-9]+$/','message'=>Yii::t('app','শুধুমাত্র সংখ্যাসূচক অক্ষর টাইপ করুন ।') ],  	   
			['mobile_no', 'integer', 'min' => 11, 'message'=>'মোবাইল নম্বর অন্তত 11 টি অক্ষর থাকা উচিত'],  	   	    
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['username', 'match',  'not' => true,
                
                'pattern' => '/\b('.Yii::$app->params['user.spamNames'].')\b/i',
                'message' => Yii::t('app', 'It\'s impossible to have that username.')],          
            ['username', 'unique', 
                'message' => Yii::t('app', 'This username has already been taken.')],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required','message'=> 'ই-মেইল নাম ফাঁকা রাখা যাবে না.'],
            ['email', 'email'],
            ['email', 'string', 'max' => 32],
            ['email', 'unique', 
                'message' => Yii::t('app', 'This email address has already been taken.')],

            ['password', 'string', 'min' => 6,'max'=>32],
            ['password', 'required', 'on' => 'create'],
            [['userof'], 'integer'],
            $this->passwordStrengthRule(),
            ['item_name', 'required'],
            [['file'],'file'],
	    [['photo'], 'string'],	
            ['status', 'required'],
            ['item_name', 'string', 'min' => 3, 'max' => 64]
        ];
    }
    
    

    private function passwordStrengthRule()
    {
        
        $fsp = Yii::$app->params['fsp'];

        
        $strong = [['password'], StrengthValidator::className(), 'preset'=>'normal'];

        
        $normal = ['password', 'string', 'min' => 6];

        
        return ($fsp) ? $strong : $normal;
    }


    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
                ],
             
        ];
    }

 
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
			'first_name' => Yii::t('app', 'First Name'),
			'last_name' => Yii::t('app', 'Last Name'),
			'designation' => Yii::t('app', 'Designation'),
			'address' => Yii::t('app', 'Address'),
			'mobile_no' => Yii::t('app', 'Mobile No'),
			'userof' => Yii::t('app', 'Userof'),
            'password' => Yii::t('app', 'Password'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'photo' => Yii::t('app', 'Photo'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'item_name' => Yii::t('app', 'Role'),
        ];
    }

  
    public function getRole()
    {
        
        return $this->hasOne(Role::className(), ['user_id' => 'id']);
    }


    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }  
    
  
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    } 

    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => User::STATUS_ACTIVE,
        ]);
    }


    public static function findByAccountActivationToken($token)
    {
        return static::findOne([
            'account_activation_token' => $token,
            'status' => User::STATUS_INACTIVE,
        ]);
    }
  

    public function getStatusName($status)
    {
        return $this->statusList[$status];
    }

 
    public function getRoleName()
    {
        
        if ($this->role) {
            return $this->role->item_name;
        }
        
        
        return '@uthenticated';
    }

    
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }
    
    
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

  
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

 
    public function generateAccountActivationToken()
    {
        $this->account_activation_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

 
    public function removeAccountActivationToken()
    {
        $this->account_activation_token = null;
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
	
	  /**
     * @return \yii\db\ActiveQuery
     */
    public function getMonitoringchoks()
    {
        return $this->hasMany(Monitoringchok::className(), ['userof' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserof0()
    {
        return $this->hasOne(Userof::className(), ['userof_id' => 'userof']);
    }
}
