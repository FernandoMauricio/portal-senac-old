<?php

namespace app\modules\contratacao\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\contratacao\models\Resultados;

/**
 * ResultadosSerch represents the model behind the search form about `app\models\Resultados`.
 */
class ResultadosSerch extends Resultados
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'processo_id'], 'integer'],
            [['resultado'], 'safe'],
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
        $query = Resultados::find();

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
            'processo_id' => $this->processo_id,
        ]);

        $session = Yii::$app->session;
        $query->andFilterWhere(['processo_id' => $session['sess_processo']])
        ->andFilterWhere(['like', 'resultado', $this->resultado]);

        return $dataProvider;
    }
}
