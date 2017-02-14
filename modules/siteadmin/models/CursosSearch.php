<?php

namespace app\modules\siteadmin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\siteadmin\models\Cursos;

/**
 * CursosSearch represents the model behind the search form about `app\modules\siteadmin\models\Cursos`.
 */
class CursosSearch extends Cursos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'unidade_id'], 'integer'],
            [['nome_curso', 'parcelamento', 'observacao', 'data_inicial', 'data_final', 'hora_inicial', 'hora_final'], 'safe'],
            [['investimento'], 'number'],
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
        $query = Cursos::find();

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
            'unidade_id' => $this->unidade_id,
        ]);

        $query->andFilterWhere(['like', 'nome_curso', $this->nome_curso])
            ->andFilterWhere(['like', 'data_inicial', $this->data_inicial])
            ->andFilterWhere(['like', 'data_final', $this->data_final])
            ->andFilterWhere(['like', 'observacao', $this->observacao])
            ->andFilterWhere(['like', 'hora_inicial', $this->hora_inicial])
            ->andFilterWhere(['like', 'hora_final', $this->hora_final])
            ->andFilterWhere(['like', 'parcelamento', $this->parcelamento])
            ->andFilterWhere(['like', 'investimento', $this->investimento])
            ->andFilterWhere(['like', 'observacao', $this->observacao]);

        return $dataProvider;
    }
}
