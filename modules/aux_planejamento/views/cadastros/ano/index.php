<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\aux_planejamento\models\cadastros\AnoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cadastro de Ano';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ano-index">

<?php

//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}

?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Novo Ano', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'an_codano',
            'an_ano',
            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'an_status', 
                'vAlign'=>'middle'
            ], 

            ['class' => 'yii\grid\ActionColumn','template' => '{update}'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
