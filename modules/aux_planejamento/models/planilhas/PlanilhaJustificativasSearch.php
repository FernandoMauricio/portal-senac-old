<?php

namespace app\modules\aux_planejamento\models\planilhas;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\aux_planejamento\models\planilhas\PlanilhaJustificativas;

/**
 * PlanilhaJustificativasSearch represents the model behind the search form about `app\modules\aux_planejamento\models\planilhas\PlanilhaJustificativas`.
 */
class PlanilhaJustificativasSearch extends PlanilhaJustificativas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'planilhadecurso_id'], 'integer'],
            [['planijust_descricao', 'planijust_usuario'], 'safe'],
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
        $query = PlanilhaJustificativas::find();

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

        $session = Yii::$app->session;
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'planilhadecurso_id' => $session['sess_planilhadecurso'],
        ]);

        $query
        ->andFilterWhere(['like', 'planijust_descricao', $this->planijust_descricao])
            ->andFilterWhere(['like', 'planijust_usuario', $this->planijust_usuario]);

        return $dataProvider;
    }
}
