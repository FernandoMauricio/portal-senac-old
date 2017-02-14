<?php

namespace app\modules\siteadmin;

/**
 * siteadmin module definition class
 */
class Siteadmin extends \yii\base\Module
{
    public $layout = 'main';
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\siteadmin\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
