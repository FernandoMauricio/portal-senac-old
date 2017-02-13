<?php

namespace app\modules\aux_planejamento\models\cadastros;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\aux_planejamento\models\cadastros\Segmento;

/**
 * SegmentoSearch represents the model behind the search form about `app\modules\aux_planejamento\models\cadastros\Segmento`.
 */
class SegmentoSearch extends Segmento
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['seg_codsegmento', 'seg_codeixo', 'seg_status'], 'integer'],
            [['seg_descricao'], 'safe'],
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
        $query = Segmento::find();

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
            'seg_codsegmento' => $this->seg_codsegmento,
            'seg_codeixo' => $this->seg_codeixo,
            'seg_status' => $this->seg_status,
        ]);

        $query->andFilterWhere(['like', 'seg_descricao', $this->seg_descricao]);

        return $dataProvider;
    }
}
