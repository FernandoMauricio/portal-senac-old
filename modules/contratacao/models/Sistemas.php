<?php

namespace app\modules\contratacao\models;

use Yii;

/**
 * This is the model class for table "sistemas".
 *
 * @property integer $idsistema
 * @property string $descricao
 * @property integer $status
 *
 * @property SistemasContratacao[] $sistemasContratacaos
 */
class Sistemas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sistemas';
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
            [['descricao', 'status'], 'required'],
            [['status'], 'integer'],
            [['descricao'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idsistema' => 'Idsistema',
            'descricao' => 'Descrição',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSistemasContratacaos()
    {
        return $this->hasMany(SistemasContratacao::className(), ['sistema_id' => 'idsistema']);
    }
}
