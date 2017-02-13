<?php

namespace app\modules\aux_planejamento\models\planilhas;

use Yii;
use app\modules\aux_planejamento\models\base\Colaborador;
use app\modules\aux_planejamento\models\base\Unidade;
use app\modules\aux_planejamento\models\cadastros\Ano;
use app\modules\aux_planejamento\models\cadastros\Eixo;
use app\modules\aux_planejamento\models\cadastros\Nivel;
use app\modules\aux_planejamento\models\cadastros\Segmento;
use app\modules\aux_planejamento\models\cadastros\Tipo;
use app\modules\aux_planejamento\models\cadastros\Categoriaplanilha;
use app\modules\aux_planejamento\models\cadastros\Tipoprogramacao;
use app\modules\aux_planejamento\models\cadastros\Tipoplanilha;
use app\modules\aux_planejamento\models\cadastros\Situacaoplanilha;
use app\modules\aux_planejamento\models\planos\Planodeacao;
/**
 * This is the model class for table "planilhadecurso_placu".
 *
 * @property string $placu_codplanilha
 * @property string $placu_codeixo
 * @property string $placu_codsegmento
 * @property string $placu_codplano
 * @property string $placu_codtipoa
 * @property string $placu_codnivel
 * @property double $placu_cargahorariaplano
 * @property double $placu_cargahorariarealizada
 * @property double $placu_cargahorariaarealizar
 * @property string $placu_codano
 * @property string $placu_codcategoria
 * @property string $placu_codtipla
 * @property integer $placu_quantidadeturmas
 * @property integer $placu_quantidadealunos
 * @property integer $placu_quantidadeparcelas
 * @property double $placu_valormensalidade
 * @property string $placu_codsituacao
 * @property integer $placu_codcolaborador
 * @property integer $placu_codunidade
 * @property string $placu_nomeunidade
 * @property integer $placu_quantidadealunospsg
 * @property integer $placu_tipocalculo
 * @property string $placu_observacao
 * @property double $placu_taxaretorno
 * @property integer $placu_cargahorariavivencia
 * @property integer $placu_quantidadealunosisentos
 * @property string $placu_codprogramacao
 * @property double $placu_totalcustodocente
 * @property double $placu_decimo
 * @property double $placu_ferias
 * @property double $placu_tercoferias
 * @property double $placu_totalsalario
 * @property double $placu_totalencargosPrestador
 * @property double $placu_totalencargos
 * @property double $placu_totalsalarioencargo
 * @property double $placu_custosmateriais
 * @property double $placu_hiddenmaterialdidatico
 * @property double $placu_custosconsumo
 * @property double $placu_diarias
 * @property double $placu_passagens
 * @property double $placu_pessoafisica
 * @property double $placu_pessoajuridica
 * @property double $placu_equipamentos
 * @property double $placu_PJApostila
 * @property double $placu_hiddenpjapostila
 * @property double $placu_totalcustodireto
 * @property double $placu_totalhoraaulacustodireto
 * @property double $placu_custosindiretos
 * @property double $placu_ipca
 * @property double $placu_reservatecnica
 * @property double $placu_despesadm
 * @property double $placu_totalincidencias
 * @property double $placu_totalcustoindireto
 * @property double $placu_despesatotal
 * @property double $placu_markdivisor
 * @property double $placu_markmultiplicador
 * @property double $placu_vendaturma
 * @property double $placu_vendaaluno
 * @property double $placu_horaaulaaluno
 * @property double $placu_retorno
 * @property double $placu_porcentretorno
 * @property double $placu_precosugerido
 * @property double $placu_retornoprecosugerido
 * @property double $placu_minimoaluno
 * @property integer $placu_parcelas
 * @property double $placu_valorparcelas
 * @property string $placu_data
 *
 * @property HistoricoplanilhaHis[] $historicoplanilhaHis
 * @property ObservacaoplanilhaObpla[] $observacaoplanilhaObplas
 * @property PlanilhaconsumoPlanico[] $planilhaconsumoPlanicos
 * @property AnoAn $placuCodano
 * @property CategoriaplanilhaCat $placuCodcategoria
 * @property EixoEix $placuCodeixo
 * @property NivelNiv $placuCodnivel
 * @property PlanodeacaoPlan $placuCodplano
 * @property TipoprogramacaoTipro $placuCodprogramacao
 * @property SegmentoSeg $placuCodsegmento
 * @property SituacaoplanilhaSipla $placuCodsituacao
 * @property TipoplanilhaTipla $placuCodtipla
 * @property TipodeacaoTip $placuCodtipoa
 * @property PlanilhadespesadocePlanides[] $planilhadespesadocePlanides
 * @property PlanilhaequipPlanieq[] $planilhaequipPlanieqs
 * @property PlanilhamaterialPlanima[] $planilhamaterialPlanimas
 * @property PlanilhaunidadescurricularesPlaniuc[] $planilhaunidadescurricularesPlaniucs
 */
