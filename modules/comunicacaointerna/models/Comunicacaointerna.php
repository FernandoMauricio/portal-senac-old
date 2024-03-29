<?php

namespace app\modules\comunicacaointerna\models;

use Yii;
use yii\db\Expression;
use app\modules\comunicacaointerna\models\ArrayHelper;

/**
 * This is the model class for table "comunicacaointerna_com".
 *
 * @property string $com_codcomunicacao
 * @property integer $com_codcolaborador
 * @property integer $com_codunidade
 * @property string $com_datasolicitacao
 * @property string $com_titulo
 * @property string $com_texto
 * @property string $com_codtipo
 * @property string $com_codsituacao
 * @property string $com_dataautorizacao
 * @property integer $com_codcolaboradorautorizacao
 * @property integer $com_codcargoautorizacao
 *
 * @property AnexocomunicacaoAne[] $anexocomunicacaoAnes
 * @property SituacaocomunicacaoSitco $comCodsituacao
 * @property TipodocumentacaoTipdo $comCodtipo
 * @property DespachocomunicacaoDeco[] $despachocomunicacaoDecos
 * @property DestinocomunicacaoDest[] $destinocomunicacaoDests
 */
class Comunicacaointerna extends \yii\db\ActiveRecord
{

    public $nomesituacao;
    public $file;
    public $data_solicitacao;
    public $situacaocomunicacao;
 
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comunicacaointerna_com';
    }

    /**
     * @inheritdoc
     */
     public function rules()
    {
        return [
            [['com_codtipo'], 'validarTipo'],
            [['com_codcolaborador', 'com_codunidade', 'com_titulo', 'com_texto', 'com_codtipo', 'com_codsituacao'], 'required'],
            [['com_codtipo', 'com_codsituacao', 'com_codcolaboradorautorizacao', 'com_codcargoautorizacao'], 'integer'],
            [['com_datasolicitacao', 'com_dataautorizacao', 'nomesituacao', 'com_usuarioEncerramento', 'com_dataEncerramento','data_solicitacao','situacaocomunicacao'], 'safe'],
            [['file'], 'file', 'maxFiles' => 10,'checkExtensionByMimeType'=>false, 'extensions' => 'pdf, zip, rar, doc, docx'],
            [['com_texto'], 'string'],
            [['com_titulo', 'com_anexo'], 'string', 'max' => 100],
            [['com_tag'], 'string', 'max' => 255],

        ];
    }
        /*Rules Personalizadas para a criação de CI relacionadas ao Tipo
        */

    public function validarTipo($com_codtipo, $params){

        //Coletar a sessão do usuário
        $session = Yii::$app->session;

                if($this->com_codtipo == 2 && $_SESSION['sess_responsavelsetor'] == 0) {

                    $this->addError($com_codtipo, 'Somente o Responsável pela Unidade/Setor poderá gerar uma Comunicação Interna Confidencial.');        
                    }
                }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'com_codcomunicacao' => 'Comunicação',
            'com_codcolaborador' => 'Colaborador',
            'com_codunidade' => 'Unidade',
            'com_datasolicitacao' => 'Data da Solicitação',
            'com_titulo' => 'Título',
            'com_tag' => 'Palavra-Chave',
            'com_texto' => 'Texto',
            'com_codtipo' => 'Tipo',
            'nomesituacao' => 'Situação',
            'com_codsituacao' => 'Situação',
            'com_dataautorizacao' => 'Data/Hora Autorização',
            'com_codcolaboradorautorizacao' => 'Autorizado por:',
            'com_codcargoautorizacao' => 'Cargo',
            'file' => 'Anexos',
            'data_solicitacao' => 'Data da Solicitação',
            'situacaocomunicacao' => 'Situação',
        ];
    }


    public function beforeSave($insert){
                if (parent::beforeSave($insert)) {
                if($insert){ 
                // Código a ser executado se for um insert
                //$this->com_datasolicitacao = new Expression('current_timestamp');
                //Comunicaação criada automaticamente passará a ser para autorização
                }
                // Código irá ser executado se for um insert ou update
                /*$this->com_dataautorizacao = new Expression('current_timestamp');*/
                return true;
                } else {
                return false;
                }
            }


    /**
     * @return \yii\db\ActiveQuery
     */
    
    public function getAnexos()
    {
        return $this->hasMany(Anexos::className(), ['ane_codcomunicacao' => 'com_codcomunicacao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSituacao()
    {
        return $this->hasOne(SituacaocomunicacaoSitco::className(), ['sitco_codsituacao' => 'com_codsituacao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComCodtipo()
    {
        return $this->hasOne(TipodocumentacaoTipdo::className(), ['tipdo_codtipo' => 'com_codtipo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDespachocomunicacaoDecos()
    {
        return $this->hasMany(DespachocomunicacaoDeco::className(), ['deco_codcomunicacao' => 'com_codcomunicacao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDestinocomunicacao()
    {
        return $this->hasMany(Destinocomunicacao::className(), ['dest_codcomunicacao' => 'com_codcomunicacao']);
    }

    public function getUnidades()
    {
        return $this->hasOne(Unidades::className(), ['uni_codunidade' => 'com_codunidade']);
    }

    public function getCargo()
    {
        return $this->hasOne(Cargos::className(), ['car_codcargo' => 'com_codcargoautorizacao']);
    }

    public function getColaborador()
    {
        return $this->hasOne(Colaborador::className(), ['col_codcolaborador' => 'com_codcolaborador']);
    }

  public function getColaboradorAutorizacao()
    {
        return $this->hasOne(Colaborador::className(), ['col_codcolaborador' => 'com_codcolaboradorautorizacao']);
    }
}