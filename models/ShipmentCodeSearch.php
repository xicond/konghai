<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ShipmentCode;

/**
 * ShipmentCodeSearch represents the model behind the search form about `app\models\ShipmentCode`.
 */
class ShipmentCodeSearch extends ShipmentCode
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'shipment_id', 'input_by', 'delete_by'], 'integer'],
            [['code', 'type', 'input_time', 'delete_time'], 'safe'],
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
        $query = ShipmentCode::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'shipment_id' => $this->shipment_id,
            'input_by' => $this->input_by,
            'delete_by' => $this->delete_by,
            'input_time' => $this->input_time,
            'delete_time' => $this->delete_time,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}
