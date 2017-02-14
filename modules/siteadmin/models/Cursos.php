<?php

namespace app\modules\siteadmin\models;

use Yii;

/**
 * This is the model class for table "prog_cursos".
 *
 * @property integer $id
 * @property string $nome_curso
 * @property string $periodo
 * @property string $unidade
 * @property double $investimento
 * @property string $observacao
 */
class Cursos extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prog_cursos';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('senachttp');
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file'], 'file'],
            [['nome_curso', 'parcelamento','data_inicial', 'data_final','hora_inicial', 'hora_final', 'investimento', 'unidade_id', 'link'], 'required'],
            [['data_inicial','data_final','hora_inicial', 'hora_final'], 'safe'],
            [['investimento'], 'number'],
            //[['file'], 'file','skipOnEmpty' => false],
            [['nome_curso', 'observacao', 'nome'], 'string', 'max' => 130],
            [['link'],'url', 'defaultScheme' => 'http'],
            //[['link',], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome_curso' => 'Curso',
            'data_inicial' => 'Data Inicial',
            'data_final' => 'Data Final',
            'hora_inicial' => 'H. Inicial',
            'hora_final' => 'H. Final',
            'unidade_id' => 'Unidade',
            'parcelamento' => 'Parc',
            'investimento' => 'Invest',
            'observacao' => 'Observação',
            'nome' => 'Imagem do Curso',
            'file' => 'Imagem do Curso',
            'link' => 'Link + Cursos',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidades()
    {
        return $this->hasOne(Unidades::className(), ['id' => 'unidade_id']);
    }
}
