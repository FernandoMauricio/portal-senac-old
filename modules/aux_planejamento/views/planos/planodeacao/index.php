<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;

use app\modules\aux_planejamento\models\cadastros\Eixo;
use app\modules\aux_planejamento\models\cadastros\Segmento;
use app\modules\aux_planejamento\models\cadastros\Tipo;
use app\modules\aux_planejamento\models\planos\Categoria;
use app\modules\aux_planejamento\models\planos\PlanoCategorias;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\aux_planejamento\models\planos\PlanodeacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Planos de Ação';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planodeacao-index">

<?php
$session = Yii::$app->session;

//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}

?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
        if($session['sess_codunidade'] == 11) { //ÁREA DA DEP
    ?>
            <p>
                <?= Html::a('Novo Plano de Ação', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
    <?php
        }
    ?>

<?php Pjax::begin(); ?>    

<?php echo  GridView::widget([
            'dataProvider'=>$dataProvider,
            'filterModel'=>$searchModel,
            'pjax'=>true,
            'striped'=>true,
            'hover'=>true,
            'panel'=>['type'=>'primary', 'heading'=>'Listagem de Planos de Ação'],
            'columns'=>[
            ['class' => 'yii\grid\SerialColumn'],

            [
            'attribute'=>'plan_codsegmento', 
            'width'=>'310px',
            'value'=>function ($model, $key, $index, $widget) { 
                return $model->segmento->seg_descricao;
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(Segmento::find()->orderBy('seg_descricao')->asArray()->all(), 'seg_codsegmento', 'seg_descricao'), 
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
                'filterInputOptions'=>['placeholder'=>'Selecione o Segmento'],
                'group'=>true,  // enable grouping
                'groupHeader'=>function ($model, $key, $index, $widget) { // Closure method
                    return [
                        'mergeColumns'=>[[1, 3]], // columns to merge in summary
                        'content'=>[             // content to show in each summary cell
                            1=> $model->eixo->eix_descricao,
                        ],
                        // html attributes for group summary row
                        'options'=>['class'=>'info','style'=>'font-weight:bold;']
                    ];
                }
            ],


            [
            'attribute'=>'plan_codtipoa', 
            'width'=>'250px',
            'value'=>function ($model, $key, $index, $widget) { 
                return $model->tipo->tip_descricao;
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(Tipo::find()->orderBy('tip_descricao')->asArray()->all(), 'tip_codtipoa', 'tip_descricao'), 
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'Selecione o Tipo de Ação'],
            'group'=>true,  // enable grouping
            'subGroupOf'=>1, // supplier column index is the parent group,
        ],
            'plan_codplano',
            'plan_descricao',

            [
                'label' => 'Categorias do <br> Plano',
                'encodeLabel' => false,
                'attribute' => 'plan_categoriasPlano',
                'width'=>'5%',
                'value' => function($model) {
                        return implode(', ', \yii\helpers\ArrayHelper::map($model->planoCategorias, 'id', 'categoria.descricao'));
                    },
            ],

            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'plan_status', 
                'vAlign'=>'middle'
            ], 

            [
                'label' => 'Novo Modelo <br> Pedagógico',
                'class'=>'kartik\grid\BooleanColumn',
                'trueLabel' => 'Sim',
                'falseLabel' => 'Não',
                'attribute'=>'plan_modelonacional', 
                'vAlign'=>'middle',
                'encodeLabel' => false,
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
                'options' => ['width' => '5%'],
                'buttons' => [

                //Só aparecerá para editar caso o usuário seja da DEP
                'update' => function ($url, $model) {
                    $session = Yii::$app->session;
                    if($session['sess_codunidade'] == 11){
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'title' => Yii::t('app', 'Editar Plano'),
                    ]);
                    }else{
                        '';
                    }
                },

                ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
