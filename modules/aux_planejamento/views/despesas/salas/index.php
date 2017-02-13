<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\aux_planejamento\models\despesas\SalasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Listagem de Salas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salas-index">

<?php

//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}

?>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Nova Sala', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'sal_codsala',
            'sal_descricao',
            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'sal_status', 
                'vAlign'=>'middle'
            ], 

            ['class' => 'yii\grid\ActionColumn','template' => '{update}'],
        ],
    ]); ?>
</div>
