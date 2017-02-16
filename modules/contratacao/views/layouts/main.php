<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use kartik\nav\NavX;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
        $session = Yii::$app->session;
            NavBar::begin([
                //'brandLabel' => 'Processo Seletivo - Senac AM',
                'brandLabel' => '<img src="css/img/logo_senac_topo.png"/>',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            


if($session['sess_codunidade'] == 7 && $session['sess_coddepartamento'] == 82 ){  //TEM QUE SER DO GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO


echo NavX::widget([

'options' => ['class' => 'navbar-nav navbar-right'],
                
    'items' => [
        ['label' => 'Administração', 'items' => [

            ['label' => 'Controle - Contração', 'items' => [
            '<li class="dropdown-header">Controle - Contração</li>',
                ['label' => 'Contratações Pendentes', 'url' => ['/contratacao/contratacao-pendente/index']],
                ['label' => 'Contratações Em Andamento', 'url' => ['/contratacao/contratacao-em-andamento/index']],
                ['label' => 'Contratações Encerradas', 'url' => ['/contratacao/contratacao-encerrada/index']],
            ]],

            '<li class="divider"></li>',
            ['label' => 'Processos Seletivos', 'items' => [
            '<li class="dropdown-header">Administração do site</li>',
                ['label' => 'Processos Seletivos', 'url' => ['/contratacao/processo-seletivo/index']],
                ['label' => 'Listagem de Candidatos', 'url' => ['/curriculos-admin/index']],
            ]],


            '<li class="divider"></li>',
            ['label' => 'Configuração', 'items' => [
            '<li class="dropdown-header">Cadastros</li>',
                ['label' => 'Cargos', 'url' => ['/contratacao/cargos/index']],
                ['label' => 'Sistemas', 'url' => ['/contratacao/sistemas/index']],

            ]],
        ]],
        ['label' => 'Solicitação de Contratação', 'url' => ['/contratacao/contratacao/contratacao/index']],

        ['label' => 'Sair', 'url' => 'http://portalsenac.am.senac.br/portal_senac/control_base_vermodulos/control_base_vermodulos.php'],

    ]
]); 

}else
//OUTROS USUÁRIOS

echo NavX::widget([

'options' => ['class' => 'navbar-nav navbar-right'],
                
    'items' => [
        ['label' => 'Solicitação de Contratação', 'url' => ['/contratacao/contratacao/index']],
        
        ['label' => 'Sair', 'url' => 'http://portalsenac.am.senac.br/portal_senac/control_base_vermodulos/control_base_vermodulos.php'],

    ]
]); 


NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; Gerência de Informática Corporativa <?= date('Y') ?></p>
            <p class="pull-right">Versão 1.1</p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
