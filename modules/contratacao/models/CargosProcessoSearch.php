<?php

namespace app\modules\contratacao\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\contratacao\models\CargosProcesso;

/**
 * CargosProcessoSearch represents the model behind the search form about `app\models\CargosProcesso`.
 */
class CargosProcessoSearch extends CargosProcesso
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cargo_id', 'processo_id'], 'integer'],
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
        $query = CargosProcesso::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'cargo_id' => $this->cargo_id,
            'processo_id' => $this->processo_id,
        ]);

        return $dataProvider;
    }
}
