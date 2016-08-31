<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%userof}}".
 *
 * @property integer $userof_id
 * @property string $title
 *
 * @property User[] $users
 */
class Userof extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%userof}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userof_id' => Yii::t('app', 'Userof ID'),
            'title' => Yii::t('app', 'Title'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['userof' => 'userof_id']);
    }
}
