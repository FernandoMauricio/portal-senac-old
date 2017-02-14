<?php

namespace app\modules\siteadmin\models\vestibular;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property integer $id
 * @property string $descricao
 *
 * @property VestibularVest[] $vestibularVests
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_vestibular');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao'], 'required'],
            [['descricao'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Descricao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVestibularVests()
    {
        return $this->hasMany(VestibularVest::className(), ['status_id' => 'id']);
    }
}
