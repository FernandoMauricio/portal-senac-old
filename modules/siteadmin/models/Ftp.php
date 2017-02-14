<?php

namespace app\modules\siteadmin\models;

use Yii;

/**
 * This is the model class for table "ftp".
 *
 * @property integer $id
 * @property string $arquivo
 */
class Ftp extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ftp';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file'], 'file', 'extensions' => 'pdf, jpg, png', 'maxSize' => 1024 * 1024 * 5, 'tooBig' => 'O arquivo é grande demais. Seu tamanho não pode exceder 5MB.'],
            [['arquivo', 'nome'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'arquivo' => 'Arquivo',
            'file' => 'Arquivo',
        ];
    }
}
