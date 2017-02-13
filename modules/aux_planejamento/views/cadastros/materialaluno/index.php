<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\aux_planejamento\models\cadastros\MaterialalunoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Materiais do Aluno';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materialaluno-index">

<?php

//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}

?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Novo Material do Aluno', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'matalu_cod',
            'matalu_descricao',
            'matalu_unidade',
            'matalu_valor',
            [
                'attribute' => 'matalu_codcolaborador',
                'value' => 'colaborador.usuario.usu_nomeusuario',
            ],
            'matalu_data',
            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'matalu_status', 
                'vAlign'=>'middle'
            ], 
                        
            ['class' => 'yii\grid\ActionColumn','template' => '{update}'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
