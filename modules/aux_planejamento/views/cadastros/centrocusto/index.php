<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\helpers\Url;

use app\modules\aux_planejamento\models\base\Unidade;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\aux_planejamento\models\cadastros\CentrocustoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Centros de Custo';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="centrocusto-index">

<?php

//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}

?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Novo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php echo  GridView::widget([
            'dataProvider'=>$dataProvider,
            'filterModel'=>$searchModel,
            'pjax'=>true,
            'striped'=>true,
            'hover'=>true,
            'panel'=>['type'=>'primary', 'heading'=>'Listagem de Centros de Custo'],
            'columns' => [
            [
                'attribute'=>'nomeUnidade', 
                'width'=>'350px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->unidade->uni_nomeabreviado;
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(Unidade::find()->orderBy('uni_nomeabreviado')->asArray()->all(), 'uni_nomeabreviado', 'uni_nomeabreviado'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Selecione a Unidade'],
            ],
            'cen_codcentrocusto',
            [
                'attribute' => 'cen_codano',
                'value' => 'ano.ance_ano'
            ],

            'cen_centrocusto',
            'cen_centrocustoreduzido',
            'cen_nomecentrocusto',

            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'cen_codsituacao', 
                'vAlign'=>'middle'
            ], 

            ['class' => 'yii\grid\ActionColumn','template' => '{update}'],
        ],
    ]); ?>
</div>
