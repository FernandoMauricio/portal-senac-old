<?php

use yii\helpers\Html;
use kartik\widgets\DatePicker;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;

use app\modules\siteadmin\models\Unidades;


/* @var $this yii\web\View */
/* @var $searchModel app\modules\siteadmin\models\CursosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}


$this->title = 'Cursos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cursos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php

$gridColumns = [

            [
            'attribute'=>'unidade_id', 
            'width'=>'10%',
            'value'=>function ($model, $key, $index, $widget) { 
                return $model->unidades->uni_descricao;
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(Unidades::find()->orderBy('uni_descricao')->asArray()->all(), 'id', 'uni_descricao'), 
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
                 'filterInputOptions'=>['placeholder'=>'Selecione a Unidade'],
                 'group'=>true,  // enable grouping
            ],
                    'nome_curso',
                    'data_inicial',
                    'data_final',
                    'hora_inicial',
                    'hora_final',
                    'parcelamento',
                    'investimento',
                    'observacao',

            [
                         'label'=>'+ cursos',
                         'format'=>'raw',
                         'value' => function($model, $key, $index){
                             $url =  $model->link;
                             return Html::a($model->link, $url, ['target'=> '_blank']); 
                         }
            ],

               [
        'attribute' => 'nome',
        'format' => 'html',    
        'value' => function ($data) {
            return Html::img(Yii::getAlias('@web').'/'. $data['nome'],
                ['width' => '160px']);
        },
    ],

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{update}'],
        ]; ?>

 <?php Pjax::begin(['id'=>'w0-pjax']); ?>

    <?php 

    echo GridView::widget([
    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
    'columns'=>$gridColumns,
    'rowOptions' =>function($model){
                    if($model->unidade_id == 1 ){

                            return['class'=>'default'];                        
                    } if($model->unidade_id == 2 ){

                            return['class'=>'success'];                        
                    }
                    if($model->unidade_id == 3 ){

                            return['class'=>'warning'];                        
                    }
                    if($model->unidade_id == 4 ){

                            return['class'=>'info'];                        
                    }

                    if($model->unidade_id == 5 ){

                            return['class'=>'danger'];                        
                    }

                    if($model->unidade_id == 6){

                            return['class'=>'default'];                        
                    }
        },

    'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'pjax'=>true, // pjax is set to always true for this demo
    'condensed' => true,
    'hover' => true,
    'beforeHeader'=>[
        [
            'columns'=>[
                ['content'=>'Detalhes dos cursos oferecidos pelo Senac', 'options'=>['colspan'=>11, 'class'=>'text-center warning']], 
                ['content'=>'Ações', 'options'=>['colspan'=>2, 'class'=>'text-center warning']], 
            ],
        ]
    ],

        'panel' => [
        'type'=>GridView::TYPE_PRIMARY,
        'heading'=> '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Listagem  de Cursos </h3>',
    ],
]);
    ?>
    <?php Pjax::end(); ?>

</div>

