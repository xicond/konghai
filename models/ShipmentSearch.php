<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Shipment;

/**
 * ShipmentSearch represents the model behind the search form about `app\models\Shipment`.
 */
class ShipmentSearch extends Shipment
{
    /**
     * @inheritdoc
     */
//    public function rules()
//    {
//        return [
//            [['id', 'input_by', 'update_by'], 'integer'],
//            [['from', 'to', 'address_to', 'history', 'input_time', 'update_time', 'description', 'address_from'], 'safe'],
//        ];
//    }

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
        $query = Shipment::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->setScenario('search');
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
//            die(json_encode($this->errors));
            return null;
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'input_by' => $this->input_by,
            'update_by' => $this->update_by,
            'input_time' => $this->input_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'from', $this->from])
            ->andFilterWhere(['like', 'to', $this->to])
            ->andFilterWhere(['like', 'address_to', $this->address_to])
            ->andFilterWhere(['like', 'marking_code', $this->marking_code])
            ->andFilterWhere(['like', 'address_from', $this->address_from]);

//            die(json_encode($query->sql));

        return $dataProvider;
    }
}
