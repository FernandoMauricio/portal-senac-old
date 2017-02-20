<?php

/* @var $this yii\web\View */

$this->title = 'Auxílio ao Planejamento';
$session = Yii::$app->session;
$nome_user    = $session['sess_nomeusuario'];
?>

<div class="site-index">
        <h1 class="text-center"> Auxílio ao Planejamento</h1>
            <div class="body-content">
                <div class="container">
                            <h3>Bem vindo(a), <?php echo $nome_user = utf8_encode(ucwords(strtolower($nome_user)))?>!</h3>
                </div>
            </div>
            <div class="panel panel-primary">
            <div class="panel-heading">
                        <i class="glyphicon glyphicon-star-empty"></i> Resumo do Módulo - Versão 1.0 - Publicado em 15/12/2016
            </div>

                <div class="panel-body">
              <h4><strong style="color: #337ab7;">Implementações</strong></h4>
                        <h5><i class="glyphicon glyphicon-tag"></i><strong> Cadastros</strong></h5>
                            <h5>- Cadastro de Materiais Didáticos </h5>
                            <h5>- Cadastro de Planos </h5>
                            <h5>- Cadastro de Planilhas de Curso (cadastro realizado pelo gerente imediato da unidade) </h5>
                            <h5>- Cadastro de Planilhas de Precificação </h5><br>

                            <h5><i class="glyphicon glyphicon-tag"></i><strong> Modelo A</strong></h5>
                            <h5>- Geração do Modelo A</h5>
                            <h5>- Atualização e Impressão do Modelo A</h5><br>

                            <h5><i class="glyphicon glyphicon-tag"></i><strong> Solicitações de Cópias</strong></h5>
                            <h5>- Solicitação e Acompanhamento de Cópias de Material (Apostilas)</h5><br>

                            <h5><i class="glyphicon glyphicon-tag"></i><strong> Relatórios</strong></h5>
                            <h5>- Visualizar Relatórios (Relatórios PAAR, MODELO B e Relatório Geral)</h5>
                </div>
            </div>

</div>
