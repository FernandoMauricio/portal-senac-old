<?php

namespace app\modules\contratacao\models;

use Yii;

/**
 * This is the model class for table "situacao_contratacao".
 *
 * @property integer $cod_situacao
 * @property string $descricao
 *
 * @property Contratacao[] $contratacaos
 */
class SituacaoContratacao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'situacao_contratacao';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_processos');
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cod_situacao' => 'Cod Situacao',
            'descricao' => 'Descricao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratacaos()
    {
        return $this->hasMany(Contratacao::className(), ['situacao_id' => 'cod_situacao']);
    }
}
