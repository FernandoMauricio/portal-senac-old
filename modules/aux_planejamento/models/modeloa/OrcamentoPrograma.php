<?php

namespace app\modules\aux_planejamento\models\modeloa;

use Yii;

/**
 * This is the model class for table "orcamentoprograma_orcpro".
 *
 * @property string $orcpro_codorcpro
 * @property string $orcpro_codigo
 * @property string $orcpro_titulo
 * @property integer $orcpro_identificacao
 * @property string $orcpro_codtipo
 *
 * @property TipodespesaorcamentoTiporc $orcproCodtipo
 */
class OrcamentoPrograma extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orcamentoprograma_orcpro';
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
            [['orcpro_codigo', 'orcpro_titulo', 'orcpro_identificacao', 'orcpro_codtipo'], 'required'],
            [['orcpro_identificacao', 'orcpro_codtipo'], 'integer'],
            [['orcpro_codigo'], 'string', 'max' => 15],
            [['orcpro_titulo'], 'string', 'max' => 50],
            [['orcpro_codtipo'], 'exist', 'skipOnError' => true, 'targetClass' => TipodespesaorcamentoTiporc::className(), 'targetAttribute' => ['orcpro_codtipo' => 'tiporc_codtipo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orcpro_codorcpro' => 'Orcpro Codorcpro',
            'orcpro_codigo' => 'Orcpro Codigo',
            'orcpro_titulo' => 'Orcpro Titulo',
            'orcpro_identificacao' => 'Orcpro Identificacao',
            'orcpro_codtipo' => 'Orcpro Codtipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrcproCodtipo()
    {
        return $this->hasOne(TipodespesaorcamentoTiporc::className(), ['tiporc_codtipo' => 'orcpro_codtipo']);
    }
}
