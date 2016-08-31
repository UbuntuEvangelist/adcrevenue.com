<?php
namespace app\models;

use app\rbac\models\AuthItem;
use yii\data\ActiveDataProvider;
use yii\base\Model;
use Yii;


/**
 * UserSearch represents the model behind the search form for app\models\User.
 */
class UserSearch extends User
{
   
    public function rules()
    {
        return [
            [['username', 'email', 'status', 'item_name'], 'safe'],
        ];
    }

   
    public function scenarios()
    {
       
        return Model::scenarios();
    }
   
    public function search($params, $pageSize = 11)
    {
        $query = User::find()->joinWith('role');
        
        if (!Yii::$app->user->can('theCreator')) {
            $query->where(['!=', 'item_name', 'theCreator']);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_ASC]],
            'pagination' => ['pageSize' => $pageSize]
        ]);
        
        $dataProvider->sort->attributes['item_name'] = [
            'asc' => ['item_name' => SORT_ASC],
            'desc' => ['item_name' => SORT_DESC],
        ];

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
              ->andFilterWhere(['like', 'email', $this->email])
              ->andFilterWhere(['like', 'item_name', $this->item_name]);

        return $dataProvider;
    }
 
    public static function getRolesList()
    {
        $roles = [];

        foreach (AuthItem::getRoles() as $item_name) {
            $roles[$item_name->name] = $item_name->name;
        }

        return $roles;
    }
}
