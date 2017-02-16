<?php

namespace app\modules\contratacao\models;

use Yii;

/**
 * This is the model class for table "recrutamento".
 *
 * @property integer $idrecrutamento
 * @property string $descricao
 *
 * @property Contratacao[] $contratacaos
 */
class Recrutamento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'recrutamento';
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
            'idrecrutamento' => 'Idrecrutamento',
            'descricao' => 'Descricao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratacaos()
    {
        return $this->hasMany(Contratacao::className(), ['recrutamento_id' => 'idrecrutamento']);
    }
}
