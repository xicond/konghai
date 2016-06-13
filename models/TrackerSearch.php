<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tracker;

/**
 * TrackerSearch represents the model behind the search form about `app\models\Tracker`.
 */
class TrackerSearch extends Tracker
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'shipment_id', 'input_by', 'update_by'], 'integer'],
            [['shipment_code', 'status', 'track_date', 'track_time', 'input_time', 'update_time', 'description', 'history'], 'safe'],
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
        $query = Tracker::find();

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
            'track_date' => $this->track_date,
            'track_time' => $this->track_time,
            'input_by' => $this->input_by,
            'input_time' => $this->input_time,
            'update_by' => $this->update_by,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'shipment_code', $this->shipment_code])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'history', $this->history]);

        return $dataProvider;
    }
}
