 <?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use kartik\nav\NavX;

?>
        <?php
            NavBar::begin([
                //'brandLabel' => 'Painel ADM - Site',
                'brandLabel' => '<img src="css/img/logo_senac_topo.png"/>',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Home', 'url' => ['/siteadmin/site/index']],
                    ['label' => 'Arquivos', 'url' => ['/siteadmin/ftp/index']],
                    ['label' => 'Cursos', 'url' => ['/siteadmin/cursos/index']],
                    ['label' => 'Banners', 'url' => ['/siteadmin/banners/index']],
                    ['label' => 'Vestibular', 'url' => ['/siteadmin/vestibular/index']],
                    ['label' => 'Abertura de Vagas - PSG', 'url' => ['/siteadmin/abertura/index']],
                    ['label' => 'Sair', 'url' => 'http://portalsenac.am.senac.br/portal_senac/control_base_vermodulos/control_base_vermodulos.php'],
                ],
            ]);
            NavBar::end();
        ?>