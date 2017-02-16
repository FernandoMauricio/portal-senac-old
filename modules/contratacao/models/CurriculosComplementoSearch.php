<?php

namespace app\modules\contratacao\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\contratacao\models\CurriculosComplemento;

/**
 * CurriculosComplementoSearch represents the model behind the search form about `app\models\CurriculosComplemento`.
 */
class CurriculosComplementoSearch extends CurriculosComplemento
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'certificado', 'curriculos_id'], 'integer'],
            [['cursos'], 'safe'],
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
        $query = CurriculosComplemento::find();

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
            'certificado' => $this->certificado,
            'curriculos_id' => $this->curriculos_id,
        ]);

        $query->andFilterWhere(['like', 'cursos', $this->cursos]);

        return $dataProvider;
    }
}
