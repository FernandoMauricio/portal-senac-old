<?php

namespace app\modules\contratacao\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\contratacao\models\ContratacaoJustificativas;

/**
 * ContratacaoJustificativasSearch represents the model behind the search form about `app\models\ContratacaoJustificativas`.
 */
class ContratacaoJustificativasSearch extends ContratacaoJustificativas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_contratacao'], 'integer'],
            [['descricao', 'usuario'], 'safe'],
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
        $query = ContratacaoJustificativas::find()
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
            'id_contratacao' => $this->id_contratacao,
        ]);

        $session = Yii::$app->session;
        $query->andFilterWhere(['id_contratacao' => $session['sess_contratacao']])
            ->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'usuario', $this->usuario]);

        return $dataProvider;
    }
}
