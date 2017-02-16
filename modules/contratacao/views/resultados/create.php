<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Resultados */

$session = Yii::$app->session;
$processo_id = $session['sess_processo'];

$this->title = 'Inserir Resultado';
$this->params['breadcrumbs'][] = ['label' => 'Processos Seletivos', 'url' => ['processo-seletivo/index']];
$this->params['breadcrumbs'][] = ['label' => $processo_id, 'url' => ['processo-seletivo/view', 'id' => $processo_id]];
$this->params['breadcrumbs'][] = ['label' => 'Resultados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resultados-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
