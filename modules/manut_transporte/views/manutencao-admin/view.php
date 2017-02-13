<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\manut_transporte\models\ManutencaoAdmin */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Manutenções', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}

?>
<div class="manutencao-admin-view">

    <h1><?= Html::encode($this->title) ?></h1>

 <?php

 //MENSAGEM INFORMANDO O USUÁRIO E A DATA QUE FINALIZOU A CI
  if($model->situacao_id == 3 AND $model->usuario_encerramento != NULL ){

    echo "<div class='alert alert-danger' align='center' role='alert'><span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Solicitação de  ". $model->tipoSolic->descricao ." <strong>Encerrada</strong> por: <strong> ". $model->usuario_encerramento ."</strong> na data ". date('d/m/Y à\s H:i', strtotime($model->data_encerramento)) ."</div>";

  }

    ?>


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
        

    <?= $this->render('/forum/create', [
        'forum' => $forum,
    ]) ?>

</div>

