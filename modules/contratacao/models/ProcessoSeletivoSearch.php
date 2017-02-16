<?php

namespace app\modules\contratacao\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\contratacao\models\ProcessoSeletivo;

/**
 * ProcessoSeletivoSearch represents the model behind the search form about `app\models\ProcessoSeletivo`.
 */
class ProcessoSeletivoSearch extends ProcessoSeletivo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status_id', 'situacao_id', 'modalidade_id'], 'integer'],
            [['descricao', 'data', 'numeroEdital', 'objetivo', 'data_encer'], 'safe'],
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
        $query = ProcessoSeletivo::find()
        ->orderBy(['id' => SORT_DESC]);

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
            'data' => $this->data,
            'status_id' => $this->status_id,
            'situacao_id' => $this->situacao_id,
            'modalidade_id' => $this->modalidade_id,
            'data_encer' => $this->data_encer,
        ]);

        $query->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'numeroEdital', $this->numeroEdital])
            ->andFilterWhere(['like', 'objetivo', $this->objetivo]);

        return $dataProvider;
    }
}
