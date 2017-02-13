<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\manut_transporte\models\ManutencaoAdminEncerradas */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Manutenções', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}

?>
<div class="manutencao-admin-encerradas-view">

    <h1><?= Html::encode($this->title) ?></h1>

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Detalhes - Solicitação de Manutenção </h3>
  </div>
  <div class="panel-body">
  <div class="row">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tipoSolic.descricao', //tipo_solic_id
            [
                'attribute' => 'data_solicitacao',
                'format'=>['datetime', 'php:d/m/Y'],
            ],
            'titulo',
            'descricao_manut:ntext',
            'usuario_solic_nome',
            'usuario_suport_nome',
           
        ],
    ]) ?>

        </div>
     </div>
    </div>

<?= $this->render('/forum/view-manutencao', [
            'forum' => $forum,
        ]); ?>
        
</div>

