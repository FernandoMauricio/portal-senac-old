<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use kartik\nav\NavX;

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
        'brandLabel' => '<img src="css/img/logo_senac_topo.png"/>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

if($session['sess_codunidade'] == 12 && $session['sess_coddepartamento'] == 16 ){  //TEM QUE SER DO GMT E DO DEPARTAMENTO SEDE ADMINISTRATIVA - GMT

   echo NavX::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],

                'items' => [

                    ['label' => 'Administração', 'items' => [

                ['label' => 'Solicitações de Transporte', 'items' => [
                '<li class="dropdown-header">Controle de Solicitações</li>',
                    ['label' => 'Atendimento das Solicitações', 'url' => ['transporte-admin/index']],
                    ['label' => 'Acompanhamento das Solicitações', 'url' => ['transporte-admin-acompanhamento/index']],
                ]],

                ['label' => 'Solicitações de Manutenção', 'items' => [
                '<li class="dropdown-header">Controle de Solicitações</li>',
                    ['label' => 'Atendimento das Solicitações', 'url' => ['manutencao-admin/index']],
                    ['label' => 'Acompanhamento das Solicitações', 'url' => ['manutencao-admin-acompanhamento/index']],
                ]],


                '<li class="divider"></li>',
                ['label' => 'Configuração', 'items' => [
                '<li class="dropdown-header">Cadastros</li>',
                    ['label' => 'Motoristas', 'url' => ['motorista/index']],

                ]],
            ]],

                    ['label' => 'Solicitações',
                'items' => [
                 '<li class="dropdown-header">Novas Solicitações</li>',
                 ['label' => 'Solicitação de Transporte', 'url' => ['transporte/index']],
                 ['label' => 'Solicitação de Manutenção', 'url' => ['manutencao/index']],
                           ],            
                    ],


            ['label' => 'Sair', 'url' => 'http://portalsenac.am.senac.br/portal_senac/control_base_vermodulos/control_base_vermodulos.php'],

                ],
            ]);
   }else //OUTROS USUÁRIOS

    echo NavX::widget([

                'options' => ['class' => 'navbar-nav navbar-right'],

                'items' => [

                    ['label' => 'Solicitações',
                'items' => [
                 '<li class="dropdown-header">Novas Solicitações</li>',
                 ['label' => 'Solicitação de Transporte', 'url' => ['transporte/index']],
                 ['label' => 'Solicitação de Manutenção', 'url' => ['manutencao/index']],
                           ],            
                    ],


            ['label' => 'Sair', 'url' => 'http://portalsenac.am.senac.br/portal_senac/control_base_vermodulos/control_base_vermodulos.php'],

                ],
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
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
