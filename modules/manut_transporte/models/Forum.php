<?php

namespace app\modules\manut_transporte\models;

use Yii;

/**
 * This is the model class for table "forum".
 *
 * @property integer $id
 * @property string $mensagem
 * @property string $data
 * @property integer $usuario_id
 * @property integer $transporte_id
 *
 * @property Transporte $solicitacao
 */
class Forum extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'forum';
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
            [['mensagem', 'data', 'usuario_id'], 'required'],
            [['mensagem'], 'string'],
            [['data', 'transporte_id', 'manutencao_id'], 'safe'],
            [['usuario_id', 'transporte_id'], 'integer'],
            [['transporte_id'], 'exist', 'skipOnError' => true, 'targetClass' => Transporte::className(), 'targetAttribute' => ['transporte_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mensagem' => 'Mensagem',
            'data' => 'Data',
            'usuario_id' => 'Usuario ID',
            'transporte_id' => 'Solicitacao ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitacao()
    {
        return $this->hasOne(Transporte::className(), ['id' => 'transporte_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitacao2()
    {
        return $this->hasOne(Manutencao::className(), ['id' => 'manutencao_id']);
    }
}
