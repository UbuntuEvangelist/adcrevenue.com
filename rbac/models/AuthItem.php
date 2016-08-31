<?php
namespace app\rbac\models;

use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "auth_item".
 *
 * @property string  $name
 * @property integer $type
 * @property string  $description
 * @property string  $rule_name
 * @property string  $data
 * @property integer $created_at
 * @property integer $updated_at
 */
class AuthItem extends ActiveRecord
{
    /**
     * Declares the name of the database table associated with this AR class.
     *
     * @return string
     */
    public static function tableName()
    {
        return '{{%auth_item}}';
    }

    /**
     * Returns roles.
     * NOTE: used in user/index and user/update.
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getRoles()
    {        
        if (!Yii::$app->user->can('theCreator')) {
            return static::find()->select('name')->where(['type' => 1])->andWhere(['!=', 'name', 'theCreator'])->all();
        }
		
        return static::find()->select('name')->where(['type' => 1])->all(); 
    }        
}
