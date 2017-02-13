<?php

namespace app\modules\aux_planejamento\models\despesas;

use Yii;

/**
 * This is the model class for table "salas_sal".
 *
 * @property integer $sal_codsala
 * @property string $sal_descricao
 * @property integer $sal_status
 *
 * @property CustosindiretoCustin[] $custosindiretoCustins
 */
class Salas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'salas_sal';
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
            [['sal_descricao', 'sal_status'], 'required'],
            [['sal_status'], 'integer'],
            [['sal_descricao'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sal_codsala' => 'Código',
            'sal_descricao' => 'Descrição da Sala',
            'sal_status' => 'Situação',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustosindiretoCustins()
    {
        return $this->hasMany(CustosindiretoCustin::className(), ['salas_id' => 'sal_codsala']);
    }
}
