<?php

namespace app\modules\aux_planejamento\models\despesas;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\aux_planejamento\models\despesas\Despesasdocente;

/**
 * DespesasdocenteSearch represents the model behind the search form about `app\modules\aux_planejamento\models\despesas\Despesasdocente`.
 */
class DespesasdocenteSearch extends Despesasdocente
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doce_id', 'doce_status'], 'integer'],
            [['doce_descricao'], 'safe'],
            [['doce_valor', 'doce_encargos', 'doce_dsr', 'doce_planejamento', 'doce_produtividade', 'doce_valorhoraaula'], 'number'],
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
        $query = Despesasdocente::find();

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
            'doce_id' => $this->doce_id,
            'doce_status' => $this->doce_status,
        ]);

        $query->andFilterWhere(['like', 'doce_descricao', $this->doce_descricao])
              ->andFilterWhere(['like', 'doce_encargos', $this->doce_encargos])
              ->andFilterWhere(['like', 'doce_valor', $this->doce_valor])
              ->andFilterWhere(['like', 'doce_dsr', $this->doce_dsr])
              ->andFilterWhere(['like', 'doce_planejamento', $this->doce_planejamento])
              ->andFilterWhere(['like', 'doce_produtividade', $this->doce_produtividade])
              ->andFilterWhere(['like', 'doce_valorhoraaula', $this->doce_valorhoraaula]);

        return $dataProvider;
    }
}
