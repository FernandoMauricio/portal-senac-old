<?php

namespace app\modules\aux_planejamento\models\modeloa;

use Yii;

/**
 * This is the model class for table "entradamodeloa_enta".
 *
 * @property string $enta_codentrada
 * @property string $enta_entrada
 *
 * @property ModeloaModa[] $modeloaModas
 */
class EntradaModeloA extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entradamodeloa_enta';
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
            [['enta_entrada'], 'required'],
            [['enta_entrada'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'enta_codentrada' => 'Enta Codentrada',
            'enta_entrada' => 'Enta Entrada',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModeloaModas()
    {
        return $this->hasMany(ModeloaModa::className(), ['moda_codentrada' => 'enta_codentrada']);
    }
}
