<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\aux_planejamento\models\cadastros\EstruturafisicaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cadastro de Equipamentos / Utensílios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estruturafisica-index">

<?php

//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}

?>


    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Novo Equipamentos / Utensílios', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'estr_cod',
            'estr_descricao',
            [
                'attribute' => 'estr_codcolaborador',
                'value' => 'colaborador.usuario.usu_nomeusuario',
            ],
            'estr_data',
            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'estr_status', 
                'vAlign'=>'middle'
            ], 
                        
            ['class' => 'yii\grid\ActionColumn','template' => '{update}'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
