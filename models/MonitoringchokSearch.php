<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Monitoringchok;

/**
 * MonitoringchokSearch represents the model behind the search form about `app\models\Monitoringchok`.
 */
class MonitoringchokSearch extends Monitoringchok
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kromikNong', 'upazilaNam', 'biggAdaloterNam', 'created_by', 'updated_by'], 'integer'],
            [['noticeReceivedDate', 'mamlaNong', 'mamlarBochor', 'status', 'emailSendingDate', 'sfReceiptDate', 'sfReceiptOriginalDate', 'sfSendToJusticeDate', 'montobo', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Monitoringchok::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['kromikNong'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }				
		
		$userOf = \Yii::$app->user->identity->userof;
		if($userOf === 17 || $userOf === 18 || $userOf === 19 || $userOf === 20 || $userOf === 21 || $userOf === 22 || $userOf === 23 || $userOf === 24 || $userOf === 25 || $userOf === 26 || $userOf === 27 || $userOf === 28 || $userOf === 29 || $userOf === 30 || $userOf === 31 || $userOf === 32 || $userOf === 33 || $userOf === 34 || $userOf === 35 || $userOf === 36 || $userOf === 37 || $userOf === 38 || $userOf === 39 || $userOf === 40 ) {
			$this->biggAdaloterNam = \Yii::$app->user->identity->userof;
			$query->andFilterWhere([
				'kromikNong' => $this->kromikNong,
				'status' => $this->status,			
			]);
			$query->andFilterWhere(['like', 'biggAdaloterNam', $this->biggAdaloterNam])
				->andFilterwhere(['!=', 'status', '10'])
				  ->andFilterwhere(['=', 'status', '1']);
				  Monitoringchok::deleteAll(['status' => Monitoringchok::STATUS_FINISHED]);
			return $dataProvider;
		} elseif ($userOf === 1 || $userOf === 2 || $userOf === 3 || $userOf === 4 || $userOf === 5 || $userOf === 6 || $userOf === 7 || $userOf === 8 || $userOf === 9 || $userOf === 10 || $userOf === 11 || $userOf === 12 || $userOf === 13 || $userOf === 14 || $userOf === 15 || $userOf === 16) {
			$this->upazilaNam = \Yii::$app->user->identity->userof;
			$query->andFilterWhere([
				'kromikNong' => $this->kromikNong,
				'status' => $this->status,			
			]);
			$query->andFilterWhere(['like', 'upazilaNam', $this->upazilaNam])
				->andFilterwhere(['!=', 'status', '10'])
				  ->andFilterwhere(['=', 'status', '1']);
				  Monitoringchok::deleteAll(['status' => Monitoringchok::STATUS_FINISHED]);			
			return $dataProvider;
		 } else {
			$query->andFilterWhere([
				'kromikNong' => $this->kromikNong,
				'status' => $this->status,
				'created_at' => $this->created_at,
				'updated_at' => $this->updated_at,
			]);
			

			$query->andFilterwhere(['!=', 'status', '10'])
				  ->andFilterwhere(['=', 'status', '1']);
				  Monitoringchok::deleteAll(['status' => Monitoringchok::STATUS_FINISHED]);

			return $dataProvider;
		}        		
				
    }
}