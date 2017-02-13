<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\helpers\Url;

use app\modules\aux_planejamento\models\base\Unidade;
use app\modules\aux_planejamento\models\cadastros\Eixo;
use app\modules\aux_planejamento\models\cadastros\Segmento;
use app\modules\aux_planejamento\models\cadastros\Tipo;
use app\modules\aux_planejamento\models\cadastros\Tipoplanilha;
use app\modules\aux_planejamento\models\cadastros\Tipoprogramacao;
use app\modules\aux_planejamento\models\cadastros\Situacaoplanilha;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\aux_planejamento\models\planilhas\PlanilhadecursoPendentesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Listagem de Planilhas - Pendentes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planilhadecurso-pendentes-index">

<?php
    //Pega as mensagens
    foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
    echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
    }
?>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::button('Homologar Planejamento', ['value'=> Url::to('index.php?r=aux_planejamento/planilhas/planilhadecurso-pendentes/homologar-planejamento'), 'class' => 'btn btn-success', 'id'=>'modalButton']) ?>
    </p>

    <?php
        Modal::begin([
            'header' => '<h4>Defina a unidade a ser Homologada:</h4>',
            'id' => 'modal',
            'size' => 'modal-lg',
            ]);

        echo "<div id='modalContent'></div>";

        Modal::end();
   ?>

<?php Pjax::begin(); ?>    

<?php echo  GridView::widget([
            'dataProvider'=>$dataProvider,
            'filterModel'=>$searchModel,
            'pjax'=>true,
            'striped'=>true,
            'hover'=>true,
            'panel'=>['type'=>'primary', 'heading'=>'Listagem de Planilhas de Curso'],
            'columns'=>[
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'placu_codsegmento', 
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
                'attribute'=>'placu_codtipoa', 
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

            [
                'attribute'=>'placu_nomeunidade', 
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

            'placu_codplanilha',

            [
              'attribute'=>'PlanoLabel',
              'value'=> 'plano.plan_descricao',
               'width'=>'15%',
            ],

            [
                'attribute'=>'placu_codtipla', 
                'width'=>'250px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->tipoplanilha->tipla_descricao;
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(Tipoplanilha::find()->orderBy('tipla_descricao')->asArray()->all(), 'tipla_codtipla', 'tipla_descricao'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Tipo de Planilha'],
            ],

            [
                'attribute'=>'placu_codprogramacao', 
                'width'=>'250px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->tipoprogramacao->tipro_descricao;
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(Tipoprogramacao::find()->orderBy('tipro_descricao')->asArray()->all(), 'tipro_codprogramacao', 'tipro_descricao'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Programação'],
            ],

            [
                'attribute'=>'placu_codsituacao',
                'value' =>'situacaoPlani.sipla_descricao',
                'filter'=>false,
            ],
        
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {correcao}',
                'contentOptions' => ['style' => 'width: 350px;'],
                'buttons' => [

                //VISUALIZAR
                'view' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span> ', $url, [
                                'class'=>'btn btn-primary btn-xs',
               
                    ]);
                },

                //ENVIAR PARA CORREÇÃO E INSERIR JUSTIIFCATIVA
                'correcao' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-repeat"></span> Para Correção', $url, [
                                 'class'=>'btn btn-warning btn-xs',
                                 'id'=>'modalButton',
                           ]);
                        },

                ],
            ],

        ],
    ]); ?>
<?php Pjax::end(); ?></div>

