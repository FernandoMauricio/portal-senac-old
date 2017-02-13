<?php

namespace app\modules\manut_transporte\models;

use Yii;

/**
 * This is the model class for table "manutencao".
 *
 * @property integer $id
 * @property string $data_solicitacao
 * @property string $titulo
 * @property string $descricao_manut
 * @property integer $idusuario_solic
 * @property string $usuario_solic_nome
 * @property integer $idusuario_suport
 * @property string $usuario_suport_nome
 * @property string $usuario_encerramento
 * @property string $data_encerramento
 * @property integer $cod_unidade_solic
 * @property integer $cod_unidade_suport
 * @property integer $tipo_solic_id
 * @property integer $situacao_id
 *
 * @property Forum[] $forums
 * @property Situacao $situacao
 * @property TipoSolic $tipoSolic
 */
class ManutencaoAdminEncerradas extends \yii\db\ActiveRecord
{

    public $situacao_label;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'manutencao';
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
            [['data_solicitacao', 'data_encerramento', 'situacao_label'], 'safe'],
            [['titulo', 'tipo_solic_id'], 'required'],
            [['descricao_manut'], 'string'],
            [['idusuario_solic', 'idusuario_suport', 'cod_unidade_solic', 'cod_unidade_suport', 'tipo_solic_id', 'situacao_id'], 'integer'],
            [['titulo'], 'string', 'max' => 255],
            [['usuario_solic_nome', 'usuario_suport_nome', 'usuario_encerramento'], 'string', 'max' => 45],
            [['situacao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Situacao::className(), 'targetAttribute' => ['situacao_id' => 'id']],
            [['tipo_solic_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoSolic::className(), 'targetAttribute' => ['tipo_solic_id' => 'id']],
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
            'titulo' => 'Titulo',
            'descricao_manut' => 'Descrição',
            'idusuario_solic' => 'Idusuario Solic',
            'usuario_solic_nome' => 'Solicitante',
            'idusuario_suport' => 'Idusuario Suport',
            'usuario_suport_nome' => 'Responsável',
            'usuario_encerramento' => 'Usuario Encerramento',
            'data_encerramento' => 'Data Encerramento',
            'cod_unidade_solic' => 'Cod Unidade Solic',
            'cod_unidade_suport' => 'Cod Unidade Suport',
            'tipo_solic_id' => 'Situação',

            'situacao_label' => 'Situação',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForums()
    {
        return $this->hasMany(Forum::className(), ['manutencao_id' => 'id']);
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
    public function getTipoSolic()
    {
        return $this->hasOne(TipoSolic::className(), ['id' => 'tipo_solic_id']);
    }
}
