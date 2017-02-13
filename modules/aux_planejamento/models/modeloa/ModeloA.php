<?php

namespace app\modules\aux_planejamento\models\modeloa;

use Yii;

use app\modules\aux_planejamento\models\cadastros\Ano;

/**
 * This is the model class for table "modeloa_moda".
 *
 * @property string $moda_codmodelo
 * @property string $moda_codano
 * @property string $moda_centrocusto
 * @property string $moda_centrocustoreduzido
 * @property string $moda_nomecentrocusto
 * @property integer $moda_codunidade
 * @property string $moda_nomeunidade
 * @property integer $moda_codcolaborador
 * @property integer $moda_codusuario
 * @property string $moda_nomeusuario
 * @property string $moda_codsituacao
 * @property string $moda_codentrada
 * @property string $moda_codsegmento
 * @property string $moda_codtipoacao
 * @property string $moda_descriminacaoprojeto
 * @property string $moda_identificacao
 *
 * @property DetalhesmodeloaDeta[] $detalhesmodeloaDetas
 * @property AnoAn $modaCodano
 * @property EntradamodeloaEnta $modaCodentrada
 * @property SituacaomodeloaSimoa $modaCodsituacao
 */
class ModeloA extends \yii\db\ActiveRecord
{
    public $anoLabel;
    public $entradaDadosLabel;
    public $situacaoLabel;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modeloa_moda';
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
            [['moda_codano', 'moda_centrocusto', 'moda_centrocustoreduzido', 'moda_nomecentrocusto', 'moda_codunidade', 'moda_nomeunidade', 'moda_codcolaborador', 'moda_codusuario', 'moda_nomeusuario', 'moda_codsituacao', 'moda_codentrada', 'moda_codsegmento', 'moda_codtipoacao', 'moda_identificacao'], 'required'],
            [['moda_codano', 'moda_codunidade', 'moda_codcolaborador', 'moda_codusuario', 'moda_codsituacao', 'moda_codentrada', 'moda_codsegmento', 'moda_codtipoacao', 'moda_anoexercicio'], 'integer'],
            [['moda_descriminacaoprojeto'], 'string'],
            [['moda_centrocusto'], 'string', 'max' => 45],
            [['moda_centrocustoreduzido'], 'string', 'max' => 15],
            [['moda_nomecentrocusto'], 'string', 'max' => 100],
            [['moda_nomeunidade'], 'string', 'max' => 80],
            [['moda_nomeusuario'], 'string', 'max' => 50],
            [['moda_identificacao'], 'string', 'max' => 30],
            [['anoLabel', 'entradaDadosLabel', 'situacaoLabel'], 'safe'],
            [['moda_codano'], 'exist', 'skipOnError' => true, 'targetClass' => Ano::className(), 'targetAttribute' => ['moda_codano' => 'an_codano']],
            [['moda_codentrada'], 'exist', 'skipOnError' => true, 'targetClass' => EntradaModeloA::className(), 'targetAttribute' => ['moda_codentrada' => 'enta_codentrada']],
            [['moda_codsituacao'], 'exist', 'skipOnError' => true, 'targetClass' => SituacaoModeloA::className(), 'targetAttribute' => ['moda_codsituacao' => 'simoa_codsituacao']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'moda_codmodelo' => 'Cód. Modelo',
            'moda_codano' => 'Ano',
            'moda_centrocusto' => 'Centro de Custo',
            'moda_centrocustoreduzido' => 'Centro de Custo',
            'moda_nomecentrocusto' => 'Descrição C.C.',
            'moda_codunidade' => 'Codunidade',
            'moda_nomeunidade' => 'Unidade',
            'moda_codcolaborador' => 'Codcolaborador',
            'moda_codusuario' => 'Codusuario',
            'moda_nomeusuario' => 'Usuário',
            'moda_codsituacao' => 'Situação',
            'moda_codentrada' => 'Entrada dos Dados',
            'moda_codsegmento' => 'Codsegmento',
            'moda_codtipoacao' => 'Codtipoacao',
            'moda_descriminacaoprojeto' => 'Descriminação do Projeto ou Atividade',
            'moda_identificacao' => 'Identificação',
            'moda_anoexercicio' => 'Ano de Exercício',

            'anoLabel' => 'Ano',
            'entradaDadosLabel' => 'Entrada dos Dados',
            'situacaoLabel' => 'Situação',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalhesModeloA()
    {
        return $this->hasMany(DetalhesModeloA::className(), ['deta_codmodelo' => 'moda_codmodelo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnoModeloA()
    {
        return $this->hasOne(Ano::className(), ['an_codano' => 'moda_codano']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntradaModeloA()
    {
        return $this->hasOne(EntradaModeloA::className(), ['enta_codentrada' => 'moda_codentrada']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSituacaoModeloA()
    {
        return $this->hasOne(SituacaoModeloA::className(), ['simoa_codsituacao' => 'moda_codsituacao']);
    }
}
