<?php

namespace app\modules\contratacao\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\contratacao\models\CurriculosEndereco;

/**
 * CurriculosEnderecoSearch represents the model behind the search form about `app\models\CurriculosEndereco`.
 */
class CurriculosEnderecoSearch extends CurriculosEndereco
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'curriculos_id'], 'integer'],
            [['endereco', 'numero_end', 'complemento', 'bairro', 'cep', 'cidade', 'estado'], 'safe'],
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
        $query = CurriculosEndereco::find();

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
            'numero_end' => $this->numero_end,
            'curriculos_id' => $this->curriculos_id,
        ]);

        $query->andFilterWhere(['like', 'endereco', $this->endereco])
            ->andFilterWhere(['like', 'bairro', $this->bairro])
            ->andFilterWhere(['like', 'cep', $this->cep])
            ->andFilterWhere(['like', 'cidade', $this->cidade])
            ->andFilterWhere(['like', 'estado', $this->estado]);

        return $dataProvider;
    }
}
