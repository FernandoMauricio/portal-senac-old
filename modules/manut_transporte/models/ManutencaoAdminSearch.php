<?php

namespace app\modules\manut_transporte\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\manut_transporte\models\ManutencaoAdmin;

/**
 * ManutencaoAdminSearch represents the model behind the search form about `app\modules\manut_transporte\models\ManutencaoAdmin`.
 */
class ManutencaoAdminSearch extends ManutencaoAdmin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'idusuario_solic', 'idusuario_suport', 'cod_unidade_solic', 'cod_unidade_suport', 'tipo_solic_id'], 'integer'],
            [['data_solicitacao', 'titulo', 'descricao_manut', 'usuario_solic_nome', 'usuario_suport_nome', 'usuario_encerramento', 'data_encerramento', 'situacao_label'], 'safe'],
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
        $query = Manutencao::find()
        ->orderBy(['id' => SORT_DESC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        $dataProvider->sort->attributes['situacao_label'] = [
        'asc' => ['situacao.nome' => SORT_ASC],
        'desc' => ['situacao.nome' => SORT_DESC],
        ];


        $query->joinWith('situacao');

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'data_solicitacao' => $this->data_solicitacao,
            'idusuario_solic' => $this->idusuario_solic,
            'idusuario_suport' => $this->idusuario_suport,
            'data_encerramento' => $this->data_encerramento,
            'cod_unidade_solic' => $this->cod_unidade_solic,
            'cod_unidade_suport' => $this->cod_unidade_suport,
            'tipo_solic_id' => $this->tipo_solic_id,
            'situacao_id' => 1, //SOLICITAÇÕES ENCAMINHADAS PARA PROVIDÊNCIAS
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'descricao_manut', $this->descricao_manut])
            ->andFilterWhere(['like', 'usuario_solic_nome', $this->usuario_solic_nome])
            ->andFilterWhere(['=', 'situacao.nome', $this->situacao_label])
            ->andFilterWhere(['like', 'usuario_suport_nome', $this->usuario_suport_nome])
            ->andFilterWhere(['like', 'usuario_encerramento', $this->usuario_encerramento]);

        return $dataProvider;
    }
}
