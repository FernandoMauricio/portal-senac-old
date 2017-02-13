<?php

namespace app\modules\aux_planejamento\models\modeloa;

use Yii;

/**
 * This is the model class for table "situacaomodeloa_simoa".
 *
 * @property string $simoa_codsituacao
 * @property string $simoa_situacao
 *
 * @property ModeloaModa[] $modeloaModas
 */
class SituacaoModeloA extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'situacaomodeloa_simoa';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_apl');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['simoa_situacao'], 'required'],
            [['simoa_situacao'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'simoa_codsituacao' => 'Simoa Codsituacao',
            'simoa_situacao' => 'Simoa Situacao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModeloaModas()
    {
        return $this->hasMany(ModeloaModa::className(), ['moda_codsituacao' => 'simoa_codsituacao']);
    }
}
