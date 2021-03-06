<?php

namespace app\models;

use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\base\Model;

class LecturerSearch extends Model
{
    public $id;
    public $name;
    public $day;

    public function rules()
    {
        return [
            [['id', 'name', 'day'], 'safe']
        ];
    }

    /**
     * @param $query ActiveQuery
     */
    public function search($query, $params, $dataProviderParams = [])
    {
        $dataProviderParams['query'] = $query;

        $dataProvider = new ActiveDataProvider($dataProviderParams);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'day' => $this->day,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}