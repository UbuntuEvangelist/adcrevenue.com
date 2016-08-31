<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%bigg_adalot}}".
 *
 * @property integer $biggAdalot_id
 * @property string $biggAdaloterNam
 *
 * @property Monitoringchok[] $Monitoringchoks
 */
class BiggAdalot extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bigg_adalot}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['biggAdaloterNam'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'biggAdalot_id' => Yii::t('app', 'Bigg Adalot ID'),
            'biggAdaloterNam' => Yii::t('app', 'Bigg Adaloter Nam'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMonitoringchoks()
    {
        return $this->hasMany(Monitoringchok::className(), ['biggAdalotNam' => 'biggAdalot_id']);
    }
}
