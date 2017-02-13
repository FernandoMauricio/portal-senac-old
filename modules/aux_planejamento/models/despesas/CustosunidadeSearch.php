<?php

namespace app\modules\aux_planejamento\models\despesas;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\aux_planejamento\models\despesas\Custosunidade;

/**
 * CustosunidadeSearch represents the model behind the search form about `app\modules\aux_planejamento\models\despesas\Custosunidade`.
 */
class CustosunidadeSearch extends Custosunidade
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cust_codcusto', 'cust_codunidade', 'cust_ano', 'cust_MediaPorcentagem', 'cust_MediaCustoIndireto', 'cust_status'], 'integer'],
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
        $query = Custosunidade::find();

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
            'cust_codcusto' => $this->cust_codcusto,
            'cust_ano' => $this->cust_ano,
            'cust_MediaPorcentagem' => $this->cust_MediaPorcentagem,
            'cust_MediaCustoIndireto' => $this->cust_MediaCustoIndireto,
            'cust_codunidade' => $this->cust_codunidade,
            'cust_status' => $this->cust_status,
        ]);

        return $dataProvider;
    }
}
