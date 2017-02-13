<?php

namespace app\modules\aux_planejamento\models\planilhas;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\aux_planejamento\models\planilhas\PlanilhaDespesaDocente;

/**
 * PlanilhaDespesaDocenteSearch represents the model behind the search form about `app\modules\aux_planejamento\models\planilhas\PlanilhaDespesaDocente`.
 */
class PlanilhaDespesaDocenteSearch extends PlanilhaDespesaDocente
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'planilhadecurso_cod'], 'integer'],
            [['planides_descricao'], 'safe'],
            [['planides_valor', 'planides_dsr', 'planides_planejamento', 'planides_produtividade', 'planides_valorhoraaula'], 'number'],
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
        $query = PlanilhaDespesaDocente::find()->indexBy('id'); // where `id` is your primary key

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
            'planilhadecurso_cod' => $this->planilhadecurso_cod,
            'planides_valor' => $this->planides_valor,
            'planides_dsr' => $this->planides_dsr,
            'planides_planejamento' => $this->planides_planejamento,
            'planides_produtividade' => $this->planides_produtividade,
            'planides_valorhoraaula' => $this->planides_valorhoraaula,
        ]);

        $query->andFilterWhere(['like', 'planides_descricao', $this->planides_descricao]);

        return $dataProvider;
    }
}
