<?php

namespace app\modules\contratacao\models;

use Yii;

/**
 * This is the model class for table "sistemas_contratacao".
 *
 * @property integer $id
 * @property integer $sistema_id
 * @property integer $contratacao_id
 *
 * @property Contratacao $contratacao
 * @property Sistemas $sistema
 */
class SistemasContratacao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sistemas_contratacao';
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
            [['sistema_id', 'contratacao_id'], 'required'],
            [['sistema_id', 'contratacao_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sistema_id' => 'Sistema ID',
            'contratacao_id' => 'Contratacao ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratacao()
    {
        return $this->hasOne(Contratacao::className(), ['id' => 'contratacao_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSistema()
    {
        return $this->hasOne(Sistemas::className(), ['idsistema' => 'sistema_id']);
    }
}
