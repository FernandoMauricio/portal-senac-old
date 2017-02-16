<?php

namespace app\modules\contratacao\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\contratacao\models\Curriculos;

/**
 * CurriculosSearch represents the model behind the search form about `app\models\Curriculos`.
 */
class CurriculosSearch extends Curriculos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','idade', 'classificado'], 'integer'],
            [['edital', 'nome','numeroInscricao', 'cargo', 'cpf', 'datanascimento', 'sexo', 'email', 'emailAlt', 'telefone', 'telefoneAlt', 'data'], 'safe'],
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
        $query = Curriculos::find()
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
            'datanascimento' => $this->datanascimento,
            'idade' => $this->idade,
            'data' => $this->data,
            'classificado' => $this->classificado,
        ]);

        $query->andFilterWhere(['like', 'edital', $this->edital])
            ->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'numeroInscricao', $this->numeroInscricao])
            ->andFilterWhere(['like', 'cargo', $this->cargo])
            ->andFilterWhere(['like', 'cpf', $this->cpf])
            ->andFilterWhere(['like', 'sexo', $this->sexo])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'emailAlt', $this->emailAlt])
            ->andFilterWhere(['like', 'telefone', $this->telefone])
            ->andFilterWhere(['like', 'telefoneAlt', $this->telefoneAlt]);

        return $dataProvider;
    }
}
