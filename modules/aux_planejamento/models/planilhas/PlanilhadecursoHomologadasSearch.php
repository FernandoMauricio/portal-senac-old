<?php

namespace app\modules\aux_planejamento\models\planilhas;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\aux_planejamento\models\planilhas\PlanilhadecursoHomologadas;

/**
 * PlanilhadecursoHomologadasSearch represents the model behind the search form about `app\modules\aux_planejamento\models\planilhas\PlanilhadecursoHomologadas`.
 */
class PlanilhadecursoHomologadasSearch extends PlanilhadecursoHomologadas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['placu_codplanilha', 'placu_codeixo', 'placu_codsegmento', 'placu_codplano', 'placu_codtipoa', 'placu_codnivel', 'placu_codano', 'placu_codcategoria', 'placu_codtipla', 'placu_quantidadeturmas', 'placu_quantidadealunos', 'placu_codsituacao', 'placu_codcolaborador', 'placu_codunidade', 'placu_quantidadealunospsg', 'placu_cargahorariavivencia', 'placu_quantidadealunosisentos', 'placu_codprogramacao', 'placu_parcelas'], 'integer'],
            [['placu_cargahorariaplano', 'placu_cargahorariarealizada', 'placu_cargahorariaarealizar', 'placu_totalcustodocente', 'placu_decimo', 'placu_ferias', 'placu_tercoferias', 'placu_totalsalario', 'placu_totalencargosPrestador', 'placu_totalencargos', 'placu_totalsalarioencargo', 'placu_custosmateriais', 'placu_hiddenmaterialdidatico', 'placu_custosconsumo', 'placu_diarias', 'placu_passagens', 'placu_pessoafisica', 'placu_pessoajuridica', 'placu_equipamentos', 'placu_PJApostila', 'placu_hiddenpjapostila', 'placu_totalcustodireto', 'placu_totalhoraaulacustodireto', 'placu_custosindiretos', 'placu_ipca', 'placu_reservatecnica', 'placu_despesadm', 'placu_totalincidencias', 'placu_totalcustoindireto', 'placu_despesatotal', 'placu_markdivisor', 'placu_markmultiplicador', 'placu_vendaturma', 'placu_vendaaluno', 'placu_horaaulaaluno', 'placu_retorno', 'placu_porcentretorno', 'placu_precosugerido', 'placu_retornoprecosugerido', 'placu_minimoaluno', 'placu_valorparcelas'], 'number'],
            [['placu_nomeunidade', 'placu_observacao', 'placu_data','PlanoLabel'], 'safe'],
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
        $query = PlanilhadecursoHomologadas::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith('plano');

        $dataProvider->sort->attributes['PlanoLabel'] = [
        'asc' => ['planodeacao_plan.plan_descricao' => SORT_ASC],
        'desc' => ['planodeacao_plan.plan_descricao' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'placu_codplanilha' => $this->placu_codplanilha,
            'placu_codeixo' => $this->placu_codeixo,
            'placu_codsegmento' => $this->placu_codsegmento,
            'placu_codplano' => $this->placu_codplano,
            'placu_codtipoa' => $this->placu_codtipoa,
            'placu_codnivel' => $this->placu_codnivel,
            'placu_cargahorariaplano' => $this->placu_cargahorariaplano,
            'placu_cargahorariarealizada' => $this->placu_cargahorariarealizada,
            'placu_cargahorariaarealizar' => $this->placu_cargahorariaarealizar,
            'placu_codano' => $this->placu_codano,
            'placu_codcategoria' => $this->placu_codcategoria,
            'placu_codtipla' => $this->placu_codtipla,
            'placu_quantidadeturmas' => $this->placu_quantidadeturmas,
            'placu_quantidadealunos' => $this->placu_quantidadealunos,
            'placu_codcolaborador' => $this->placu_codcolaborador,
            'placu_codunidade' => $this->placu_codunidade,
            'placu_quantidadealunospsg' => $this->placu_quantidadealunospsg,
            'placu_cargahorariavivencia' => $this->placu_cargahorariavivencia,
            'placu_quantidadealunosisentos' => $this->placu_quantidadealunosisentos,
            'placu_codprogramacao' => $this->placu_codprogramacao,
            'placu_totalcustodocente' => $this->placu_totalcustodocente,
            'placu_decimo' => $this->placu_decimo,
            'placu_ferias' => $this->placu_ferias,
            'placu_tercoferias' => $this->placu_tercoferias,
            'placu_totalsalario' => $this->placu_totalsalario,
            'placu_totalencargosPrestador' => $this->placu_totalencargosPrestador,
            'placu_totalencargos' => $this->placu_totalencargos,
            'placu_totalsalarioencargo' => $this->placu_totalsalarioencargo,
            'placu_custosmateriais' => $this->placu_custosmateriais,
            'placu_hiddenmaterialdidatico' => $this->placu_hiddenmaterialdidatico,
            'placu_custosconsumo' => $this->placu_custosconsumo,
            'placu_diarias' => $this->placu_diarias,
            'placu_passagens' => $this->placu_passagens,
            'placu_pessoafisica' => $this->placu_pessoafisica,
            'placu_pessoajuridica' => $this->placu_pessoajuridica,
            'placu_equipamentos' => $this->placu_equipamentos,
            'placu_PJApostila' => $this->placu_PJApostila,
            'placu_hiddenpjapostila' => $this->placu_hiddenpjapostila,
            'placu_totalcustodireto' => $this->placu_totalcustodireto,
            'placu_totalhoraaulacustodireto' => $this->placu_totalhoraaulacustodireto,
            'placu_custosindiretos' => $this->placu_custosindiretos,
            'placu_ipca' => $this->placu_ipca,
            'placu_reservatecnica' => $this->placu_reservatecnica,
            'placu_despesadm' => $this->placu_despesadm,
            'placu_totalincidencias' => $this->placu_totalincidencias,
            'placu_totalcustoindireto' => $this->placu_totalcustoindireto,
            'placu_despesatotal' => $this->placu_despesatotal,
            'placu_markdivisor' => $this->placu_markdivisor,
            'placu_markmultiplicador' => $this->placu_markmultiplicador,
            'placu_vendaturma' => $this->placu_vendaturma,
            'placu_vendaaluno' => $this->placu_vendaaluno,
            'placu_horaaulaaluno' => $this->placu_horaaulaaluno,
            'placu_retorno' => $this->placu_retorno,
            'placu_porcentretorno' => $this->placu_porcentretorno,
            'placu_precosugerido' => $this->placu_precosugerido,
            'placu_retornoprecosugerido' => $this->placu_retornoprecosugerido,
            'placu_minimoaluno' => $this->placu_minimoaluno,
            'placu_parcelas' => $this->placu_parcelas,
            'placu_valorparcelas' => $this->placu_valorparcelas,
            'placu_data' => $this->placu_data,
            'placu_codsituacao' => 4, //Homologadas pelo GPO

        ]);

        $query->andFilterWhere(['like', 'placu_nomeunidade', $this->placu_nomeunidade])
            ->andFilterWhere(['like', 'placu_observacao', $this->placu_observacao])
            ->andFilterWhere(['like', 'planodeacao_plan.plan_descricao', $this->PlanoLabel]);

        return $dataProvider;
    }
}
