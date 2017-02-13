<?php

namespace app\modules\aux_planejamento\models\planilhas;

use Yii;

/**
 * This is the model class for table "planilhaunidadescurriculares_planiuc".
 *
 * @property integer $id
 * @property string $planilhadecurso_cod
 * @property integer $planodeacao_cod
 * @property string $planiuc_descricao
 * @property integer $planiuc_cargahoraria
 * @property integer $planiuc_nivelUC
 *
 * @property PlanilhadecursoPlacu $planilhadecursoCod
 */
class PlanilhaUnidadesCurriculares extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'planilhaunidadescurriculares_planiuc';
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
            [['planilhadecurso_cod', 'planodeacao_cod', 'planiuc_cargahoraria', 'planiuc_nivelUC'], 'integer'],
            [['planiuc_descricao'], 'string', 'max' => 255],
            [['planilhadecurso_cod'], 'exist', 'skipOnError' => true, 'targetClass' => Planilhadecurso::className(), 'targetAttribute' => ['planilhadecurso_cod' => 'placu_codplanilha']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'planilhadecurso_cod' => 'Cód. Planilha',
            'planodeacao_cod' => 'Cód. Plano',
            'planiuc_descricao' => 'Descrição',
            'planiuc_cargahoraria' => 'Carga Horária',
            'planiuc_nivelUC' => 'UC',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanilhadecursoCod()
    {
        return $this->hasOne(PlanilhadecursoPlacu::className(), ['placu_codplanilha' => 'planilhadecurso_cod']);
    }
}
