<?php

use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\modeloa\ModeloA */

$this->title = 'Atualizar Modelo A: ' . $model->moda_codmodelo;
$this->params['breadcrumbs'][] = ['label' => 'Listagem Modelo A', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->moda_codmodelo];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="modelo-a-update">

    <h1><?= Html::encode($this->title) ?></h1>

<?php
    //Pega as mensagens
    foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
    echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
    }
?>


    <p>
    <?= Html::a('<i class="glyphicon glyphicon-print"></i> Imprimir Modelo A', ['imprimir-modelo-a', 'id' => $model->moda_codmodelo], ['target'=>'_blank', 'class' => 'btn btn-info']) ?>

          <?= Html::a('Atualizar valores de Títulos conforme Planilhas', ['atualizar-modeloa-a-conforme-planilhas', 'id' => $model->moda_codmodelo], [
            'class' => 'btn btn-success','style' => 'margin-left: 22.33%;',
            'data' => [
                'confirm' => 'ATENÇÃO!!! É de extrema importância que você tenha este Modelo A impresso, pois os dados atuais serão modificados. Caso não tenha impresso ainda, cancele esta operação, caso contrário, confirme clicando em OK.',
                      ],
          ]) ?>
    </p>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsDetalhesModeloA'  => $modelsDetalhesModeloA,
        'situacaoModeloA' => $situacaoModeloA,
    ]) ?>

</div>
