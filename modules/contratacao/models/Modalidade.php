<?php

namespace app\modules\contratacao\models;

use Yii;

/**
 * This is the model class for table "modalidade".
 *
 * @property integer $id
 * @property string $descricao
 *
 * @property Processo[] $processos
 */
class Modalidade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modalidade';
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
            [['descricao'], 'required'],
            [['descricao'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Descricao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessos()
    {
        return $this->hasMany(Processo::className(), ['modalidade_id' => 'id']);
    }
}
