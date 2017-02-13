<?php

namespace app\modules\manut_transporte\models;

use Yii;

/**
 * This is the model class for table "bairro".
 *
 * @property integer $idbairro
 * @property string $descricao
 *
 * @property Transporte[] $transportes
 */
class Bairro extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bairro';
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
            [['descricao'], 'required'],
            [['descricao'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idbairro' => 'Idbairro',
            'descricao' => 'Bairro',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransportes()
    {
        return $this->hasMany(Transporte::className(), ['bairro_id' => 'idbairro']);
    }
}
