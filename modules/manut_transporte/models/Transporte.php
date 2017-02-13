<?php

namespace app\modules\manut_transporte\models;

use Yii;

/**
 * This is the model class for table "transporte".
 *
 * @property integer $id
 * @property string $data_solicitacao
 * @property string $descricao_transporte
 * @property string $local
 * @property integer $bairro_id
 * @property string $data_prevista
 * @property string $hora_prevista
 * @property string $data_confirmacao
 * @property string $hora_confirmacao
 * @property integer $tipo_solic_id
 * @property integer $tipocarga_id
 * @property integer $situacao_id
 * @property integer $motorista_id
 * @property integer $idusuario_solic
 * @property integer $idusuario_suport
 *
 * @property Forum[] $forums
 * @property TipoSolic $tipoSolic
 * @property Situacao $situacao
 * @property Bairro $bairro
 * @property Motorista $motorista
 * @property TipoCarga $tipocarga
 */
class Transporte extends \yii\db\ActiveRecord
{
    public $tipo_transporte;
    public $tipo_carga_label;
    public $motorista_label;
    public $situacao_label;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transporte';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_manut_transporte');
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_solicitacao', 'bairro_id', 'tipocarga_id', 'local', 'descricao_transporte', 'data_prevista', 'hora_prevista', 'idusuario_solic', 'usuario_solic_nome'], 'required'],
            [['data_solicitacao', 'data_prevista', 'hora_prevista', 'data_confirmacao', 'hora_confirmacao', 'tipo_transporte', 'tipo_carga_label','motorista_label', 'situacao_label'], 'safe'],
            [['descricao_transporte'], 'string'],
            [['bairro_id', 'tipo_solic_id', 'tipocarga_id', 'situacao_id', 'motorista_id', 'idusuario_solic', 'idusuario_suport', 'cod_unidade_solic', 'cod_unidade_suport'], 'integer'],
            [['local'], 'string', 'max' => 100],
            [['tipo_solic_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoSolic::className(), 'targetAttribute' => ['tipo_solic_id' => 'id']],
            [['situacao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Situacao::className(), 'targetAttribute' => ['situacao_id' => 'id']],
            [['bairro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bairro::className(), 'targetAttribute' => ['bairro_id' => 'idbairro']],
            [['motorista_id'], 'exist', 'skipOnError' => true, 'targetClass' => Motorista::className(), 'targetAttribute' => ['motorista_id' => 'id']],
            [['tipocarga_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoCarga::className(), 'targetAttribute' => ['tipocarga_id' => 'idtipo_carga']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Código',
            'data_solicitacao' => 'Data Solicitação',
            'descricao_transporte' => 'Descrição',
            'local' => 'Local',
            'bairro_id' => 'Bairro',
            'data_prevista' => 'Data Prevista',
            'hora_prevista' => 'Hora Prevista',
            'data_confirmacao' => 'Data Confirmada',
            'hora_confirmacao' => 'Hora Confirmada',
            'tipo_solic_id' => 'Tipo de Solicitação',
            'tipocarga_id' => 'Tipo de Carga',
            'situacao_id' => 'Situacao ID',
            'motorista_id' => 'Motorista ID',
            'idusuario_solic' => 'ID Usuário Solicitante',
            'usuario_solic_nome'=>'Solicitante',
            'idusuario_suport' => 'ID Usuário Suporte',
            'usuario_suport_nome'=>'Responsável pelo Atendimento',
           
            'tipo_transporte' => 'Tipo de Solicitação',
            'tipo_carga_label' => 'Tipo de Carga',
            'motorista_label' => 'Motorista Responsável',
            'situacao_label' => 'Situação',

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForums()
    {
        return $this->hasMany(Forum::className(), ['transporte_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoSolic()
    {
        return $this->hasOne(TipoSolic::className(), ['id' => 'tipo_solic_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSituacao()
    {
        return $this->hasOne(Situacao::className(), ['id' => 'situacao_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBairro()
    {
        return $this->hasOne(Bairro::className(), ['idbairro' => 'bairro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMotorista()
    {
        return $this->hasOne(Motorista::className(), ['id' => 'motorista_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoCarga()
    {
        return $this->hasOne(TipoCarga::className(), ['idtipo_carga' => 'tipocarga_id']);
    }

}
