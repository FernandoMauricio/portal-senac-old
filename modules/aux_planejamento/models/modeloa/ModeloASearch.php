<?php

namespace app\modules\aux_planejamento\models\modeloa;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\aux_planejamento\models\modeloa\ModeloA;

/**
 * ModeloASearch represents the model behind the search form about `app\modules\aux_planejamento\models\modeloa\ModeloA`.
 */
class ModeloASearch extends ModeloA
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['moda_codmodelo', 'moda_codano', 'moda_codunidade', 'moda_codcolaborador', 'moda_codusuario', 'moda_codsituacao', 'moda_codentrada', 'moda_codsegmento', 'moda_codtipoacao'], 'integer'],
            [['moda_centrocusto', 'moda_centrocustoreduzido', 'moda_nomecentrocusto', 'moda_nomeunidade', 'moda_nomeusuario', 'moda_descriminacaoprojeto', 'moda_identificacao'], 'safe'],
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
        $query = ModeloA::find();

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

        $session = Yii::$app->session;
        
        // grid filtering conditions
        $query->andFilterWhere([
            'moda_codmodelo' => $this->moda_codmodelo,
            'moda_codsituacao' => $this->moda_codsituacao,
            'moda_codcolaborador' => $this->moda_codcolaborador,
            'moda_codusuario' => $this->moda_codusuario,
            'moda_codentrada' => $this->moda_codentrada,
            'moda_codsegmento' => $this->moda_codsegmento,
            'moda_codtipoacao' => $this->moda_codtipoacao,
            'moda_codunidade' => $session['sess_codunidade'],
            'moda_codano' => 6, //---Ano 2017

        ]);

        $query->andFilterWhere(['like', 'moda_centrocusto', $this->moda_centrocusto])
            ->andFilterWhere(['like', 'moda_centrocustoreduzido', $this->moda_centrocustoreduzido])
            ->andFilterWhere(['like', 'moda_nomecentrocusto', $this->moda_nomecentrocusto])
            ->andFilterWhere(['like', 'moda_nomeunidade', $this->moda_nomeunidade])
            ->andFilterWhere(['like', 'moda_nomeusuario', $this->moda_nomeusuario])
            ->andFilterWhere(['like', 'moda_descriminacaoprojeto', $this->moda_descriminacaoprojeto])
            ->andFilterWhere(['like', 'moda_identificacao', $this->moda_identificacao]);

        return $dataProvider;
    }
}
