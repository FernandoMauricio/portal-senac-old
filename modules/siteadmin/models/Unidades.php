<?php

namespace app\modules\siteadmin\models;

use Yii;

/**
 * This is the model class for table "unidades".
 *
 * @property integer $id
 * @property string $uni_descricao
 * @property integer $uni_situacao
 *
 * @property ProgCursos[] $progCursos
 */
class Unidades extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'unidades';
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
            [['uni_situacao'], 'integer'],
            [['uni_descricao'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uni_descricao' => 'Uni Descricao',
            'uni_situacao' => 'Uni Situacao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgCursos()
    {
        return $this->hasMany(ProgCursos::className(), ['unidade_id' => 'id']);
    }
}
