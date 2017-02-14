<?php

namespace app\modules\siteadmin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\siteadmin\models\Abertura;

/**
 * AberturaSearch represents the model behind the search form about `app\modules\siteadmin\models\Abertura`.
 */
class AberturaSearch extends Abertura
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'estado_id', 'status_id'], 'integer'],
            [['desc_abertura', 'arquivo', 'data', 'unidades'], 'safe'],
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
        $query = Abertura::find();

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
            'estado_id' => $this->estado_id,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'desc_abertura', $this->desc_abertura])
            ->andFilterWhere(['like', 'arquivo', $this->arquivo])
            ->andFilterWhere(['like', 'unidades', $this->unidades]);

        return $dataProvider;
    }
}
