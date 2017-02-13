<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\planilhas\Planilhadecurso */

$this->title = 'Nova Planilha de Curso';
$this->params['breadcrumbs'][] = ['label' => 'Listagem Planilhas de Curso', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planilhadecurso-create">

<?php
    //Pega as mensagens
    foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
    echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
    }
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
