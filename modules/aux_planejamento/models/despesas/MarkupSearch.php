<?php

namespace app\modules\aux_planejamento\models\despesas;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\aux_planejamento\models\despesas\Markup;

/**
 * MarkupSearch represents the model behind the search form about `app\modules\aux_planejamento\models\despesas\Markup`.
 */
class MarkupSearch extends Markup
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mark_id', 'mark_codunidade'], 'integer'],
            [['mark_ipca', 'mark_reservatecnica', 'mark_despesasede', 'mark_totalincidencias', 'mark_divisor'], 'number'],
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
        // $query = Markup::find();

        $query = Markup::find()->indexBy('mark_id'); // where `id` is your primary key

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
            'mark_id' => $this->mark_id,
            'mark_codunidade' => $this->mark_codunidade,
            'mark_ipca' => $this->mark_ipca,
            'mark_reservatecnica' => $this->mark_reservatecnica,
            'mark_despesasede' => $this->mark_despesasede,
            'mark_totalincidencias' => $this->mark_totalincidencias,
            'mark_divisor' => $this->mark_divisor,
        ]);

        return $dataProvider;
    }
}
