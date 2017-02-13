<?php

namespace app\modules\manut_transporte\controllers;

use yii\web\Controller;

/**
 * Default controller for the `manut_transporte` module
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
