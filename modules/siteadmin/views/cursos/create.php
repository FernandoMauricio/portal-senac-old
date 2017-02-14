<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\siteadmin\models\Cursos */

$this->title = 'Create Cursos';
$this->params['breadcrumbs'][] = ['label' => 'Cursos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cursos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
