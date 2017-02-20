<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\aux_planejamento\models\cadastros\MaterialconsumoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Materiais de Consumo';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materialconsumo-index">

<?php

//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}

?>

    <h1><?= Html::encode($this->title) ?></h1>


    <p>
        <?= Html::a('Novo Material de Consumo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<!--     <p>
        <?= Html::a('Importar Cadastros - MXM', ['/cadastros/materialconsumo/import-excel-material-consumo'], ['class' => 'btn btn-primary']) ?>
    </p>
 -->

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'matcon_codMXM',
            'matcon_descricao',
            'matcon_tipo',
            'matcon_valor',
            [
                'attribute' => 'matcon_codcolaborador',
                'value' => 'colaborador.usuario.usu_nomeusuario',
            ],
            'matcon_data',
            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'matcon_status', 
                'vAlign'=>'middle'
            ], 
                        
            ['class' => 'yii\grid\ActionColumn','template' => '{update}'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
