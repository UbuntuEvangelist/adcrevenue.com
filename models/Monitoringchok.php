<?php

namespace app\models;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;
use yii\web\UploadedFile;
use yii\helpers\Html;
use Yii;

/**
 * This is the model class for table "{{%monitoringchok}}".
 *
 * @property integer $kromikNong
 * @property string $noticeReceivedDate
 * @property integer $upazilaNam
 * @property string $mamlaNong
 * @property string $mamlarBochor
 * @property integer $biggAdaloterNam
 * @property string $emailSendingDate
 * @property string $sfReceiptDate
 * @property string $sfReceiptOriginalDate
 * @property string $sfSendToJusticeDate
 * @property string $montobo
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property Upazila $upazilaNam0
 * @property BiggAdalot $biggAdaloterNam0
 */
class Monitoringchok extends \yii\db\ActiveRecord
{
    
    public $file;
    const STATUS_FINISHED   = 10;
    const STATUS_INPROGRESS = 1;
    const STATUS_PENDING  = 0;
	
	public $statusList = [
        self::STATUS_FINISHED   => 'Finished',
        self::STATUS_INPROGRESS => 'In-Progress',
        self::STATUS_PENDING  => 'Pending'
    ];
	
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%monitoringchok}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['noticeReceivedDate', 'upazilaNam', 'mamlaNong', 'mamlarBochor'], 'required'],
            [['noticeReceivedDate', 'mamlarBochor', 'emailSendingDate', 'biggAdaloterNam', 'sfReceiptDate', 'sfReceiptOriginalDate', 'status', 'sfSendToJusticeDate', 'created_at', 'updated_at'], 'safe'],
            [['upazilaNam', 'biggAdaloterNam', 'status'], 'integer'],
            [['mamlaNong'], 'string', 'max' => 6],
            [['file'],'file'],
            [['scanfile'],'string'],
            [['montobo'], 'string', 'max' => 256],
            [['upazilaNam'], 'exist', 'skipOnError' => true, 'targetClass' => Upazila::className(), 'targetAttribute' => ['upazilaNam' => 'upazila_nong']],
            [['biggAdaloterNam'], 'exist', 'skipOnError' => true, 'targetClass' => BiggAdalot::className(), 'targetAttribute' => ['biggAdaloterNam' => 'biggAdalot_id']],
        ];
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
    
    public function getScanfileurl()
    {				
		//return \Yii::$app->request->baseUrl.'/'.$this->scanfile;
      if(!empty($this->scanfile)) {
	return Html::img(Yii::$app->request->baseUrl.'/'.$this->scanfile,['alt'=>'', 'class' => 'img-rounded', 'width'=>'100px','height'=>'100px','title'=>'www.ltb.com.bd']);	 
      } else {
        return Html::img(Yii::$app->request->baseUrl.'/'.'uploads/'.'scanfile.png',['alt'=>'', 'class' => 'img-rounded', 'width'=>'100px','height'=>'100px','title'=>'www.ltb.com.bd']);	 
      }      
    }
    
    public function getImageFile() 
    {
		if(isset($this->scanfile)){
			return $this->scanfile;
		}        
    }
	
	 public function uploadImage() {
        $image = UploadedFile::getInstance($this, 'scanfile');			              
        
		if (empty($image)) {
            return false;
        }		
		$this->file = $image->name;
        $ext = end((explode(".", $image->name)));        
        $this->scanfile = Yii::$app->security->generateRandomString().".{$ext}";
        
        return $image;        
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kromikNong' => Yii::t('app', 'Kromik Nong'),
            'noticeReceivedDate' => Yii::t('app', 'Notice Received Date'),
            'upazilaNam' => Yii::t('app', 'Upazila Nam'),
            'mamlaNong' => Yii::t('app', 'Mamla Nong'),
            'mamlarBochor' => Yii::t('app', 'Mamlar Bochor'),
            'biggAdaloterNam' => Yii::t('app', 'Bigg Adaloter Nam'),
            'emailSendingDate' => Yii::t('app', 'Email Sending Date'),
            'sfReceiptDate' => Yii::t('app', 'Sf Receipt Date'),
            'sfReceiptOriginalDate' => Yii::t('app', 'Sf Receipt Original Date'),
            'sfSendToJusticeDate' => Yii::t('app', 'Sf Send To Justice Date'),
            'montobo' => Yii::t('app', 'Montobo'),
            'status' => Yii::t('app', 'Status'),
            'scanfile' => Yii::t('app', 'Scan File'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
	
	public function getStatusName($status)
    {
        return $this->statusList[$status];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpazilaNam0()
    {
        return $this->hasOne(Upazila::className(), ['upazila_nong' => 'upazilaNam']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBiggAdaloterNam0()
    {
        return $this->hasOne(BiggAdalot::className(), ['biggAdalot_id' => 'biggAdaloterNam']);
    }
}
