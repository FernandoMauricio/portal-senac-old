<?php

namespace app\modules\aux_planejamento\models\base;

use Yii;

/**
 * This is the model class for table "anocentrocusto_ance".
 *
 * @property string $ance_coddocano
 * @property integer $ance_ano
 *
 * @property CentrocustoCen[] $centrocustoCens
 */
class Anocentrocusto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'anocentrocusto_ance';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_base');
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ance_ano'], 'required'],
            [['ance_ano'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ance_coddocano' => 'Ance Coddocano',
            'ance_ano' => 'Ance Ano',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCentrocustoCens()
    {
        return $this->hasMany(CentrocustoCen::className(), ['cen_codano' => 'ance_coddocano']);
    }
}
