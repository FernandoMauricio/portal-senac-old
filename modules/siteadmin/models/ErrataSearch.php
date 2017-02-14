<?php

namespace app\modules\siteadmin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\siteadmin\models\Errata;

/**
 * ErrataSearch represents the model behind the search form about `app\modules\siteadmin\models\Errata`.
 */
class ErrataSearch extends Errata
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'edital_id'], 'integer'],
            [['nomeErrata', 'arquivoErrata', 'data'], 'safe'],
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
        $query = Errata::find();

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
            'edital_id' => $this->edital_id,
        ]);

    $session = Yii::$app->session;

        $query->andFilterWhere(['edital_id' => $session['sess_abertura']])
              ->andFilterWhere(['like', 'nomeErrata', $this->nomeErrata])
              ->andFilterWhere(['like', 'arquivoErrata', $this->arquivoErrata]);

        return $dataProvider;
    }
}
