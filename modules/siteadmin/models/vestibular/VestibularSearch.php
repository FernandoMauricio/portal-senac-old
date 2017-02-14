<?php

namespace app\modules\siteadmin\models\vestibular;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\siteadmin\models\vestibular\Vestibular;

/**
 * VestibularSearch represents the model behind the search form about `app\modules\siteadmin\models\vestibular\Vestibular`.
 */
class VestibularSearch extends Vestibular
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idVest', 'vagas', 'status_id'], 'integer'],
            [['descVest', 'dataAbertura', 'dataEncerramento', 'curso', 'turno'], 'safe'],
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
        $query = Vestibular::find();

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
            'idVest' => $this->idVest,
            'dataAbertura' => $this->dataAbertura,
            'dataEncerramento' => $this->dataEncerramento,
            'vagas' => $this->vagas,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'descVest', $this->descVest])
            ->andFilterWhere(['like', 'curso', $this->curso])
            ->andFilterWhere(['like', 'turno', $this->turno]);

        return $dataProvider;
    }
}
