<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%upazila}}".
 *
 * @property integer $upazila_nong
 * @property string $upazila_nam
 *
 * @property Monitoringchok[] $monitoringchoks
 */
class Upazila extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%upazila}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['upazila_nam'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'upazila_nong' => 'Upazila Nong',
            'upazila_nam' => 'Upazila Nam',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMonitoringchoks()
    {
        return $this->hasMany(Monitoringchok::className(), ['upazilaNam' => 'upazila_nong']);
    }
}
