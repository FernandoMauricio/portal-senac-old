<?php

namespace app\modules\siteadmin\models;
use yii\web\UploadedFile;

use Yii;

/**
 * This is the model class for table "banners".
 *
 * @property integer $id
 * @property string $nome
 */
class Banners extends \yii\db\ActiveRecord
{
    public $file;
    public $file_anexo;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banners';
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
            //[['file'], 'file', 'skipOnEmpty' => false],
            //[['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['nome'], 'string', 'max' => 60],
            [['src'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Banner',
            'file' => 'Banner',
            'src' => 'Link',
        ];
    }

  
}
