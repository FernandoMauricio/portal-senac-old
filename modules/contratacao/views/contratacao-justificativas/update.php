<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ContratacaoJustificativas */

$session = Yii::$app->session;
$id_contratacao = $session['sess_contratacao'];

$this->title = 'Atualizar Justificativa';
$this->params['breadcrumbs'][] = ['label' => 'Contratações em Andamento', 'url' => ['contratacao-em-andamento/index']];
$this->params['breadcrumbs'][] = ['label' => $id_contratacao, 'url' => ['contratacao-em-andamento/view', 'id' => $id_contratacao]];
$this->params['breadcrumbs'][] = ['label' => 'Justificativas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="contratacao-justificativas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
