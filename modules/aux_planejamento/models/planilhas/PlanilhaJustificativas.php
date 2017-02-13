<?php

namespace app\modules\aux_planejamento\models\planilhas;

use Yii;

/**
 * This is the model class for table "planilha_justificativas".
 *
 * @property integer $id
 * @property string $planijust_descricao
 * @property string $planijust_usuario
 * @property string $planilhadecurso_id
 *
 * @property PlanilhadecursoPlacu $planilhadecurso
 */
class PlanilhaJustificativas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'planilha_justificativas';
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
            [['planijust_descricao', 'planijust_usuario', 'planilhadecurso_id'], 'required'],
            [['planilhadecurso_id'], 'integer'],
            [['planijust_descricao'], 'string', 'max' => 255],
            [['planijust_usuario'], 'string', 'max' => 45],
            [['planilhadecurso_id'], 'exist', 'skipOnError' => true, 'targetClass' => Planilhadecurso::className(), 'targetAttribute' => ['planilhadecurso_id' => 'placu_codplanilha']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'planijust_descricao' => 'Justificativa',
            'planijust_usuario' => 'Colaborador',
            'planilhadecurso_id' => 'Cód. Planilha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanilhadecurso()
    {
        return $this->hasOne(PlanilhadecursoPlacu::className(), ['placu_codplanilha' => 'planilhadecurso_id']);
    }
}
