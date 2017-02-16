<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ContratacaoJustificativas */

$session = Yii::$app->session;
$id_contratacao = $session['sess_contratacao'];

//$this->title = 'Inserir Justificativa';
$this->params['breadcrumbs'][] = ['label' => 'Contratações Pendentes', 'url' => ['contratacao-pendente/index']];
$this->params['breadcrumbs'][] = ['label' => $id_contratacao, 'url' => ['contratacao-pendente/view', 'id' => $id_contratacao]];
$this->params['breadcrumbs'][] = ['label' => 'Justificativas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="contratacao-justificativas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