class PlanilhadecursoHomologadas extends Planilhadecurso
{
    public $nivelLabel;
    public $segmentoLabel;
    public $eixoLabel;
    public $tipoAcaoLabel;
    public $PlanoLabel;
    public $anoLabel;
    public $tipoPlanilhaLabel;
    public $tipoProgramacaoLabel;
    public $nomeUsuario;
    public $situacaoLabel;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'planilhadecurso_placu';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_apl');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['placu_codeixo', 'placu_codsegmento', 'placu_codplano', 'placu_codtipoa', 'placu_codnivel', 'placu_codano', 'placu_codcategoria', 'placu_codtipla', 'placu_codsituacao', 'placu_codcolaborador', 'placu_codunidade', 'placu_nomeunidade', 'placu_quantidadealunos', 'placu_quantidadealunospsg', 'placu_quantidadealunosisentos','placu_codprogramacao'], 'required'],
            [['placu_precosugerido', 'placu_parcelas'], 'required', 'on' => 'update'],
            [['placu_codeixo', 'placu_codsegmento', 'placu_codplano', 'placu_codtipoa', 'placu_codnivel', 'placu_codano', 'placu_codcategoria', 'placu_codtipla', 'placu_quantidadeturmas', 'placu_quantidadealunos', 'placu_codsituacao', 'placu_codcolaborador', 'placu_codunidade', 'placu_quantidadealunospsg', 'placu_cargahorariavivencia', 'placu_quantidadealunosisentos', 'placu_codprogramacao'], 'integer'],
            [['placu_cargahorariaplano', 'placu_cargahorariarealizada', 'placu_cargahorariaarealizar'], 'number'],
            [['nivelLabel', 'segmentoLabel', 'eixoLabel', 'tipoAcaoLabel', 'PlanoLabel', 'tipoProgramacaoLabel', 'placu_diarias', 'placu_equipamentos', 'placu_pessoafisica', 'placu_pessoajuridica', 'placu_totalcustodocente', 'placu_decimo', 'placu_ferias', 'placu_tercoferias', 'placu_totalsalario', 'placu_totalencargosPrestador', 'placu_totalencargos', 'placu_totalsalarioencargo', 'placu_custosmateriais', 'placu_custosconsumo', 'placu_PJApostila', 'placu_totalcustodireto', 'placu_totalhoraaulacustodireto', 'placu_hiddenmaterialdidatico', 'placu_hiddenpjapostila', 'placu_custosindiretos', 'placu_ipca', 'placu_reservatecnica', 'placu_despesadm', 'placu_totalincidencias', 'placu_totalcustoindireto', 'placu_despesatotal', 'placu_markdivisor', 'placu_markmultiplicador', 'placu_vendaturma', 'placu_vendaaluno', 'placu_horaaulaaluno', 'placu_retorno', 'placu_porcentretorno', 'placu_precosugerido', 'placu_retornoprecosugerido', 'placu_minimoaluno', 'placu_parcelas', 'placu_valorparcelas', 'nomeUsuario', 'situacaoLabel', 'placu_data'], 'safe'],
            [['placu_observacao'], 'string'],
            [['placu_nomeunidade'], 'string', 'max' => 150],
            [['placu_codano'], 'exist', 'skipOnError' => true, 'targetClass' => Ano::className(), 'targetAttribute' => ['placu_codano' => 'an_codano']],
            [['placu_codcategoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoriaplanilha::className(), 'targetAttribute' => ['placu_codcategoria' => 'cat_codcategoria']],
            [['placu_codeixo'], 'exist', 'skipOnError' => true, 'targetClass' => Eixo::className(), 'targetAttribute' => ['placu_codeixo' => 'eix_codeixo']],
            [['placu_codnivel'], 'exist', 'skipOnError' => true, 'targetClass' => Nivel::className(), 'targetAttribute' => ['placu_codnivel' => 'niv_codnivel']],
            [['placu_codplano'], 'exist', 'skipOnError' => true, 'targetClass' => Planodeacao::className(), 'targetAttribute' => ['placu_codplano' => 'plan_codplano']],
            [['placu_codprogramacao'], 'exist', 'skipOnError' => true, 'targetClass' => Tipoprogramacao::className(), 'targetAttribute' => ['placu_codprogramacao' => 'tipro_codprogramacao']],
            [['placu_codsegmento'], 'exist', 'skipOnError' => true, 'targetClass' => Segmento::className(), 'targetAttribute' => ['placu_codsegmento' => 'seg_codsegmento']],
            [['placu_codsituacao'], 'exist', 'skipOnError' => true, 'targetClass' => Situacaoplanilha::className(), 'targetAttribute' => ['placu_codsituacao' => 'sipla_codsituacao']],
            [['placu_codtipla'], 'exist', 'skipOnError' => true, 'targetClass' => Tipoplanilha::className(), 'targetAttribute' => ['placu_codtipla' => 'tipla_codtipla']],
            [['placu_codtipoa'], 'exist', 'skipOnError' => true, 'targetClass' => Tipo::className(), 'targetAttribute' => ['placu_codtipoa' => 'tip_codtipoa']],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistoricoplanilhaHis()
    {
        return $this->hasMany(HistoricoplanilhaHis::className(), ['his_codplanilha' => 'placu_codplanilha']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObservacaoplanilhaObplas()
    {
        return $this->hasMany(ObservacaoplanilhaObpla::className(), ['obpla_codplanilha' => 'placu_codplanilha']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanilhaAno()
    {
        return $this->hasOne(Ano::className(), ['an_codano' => 'placu_codano']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlacuCodcategoria()
    {
        return $this->hasOne(CategoriaplanilhaCat::className(), ['cat_codcategoria' => 'placu_codcategoria']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEixo()
    {
        return $this->hasOne(Eixo::className(), ['eix_codeixo' => 'placu_codeixo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNivel()
    {
        return $this->hasOne(Nivel::className(), ['niv_codnivel' => 'placu_codnivel']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlano()
    {
        return $this->hasOne(Planodeacao::className(), ['plan_codplano' => 'placu_codplano']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoprogramacao()
    {
        return $this->hasOne(Tipoprogramacao::className(), ['tipro_codprogramacao' => 'placu_codprogramacao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSegmento()
    {
        return $this->hasOne(Segmento::className(), ['seg_codsegmento' => 'placu_codsegmento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSituacaoPlani()
    {
        return $this->hasOne(Situacaoplanilha::className(), ['sipla_codsituacao' => 'placu_codsituacao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoplanilha()
    {
        return $this->hasOne(Tipoplanilha::className(), ['tipla_codtipla' => 'placu_codtipla']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipo()
    {
        return $this->hasOne(Tipo::className(), ['tip_codtipoa' => 'placu_codtipoa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaniMateriais()
    {
        return $this->hasMany(PlanilhaMaterial::className(), ['planilhadecurso_cod' => 'placu_codplanilha']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaniConsumo()
    {
        return $this->hasMany(PlanilhaConsumo::className(), ['planilhadecurso_cod' => 'placu_codplanilha']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaniEquipamento()
    {
        return $this->hasMany(PlanilhaEquipamento::className(), ['planilhadecurso_cod' => 'placu_codplanilha']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaniUC()
    {
        return $this->hasMany(PlanilhaUnidadesCurriculares::className(), ['planilhadecurso_cod' => 'placu_codplanilha']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaniDespDocente()
    {
        return $this->hasMany(PlanilhaDespesaDocente::className(), ['planilhadecurso_cod' => 'placu_codplanilha']);
    }

    public function getColaborador()
    {
        return $this->hasOne(Colaborador::className(), ['col_codcolaborador' => 'placu_codcolaborador']);
    }

    public function getUnidade()
    {
        return $this->hasOne(Unidade::className(), ['uni_codunidade' => 'placu_codunidade']);
    }

}