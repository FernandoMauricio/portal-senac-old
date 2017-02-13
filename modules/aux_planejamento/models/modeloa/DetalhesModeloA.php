<?php

namespace app\modules\aux_planejamento\models\modeloa;

use Yii;

/**
 * This is the model class for table "detalhesmodeloa_deta".
 *
 * @property string $id
 * @property string $deta_codmodelo
 * @property string $deta_codsegmento
 * @property string $deta_codtipoa
 * @property string $deta_codtitulo
 * @property string $deta_titulo
 * @property integer $deta_identificacao
 * @property string $deta_codtipo
 * @property double $deta_programado
 * @property double $deta_reforcoreducao
 *
 * @property ModeloaModa $detaCodmodelo
 */
class DetalhesModeloA extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detalhesmodeloa_deta';
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
            [['deta_codsegmento', 'deta_codtipoa', 'deta_codtitulo', 'deta_titulo', 'deta_identificacao', 'deta_codtipo', 'deta_programado', 'deta_reforcoreducao'], 'required'],
            [['deta_codmodelo', 'deta_codsegmento', 'deta_codtipoa', 'deta_identificacao', 'deta_codtipo'], 'integer'],
            [['deta_programado', 'deta_reforcoreducao', 'deta_dotacaofinal'], 'number'],
            [['deta_codtitulo'], 'string', 'max' => 15],
            [['deta_titulo'], 'string', 'max' => 50],
            [['deta_codmodelo'], 'exist', 'skipOnError' => true, 'targetClass' => ModeloA::className(), 'targetAttribute' => ['deta_codmodelo' => 'moda_codmodelo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '',
            'deta_codmodelo' => '',
            'deta_codsegmento' => '',
            'deta_codtipoa' => '',
            'deta_codtitulo' => '',
            'deta_titulo' => '',
            'deta_identificacao' => '',
            'deta_codtipo' => '',
            'deta_programado' => 'Programado',
            'deta_reforcoreducao' => 'Reforço (+) Redução (-)',
            'deta_dotacaofinal' => 'Dotação Final',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModeloA()
    {
        return $this->hasOne(ModeloA::className(), ['moda_codmodelo' => 'deta_codmodelo']);
    }
}
