<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\aux_planejamento\models\cadastros\SegmentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cadastro de Segmento';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="segmento-index">

<?php

//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}

?>


    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Novo Segmento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'seg_codsegmento',
            'seg_descricao',
            [
                'attribute' => 'seg_codeixo',
                'value' => 'eixo.eix_descricao'
            ],
            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'seg_status', 
                'vAlign'=>'middle'
            ], 
                        
            ['class' => 'yii\grid\ActionColumn','template' => '{update}'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
