<?php

namespace app\modules\comunicacaointerna\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\comunicacaointerna\models\Destinocomunicacao;
use app\modules\comunicacaointerna\models\Comunicacaointerna;

/**
 * DestinocomunicacaoCircSearch represents the model behind the search form about `app\modules\comunicacaointerna\models\Destinocomunicacao`.
 */
class DestinocomunicacaoEncSearch extends Destinocomunicacao
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dest_coddestino', 'dest_codcomunicacao', 'dest_codcolaborador', 'dest_codunidadeenvio', 'dest_codtipo', 'dest_codsituacao', 'dest_coddespacho'], 'integer'],
            [['dest_data', 'dest_nomeunidadeenvio', 'dest_nomeunidadedest'], 'safe'],
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
        $query = Destinocomunicacao::find();

        $dataProvider2 = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider2;
        }

       //$query->joinWith('comunicacaointerna');

        $query->andFilterWhere([
            'dest_coddestino' => $this->dest_coddestino,
            'dest_codcomunicacao' => $this->dest_codcomunicacao,
            'dest_codcolaborador' => $this->dest_codcolaborador,
            'dest_codunidadeenvio' => $this->dest_codunidadeenvio,
            //'dest_codunidadedest' => $this->dest_codunidadedest,
            'dest_data' => $this->dest_data,
            'dest_codtipo' => $this->dest_codtipo,
            'dest_codsituacao' => $this->dest_codsituacao,
            'dest_coddespacho' => $this->dest_coddespacho,
            
        ]);

        //Coletar a sessão do usuário
        $session = Yii::$app->session;

        $query->andFilterWhere(['dest_codcomunicacao' => $session['sess_comunicacao']])
            ->andFilterWhere(['dest_coddespacho' => 0])
            ->andFilterWhere(['dest_codsituacao' => 1])
            ->andFilterWhere(['dest_codtipo' => 3]);

        return $dataProvider2;
    }
}
