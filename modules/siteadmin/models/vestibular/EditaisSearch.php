<?php

namespace app\modules\siteadmin\models\vestibular;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\siteadmin\models\vestibular\Editais;

/**
 * EditaisSearch represents the model behind the search form about `app\modules\siteadmin\models\vestibular\Editais`.
 */
class EditaisSearch extends Editais
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'vestibular_id'], 'integer'],
            [['nomeEdital', 'arquivoEdital', 'data'], 'safe'],
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
        $query = Editais::find();

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
            'data' => $this->data,
            'vestibular_id' => $this->vestibular_id,
        ]);

    $session = Yii::$app->session;

        $query->andFilterWhere(['vestibular_id' => $session['sess_vestibular']])
            ->andFilterWhere(['like', 'nomeEdital', $this->nomeEdital])
            ->andFilterWhere(['like', 'arquivoEdital', $this->arquivoEdital]);

        return $dataProvider;
    }
}
