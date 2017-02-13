<?php

namespace app\modules\aux_planejamento\controllers;

use yii\web\Controller;

/**
 * Default controller for the `aux_planejamento` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
