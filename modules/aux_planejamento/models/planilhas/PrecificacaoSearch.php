<?php

namespace app\modules\aux_planejamento\models\planilhas;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\aux_planejamento\models\planilhas\Precificacao;

/**
 * PrecificacaoSearch represents the model behind the search form about `app\modules\aux_planejamento\models\planilhas\Precificacao`.
 */
class PrecificacaoSearch extends Precificacao
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['planp_id', 'planp_codunidade', 'planp_cargahoraria', 'planp_qntaluno', 'planp_totalhorasdocente', 'planp_docente', 'planp_servpedagogico', 'planp_ano'], 'integer'],
            [['planp_valorhoraaula', 'planp_horaaulaplanejamento', 'planp_totalcustodocente', 'planp_decimo', 'planp_ferias', 'planp_tercoferias', 'planp_totalsalario', 'planp_encargos', 'planp_totalencargos', 'planp_totalsalarioencargo', 'planp_custosmateriais', 'planp_diarias', 'planp_passagens', 'planp_pessoafisica', 'planp_pessoajuridica', 'planp_totalcustodireto', 'planp_totalhoraaulacustodireto', 'planp_custosindiretos', 'planp_ipca', 'planp_reservatecnica', 'planp_despesadm', 'planp_totalincidencias', 'planp_totalcustoindireto', 'planp_despesatotal', 'planp_markdivisor', 'planp_markmultiplicador', 'planp_vendaturma', 'planp_vendaaluno', 'planp_horaaulaaluno', 'planp_retorno', 'planp_porcentretorno', 'planp_precosugerido', 'planp_retornoprecosugerido', 'planp_minimoaluno'], 'number'],
            [['planp_data','planp_planodeacao','labelCurso'], 'safe'],
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
        $query = Precificacao::find()->orderBy(['planp_id' => SORT_DESC]);;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['labelCurso'] = [
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
            'planp_id' => $this->planp_id,
            'planp_codunidade' => $this->planp_codunidade,
            'planp_ano' => $this->planp_ano,
            'planp_cargahoraria' => $this->planp_cargahoraria,
            'planp_qntaluno' => $this->planp_qntaluno,
            'planp_totalhorasdocente' => $this->planp_totalhorasdocente,
            'planp_docente' => $this->planp_docente,
            'planp_valorhoraaula' => $this->planp_valorhoraaula,
            'planp_servpedagogico' => $this->planp_servpedagogico,
            'planp_horaaulaplanejamento' => $this->planp_horaaulaplanejamento,
            'planp_totalcustodocente' => $this->planp_totalcustodocente,
            'planp_decimo' => $this->planp_decimo,
            'planp_ferias' => $this->planp_ferias,
            'planp_tercoferias' => $this->planp_tercoferias,
            'planp_totalsalario' => $this->planp_totalsalario,
            'planp_encargos' => $this->planp_encargos,
            'planp_totalencargos' => $this->planp_totalencargos,
            'planp_totalsalarioencargo' => $this->planp_totalsalarioencargo,
            'planp_custosmateriais' => $this->planp_custosmateriais,
            'planp_diarias' => $this->planp_diarias,
            'planp_passagens' => $this->planp_passagens,
            'planp_pessoafisica' => $this->planp_pessoafisica,
            'planp_pessoajuridica' => $this->planp_pessoajuridica,
            'planp_totalcustodireto' => $this->planp_totalcustodireto,
            'planp_totalhoraaulacustodireto' => $this->planp_totalhoraaulacustodireto,
            'planp_custosindiretos' => $this->planp_custosindiretos,
            'planp_ipca' => $this->planp_ipca,
            'planp_reservatecnica' => $this->planp_reservatecnica,
            'planp_despesadm' => $this->planp_despesadm,
            'planp_totalincidencias' => $this->planp_totalincidencias,
            'planp_totalcustoindireto' => $this->planp_totalcustoindireto,
            'planp_despesatotal' => $this->planp_despesatotal,
            'planp_markdivisor' => $this->planp_markdivisor,
            'planp_markmultiplicador' => $this->planp_markmultiplicador,
            'planp_vendaturma' => $this->planp_vendaturma,
            'planp_vendaaluno' => $this->planp_vendaaluno,
            'planp_horaaulaaluno' => $this->planp_horaaulaaluno,
            'planp_retorno' => $this->planp_retorno,
            'planp_porcentretorno' => $this->planp_porcentretorno,
            'planp_retornoprecosugerido' => $this->planp_retornoprecosugerido,
            'planp_minimoaluno' => $this->planp_minimoaluno,
        ]);

$query->joinWith('planodeacao');

        $query->andFilterWhere(['like', 'planp_precosugerido', $this->planp_precosugerido])
              ->andFilterWhere(['like', 'planodeacao_plan.plan_descricao', $this->labelCurso]);

        return $dataProvider;
    }
}
