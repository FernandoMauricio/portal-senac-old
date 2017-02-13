<?php

namespace app\modules\aux_planejamento\models\planilhas;

use Yii;

/**
 * This is the model class for table "planilhamaterial_planima".
 *
 * @property string $id
 * @property string $planilhadecurso_cod
 * @property integer $planima_codplano
 * @property string $planima_tipoplano
 * @property integer $planima_codrepositorio
 * @property string $planima_titulo
 * @property double $planima_valor
 * @property string $planima_arquivo
 * @property string $planima_tipomaterial
 * @property string $planima_editora
 * @property string $planima_observacao
 * @property integer $planima_nivelUC
 *
 * @property PlanilhadecursoPlacu $planilhadecursoCod
 */
class PlanilhaMaterial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'planilhamaterial_planima';
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
            [['planilhadecurso_cod', 'planima_codmxm', 'planima_codplano', 'planima_codrepositorio', 'planima_nivelUC'], 'integer'],
            [['planima_valor'], 'number'],
            [['planima_tipoplano'], 'string', 'max' => 45],
            [['planima_titulo', 'planima_arquivo', 'planima_observacao'], 'string', 'max' => 100],
            [['planima_tipomaterial', 'planima_editora'], 'string', 'max' => 50],
            [['planilhadecurso_cod'], 'exist', 'skipOnError' => true, 'targetClass' => Planilhadecurso::className(), 'targetAttribute' => ['planilhadecurso_cod' => 'placu_codplanilha']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Código',
            'planilhadecurso_cod' => 'Cód. Planilha',
            'planima_codplano' => 'Cód. Plano',
            'planima_tipoplano' => 'Tipo do Plano',
            'planima_codrepositorio' => 'Cód. Repositório',
            'planima_titulo' => 'Titulo',
            'planima_codmxm' => 'Cód. MXM',
            'planima_valor' => 'Valor',
            'planima_arquivo' => 'Arquivo',
            'planima_tipomaterial' => 'Tipo Material',
            'planima_editora' => 'Editora',
            'planima_observacao' => 'Observação',
            'planima_nivelUC' => 'UC',
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
