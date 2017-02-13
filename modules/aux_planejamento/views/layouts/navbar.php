<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use kartik\nav\NavX;

?>
    <?php

    $session = Yii::$app->session;

    NavBar::begin([
        'brandLabel' => '<img src="css/img/logo_senac_topo.png"/>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-inverse navbar-fixed-top'],
    ]);

    if($session['sess_codunidade'] == 51 && $session['sess_responsavelsetor'] == 1){ //ÁREA GERENTE DO GPO 

        echo NavX::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],

        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            [
            'label' => 'Cadastros',
            'items' => [
                        '<li class="dropdown-header">Área Administrador</li>',
                         ['label' => 'Ano', 'url' => ['/aux_planejamento/cadastros/ano/index']],
                         ['label' => 'Nivel', 'url' => ['/aux_planejamento/cadastros/nivel/index']],
                         ['label' => 'Eixo', 'url' => ['/aux_planejamento/cadastros/eixo/index']],
                         ['label' => 'Segmento', 'url' => ['/aux_planejamento/cadastros/segmento/index']],
                         ['label' => 'Tipos de Ação', 'url' => ['/aux_planejamento/cadastros/tipo/index']],
                          '<li class="divider"></li>',
                         ['label' => 'Centro de Custo', 'url' => ['/aux_planejamento/cadastros/centrocusto/index']],
                       ],
            ],

            [
            'label' => 'Repositório',
            'items' => [
                         ['label' => 'Materiais Didáticos', 'url' => ['/aux_planejamento/repositorio/repositorio-materiais/index']],
                                     '<li class="divider"></li>',
                            ['label' => 'Cadastros', 'items' => [
                                  ['label' => 'Categoria', 'url' => ['/aux_planejamento/repositorio/categoria/index']],
                                  ['label' => 'Editora', 'url' => ['/aux_planejamento/repositorio/editora/index']],
                                  // ['label' => 'Tipo de Material', 'url' => ['/repositorio/tipomaterial/index']],
                            ]],

                       ],
            ],

            [
            'label' => 'Plano de Ação',
            'items' => [
                         ['label' => 'Cadastro do Plano', 'url' => ['/aux_planejamento/planos/planodeacao/index']],
                                     '<li class="divider"></li>',
                            ['label' => 'Cadastros', 'items' => [
                                ['label' => 'Material do Aluno', 'url' => ['/aux_planejamento/cadastros/materialaluno/index']],
                                ['label' => 'Equipamentos / Utensílios', 'url' => ['/aux_planejamentocadastros/estruturafisica/index']],
                                '<li class="divider"></li>',
                                ['label' => 'Material de Consumo', 'url' => ['/aux_planejamento/cadastros/materialconsumo/index']],

                            ]],

                     ],
            ],

            [
            'label' => 'Solicitações de Cópias',
            'items' => [
                         ['label' => 'Nova Solicitação', 'url' => ['/aux_planejamento/solicitacoes/material-copias/index']],
                                     '<li class="divider"></li>',
                            ['label' => 'Administração', 'items' => [
                                ['label' => 'Solicitações em aprovação', 'url' => ['/aux_planejamento/solicitacoes/material-copias-aut-gerencia/index']],
                            ]],
                     ],
            ],

            [
            'label' => 'Planilhas',
            'items' => [
                         ['label' => 'Planilhas de Curso', 'url' => ['/aux_planejamento/planilhas/planilhadecurso/index']],
                                     '<li class="divider"></li>',

                         ['label' => 'Planilhas de Precificação', 'url' => ['/aux_planejamento/planilhas/precificacao/index']],
                                     '<li class="divider"></li>',
                            ['label' => 'Parâmetros', 'items' => [
                                ['label' => 'Salas', 'url' => ['/aux_planejamento/despesas/salas/index']],
                                ['label' => 'Valor Hora/Aula', 'url' => ['/aux_planejamento/despesas/despesasdocente/index']],
                                ['label' => 'Despesas da Unidade', 'url' => ['/aux_planejamento/despesas/custosunidade/index']],
                                ['label' => 'Markup', 'url' => ['/aux_planejamento/despesas/markup/batch-update']],

                            ]],
                                     '<li class="divider"></li>',
                            ['label' => 'Administração', 'items' => [
                                ['label' => 'Planilhas de Curso', 'url' => ['/aux_planejamento/planilhas/planilhadecurso-admin/index']],
                                ['label' => 'Planilhas Pendentes', 'url' => ['/aux_planejamento/planilhas/planilhadecurso-pendentes/index']],
                                ['label' => 'Planilhas Homologadas', 'url' => ['/aux_planejamento/planilhas/planilhadecurso-homologadas/index']],
                                ['label' => 'Entrada de Dados Modelo A', 'url' => ['/aux_planejamento/modeloa/modelo-a/configuracao-entrada-dados-modelo-a']],

                            ]],
                                     '<li class="divider"></li>',
                            ['label' => 'Modelo A', 'items' => [
                                ['label' => 'Listagem do Modelo A', 'url' => ['/aux_planejamento/modeloa/modelo-a/index']],

                            ]],
                     ],
            ],

            [
            'label' => 'Relatórios',
            'items' => [
                            ['label' => 'Relatórios', 'items' => [
                                ['label' => 'PAAR', 'url' => ['/aux_planejamento/relatorios/relatorios-paar/gerar-relatorio']],
                                ['label' => 'Relatório Geral', 'url' => ['/aux_planejamentorelatorios/relatorio-geral/gerar-relatorio']],
                                ['label' => 'Modelo B', 'url' => ['/aux_planejamento/relatorios/relatorio-modelo-b/gerar-relatorio']],
                                ['label' => 'Relatórios DEP', 'url' => ['/aux_planejamento/relatorios/relatorios-dep/gerar-relatorio']],
                            ]],
                     ],
            ],

            [
            'label' => 'Usuário (' . utf8_encode(ucwords(strtolower($session['sess_nomeusuario']))) . ')',
            'items' => [
                         '<li class="dropdown-header">Área Usuário</li>',
                                //['label' => 'Alterar Senha', 'url' => ['usuario-usu/update', 'id' => $sess_codusuario]],
                                //['label' => 'Versões Anteriores', 'url' => ['/site/versao']],
                                ['label' => 'Sair', 'url' => 'http://portalsenac.am.senac.br/portal_senac/control_base_vermodulos/control_base_vermodulos.php'],
                    
                        ],
            ],
        ],
    ]);

     }else if($session['sess_codunidade'] == 51) { //ÁREA USUÁRIOS DO GPO

        echo NavX::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],

             'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            [
            'label' => 'Cadastros',
            'items' => [
                        '<li class="dropdown-header">Área Administrador</li>',
                         ['label' => 'Ano', 'url' => ['/aux_planejamento/cadastros/ano/index']],
                         ['label' => 'Nivel', 'url' => ['/aux_planejamento/cadastros/nivel/index']],
                         ['label' => 'Eixo', 'url' => ['/aux_planejamento/cadastros/eixo/index']],
                         ['label' => 'Segmento', 'url' => ['/aux_planejamento/cadastros/segmento/index']],
                         ['label' => 'Tipos de Ação', 'url' => ['/aux_planejamento/cadastros/tipo/index']],
                          '<li class="divider"></li>',
                         ['label' => 'Centro de Custo', 'url' => ['/aux_planejamento/cadastros/centrocusto/index']],
                       ],
            ],

            // [
            // 'label' => 'Repositório',
            // 'items' => [
            //              ['label' => 'Materiais Didáticos', 'url' => ['/repositorio/repositorio-materiais/index']],
            //                          '<li class="divider"></li>',
            //                 ['label' => 'Cadastros', 'items' => [
            //                       ['label' => 'Categoria', 'url' => ['/repositorio/categoria/index']],
            //                       ['label' => 'Editora', 'url' => ['/repositorio/editora/index']],
            //                       // ['label' => 'Tipo de Material', 'url' => ['/repositorio/tipomaterial/index']],
            //                 ]],

            //            ],
            // ],

            [
            'label' => 'Plano de Ação',
            'items' => [
                         ['label' => 'Cadastro do Plano', 'url' => ['/aux_planejamento/planos/planodeacao/index']],
                                     '<li class="divider"></li>',
                            ['label' => 'Cadastros', 'items' => [
                                ['label' => 'Material do Aluno', 'url' => ['/aux_planejamento/cadastros/materialaluno/index']],
                                ['label' => 'Equipamentos / Utensílios', 'url' => ['/aux_planejamento/cadastros/estruturafisica/index']],
                                '<li class="divider"></li>',
                                ['label' => 'Material de Consumo', 'url' => ['/aux_planejamento/cadastros/materialconsumo/index']],

                            ]],

                     ],
            ],

            [
            'label' => 'Solicitações de Cópias',
            'items' => [
                         ['label' => 'Nova Solicitação', 'url' => ['/aux_planejamento/solicitacoes/material-copias/index']],
                     ],
            ],

            [
            'label' => 'Planilhas',
            'items' => [
                         ['label' => 'Planilhas de Curso', 'url' => ['/aux_planejamento/planilhas/planilhadecurso/index']],
                                     '<li class="divider"></li>',

                         ['label' => 'Planilhas de Precificação', 'url' => ['/aux_planejamento/planilhas/precificacao/index']],
                                     '<li class="divider"></li>',
                            ['label' => 'Parâmetros', 'items' => [
                                ['label' => 'Salas', 'url' => ['/aux_planejamento/despesas/salas/index']],
                                ['label' => 'Valor Hora/Aula', 'url' => ['/aux_planejamento/despesas/despesasdocente/index']],
                                ['label' => 'Despesas da Unidade', 'url' => ['/aux_planejamento/despesas/custosunidade/index']],
                                ['label' => 'Markup', 'url' => ['/aux_planejamento/despesas/markup/batch-update']],

                            ]],
                                     '<li class="divider"></li>',
                            ['label' => 'Administração', 'items' => [
                                ['label' => 'Planilhas de Curso', 'url' => ['/aux_planejamento/planilhas/planilhadecurso-admin/index']],
                                ['label' => 'Planilhas Pendentes', 'url' => ['/aux_planejamento/planilhas/planilhadecurso-pendentes/index']],
                                ['label' => 'Planilhas Homologadas', 'url' => ['/aux_planejamento/planilhas/planilhadecurso-homologadas/index']],
                                ['label' => 'Entrada de Dados Modelo A', 'url' => ['/aux_planejamento/modeloa/modelo-a/configuracao-entrada-dados-modelo-a']],

                            ]],
                                     '<li class="divider"></li>',
                            ['label' => 'Modelo A', 'items' => [
                                ['label' => 'Listagem do Modelo A', 'url' => ['/aux_planejamento/modeloa/modelo-a/index']],

                            ]],
                     ],
            ],

            [
            'label' => 'Relatórios',
            'items' => [
                            ['label' => 'Relatórios', 'items' => [
                                ['label' => 'PAAR', 'url' => ['/aux_planejamento/relatorios/relatorios-paar/gerar-relatorio']],
                                ['label' => 'Relatório Geral', 'url' => ['/aux_planejamento/relatorios/relatorio-geral/gerar-relatorio']],
                                ['label' => 'Modelo B', 'url' => ['/aux_planejamento/relatorios/relatorio-modelo-b/gerar-relatorio']],
                                ['label' => 'Relatórios DEP', 'url' => ['/aux_planejamento/relatorios/relatorios-dep/gerar-relatorio']],
                            ]],
                     ],
            ],

            [
            'label' => 'Usuário (' . utf8_encode(ucwords(strtolower($session['sess_nomeusuario']))) . ')',
            'items' => [
                         '<li class="dropdown-header">Área Usuário</li>',
                                //['label' => 'Alterar Senha', 'url' => ['usuario-usu/update', 'id' => $sess_codusuario]],
                                //['label' => 'Versões Anteriores', 'url' => ['/site/versao']],
                                ['label' => 'Sair', 'url' => 'http://portalsenac.am.senac.br/portal_senac/control_base_vermodulos/control_base_vermodulos.php'],
                    
                        ],
            ],
        ],
    ]);

    }else if($session['sess_codunidade'] == 11) { //ÁREA DA DEP

    echo NavX::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],

        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],

            [
            'label' => 'Repositório',
            'items' => [
                         ['label' => 'Materiais Didáticos', 'url' => ['/aux_planejamento/repositorio/repositorio-materiais/index']],
                                     '<li class="divider"></li>',
                            ['label' => 'Cadastros', 'items' => [
                                  ['label' => 'Categoria', 'url' => ['/aux_planejamento/repositorio/categoria/index']],
                                  ['label' => 'Editora', 'url' => ['/aux_planejamento/repositorio/editora/index']],
                                  // ['label' => 'Tipo de Material', 'url' => ['/repositorio/tipomaterial/index']],
                            ]],

                       ],
            ],

            [
            'label' => 'Plano de Ação',
            'items' => [
                         ['label' => 'Cadastro do Plano', 'url' => ['/aux_planejamento/planos/planodeacao/index']],
                                     '<li class="divider"></li>',
                            ['label' => 'Cadastros', 'items' => [
                                ['label' => 'Material do Aluno', 'url' => ['/aux_planejamento/cadastros/materialaluno/index']],
                                ['label' => 'Equipamentos / Utensílios', 'url' => ['/aux_planejamento/cadastros/estruturafisica/index']],
                                '<li class="divider"></li>',
                                ['label' => 'Material de Consumo', 'url' => ['/aux_planejamento/cadastros/materialconsumo/index']],

                            ]],

                     ],
            ],

            [
            'label' => 'Solicitações de Cópias',
            'items' => [
                         ['label' => 'Nova Solicitação', 'url' => ['/aux_planejamento/solicitacoes/material-copias/index']],
                                     '<li class="divider"></li>',
                            ['label' => 'Administração', 'items' => [
                                ['label' => 'Solicitações em aprovação', 'url' => ['/aux_planejamento/solicitacoes/material-copias-aut-gerencia/index']],
                                     '<li class="divider"></li>',
                                ['label' => 'Solicitações Pendentes', 'url' => ['/aux_planejamento/solicitacoes/material-copias-pendentes/index']],
                                ['label' => 'Solicitações Encerradas', 'url' => ['/aux_planejamento/solicitacoes/material-copias-encerradas/index']],
                            ]],
                            ['label' => 'Cadastros', 'items' => [
                                ['label' => 'Tipos de Acabamento', 'url' => ['/aux_planejamento/solicitacoes/acabamento/index']],

                            ]],


                     ],
            ],

            [
            'label' => 'Relatórios',
            'items' => [
                            ['label' => 'Relatórios', 'items' => [
                                ['label' => 'PAAR', 'url' => ['/aux_planejamento/relatorios/relatorios-paar/gerar-relatorio']],
                                ['label' => 'Relatório Geral', 'url' => ['/aux_planejamento/relatorios/relatorio-geral/gerar-relatorio']],
                                ['label' => 'Modelo B', 'url' => ['/aux_planejamento/relatorios/relatorio-modelo-b/gerar-relatorio']],
                                ['label' => 'Relatórios DEP', 'url' => ['/aux_planejamento/relatorios/relatorios-dep/gerar-relatorio']],
                            ]],
                     ],
            ],

            [
            'label' => 'Usuário (' . utf8_encode(ucwords(strtolower($session['sess_nomeusuario']))) . ')',
            'items' => [
                         '<li class="dropdown-header">Área Usuário</li>',
                                ['label' => 'Sair', 'url' => 'http://portalsenac.am.senac.br/portal_senac/control_base_vermodulos/control_base_vermodulos.php'],
                    
                        ],
            ],
        ],
    ]);

    }else if($session['sess_responsavelsetor'] == 1 || $session['sess_codusuario'] == 48 || $session['sess_codusuario'] == 74) {//ÁREA DE GERENTES E PARA A SAIANA E ELENI PODER ENTRAR EM CADA UNIDADE E VISUALIZAR COMO GERENTE

    echo NavX::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],

        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],

            [
            'label' => 'Plano de Ação',
            'items' => [
                         ['label' => 'Cadastro do Plano', 'url' => ['/aux_planejamento/planos/planodeacao/index']],
                     ],
            ],

            [
            'label' => 'Solicitações de Cópias',
            'items' => [
                         ['label' => 'Nova Solicitação', 'url' => ['/aux_planejamento/solicitacoes/material-copias/index']],
                                     '<li class="divider"></li>',
                            ['label' => 'Administração', 'items' => [
                                ['label' => 'Solicitações em aprovação', 'url' => ['/aux_planejamento/solicitacoes/material-copias-aut-gerencia/index']],
                            ]],
                     ],
            ],

            [
            'label' => 'Planilhas',
            'items' => [
                         ['label' => 'Planilhas de Curso', 'url' => ['/aux_planejamento/planilhas/planilhadecurso/index']],
                                     '<li class="divider"></li>',

                         ['label' => 'Planilhas de Precificação', 'url' => ['/aux_planejamento/planilhas/precificacao/index']],
                                     '<li class="divider"></li>',
                            ['label' => 'Modelo A', 'items' => [
                                ['label' => 'Listagem do Modelo A', 'url' => ['/aux_planejamento/modeloa/modelo-a/index']],

                            ]],
                     ],
            ],

            [
            'label' => 'Relatórios',
            'items' => [
                            ['label' => 'Relatórios', 'items' => [
                                ['label' => 'PAAR', 'url' => ['/aux_planejamento/relatorios/relatorios-paar/gerar-relatorio']],
                                ['label' => 'Relatório Geral', 'url' => ['/aux_planejamento/relatorios/relatorio-geral/gerar-relatorio']],
                                ['label' => 'Modelo B', 'url' => ['/aux_planejamento/relatorios/relatorio-modelo-b/gerar-relatorio']],
                                ['label' => 'Relatórios DEP', 'url' => ['/aux_planejamento/relatorios/relatorios-dep/gerar-relatorio']],
                            ]],
                     ],
            ],

            [
            'label' => 'Usuário (' . utf8_encode(ucwords(strtolower($session['sess_nomeusuario']))) . ')',
            'items' => [
                         '<li class="dropdown-header">Área Usuário</li>',
                                //['label' => 'Alterar Senha', 'url' => ['usuario-usu/update', 'id' => $sess_codusuario]],
                                //['label' => 'Versões Anteriores', 'url' => ['/site/versao']],
                                ['label' => 'Sair', 'url' => 'http://portalsenac.am.senac.br/portal_senac/control_base_vermodulos/control_base_vermodulos.php'],
                    
                        ],
            ],
        ],
    ]);

    }else if($session['sess_codunidade'] == 12) {//ÁREA DA REPROGRAFIA - GMT

    echo NavX::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],

        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],

            [
            'label' => 'Solicitações de Cópias',
            'items' => [
                         ['label' => 'Nova Solicitação', 'url' => ['/aux_planejamento/solicitacoes/material-copias/index']],
                                     '<li class="divider"></li>',
                            ['label' => 'Administração', 'items' => [
                                ['label' => 'Solicitações Aprovadas', 'url' => ['/aux_planejamento/solicitacoes/material-copias-aprovadas/index']],
                                ['label' => 'Solicitações Encerradas', 'url' => ['/aux_planejamento/solicitacoes/material-copias-encerradas/index']],
                            ]],
                     ],
            ],

            [
            'label' => 'Usuário (' . utf8_encode(ucwords(strtolower($session['sess_nomeusuario']))) . ')',
            'items' => [
                         '<li class="dropdown-header">Área Usuário</li>',
                                //['label' => 'Alterar Senha', 'url' => ['usuario-usu/update', 'id' => $sess_codusuario]],
                                //['label' => 'Versões Anteriores', 'url' => ['/site/versao']],
                                ['label' => 'Sair', 'url' => 'http://portalsenac.am.senac.br/portal_senac/control_base_vermodulos/control_base_vermodulos.php'],
                    
                        ],
            ],
        ],
    ]);

    }else {//ÁREA DE USUÁRIOS

    echo NavX::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],

        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],

            [
            'label' => 'Plano de Ação',
            'items' => [
                         ['label' => 'Cadastro do Plano', 'url' => ['/aux_planejamento/planos/planodeacao/index']],
                     ],
            ],

            [
            'label' => 'Solicitações de Cópias',
            'items' => [
                         ['label' => 'Nova Solicitação', 'url' => ['/aux_planejamento/solicitacoes/material-copias/index']],
                     ],
            ],

            [
            'label' => 'Relatórios',
            'items' => [
                            ['label' => 'Relatórios', 'items' => [
                                ['label' => 'PAAR', 'url' => ['/aux_planejamento/relatorios/relatorios-paar/gerar-relatorio']],
                                ['label' => 'Relatório Geral', 'url' => ['/aux_planejamento/relatorios/relatorio-geral/gerar-relatorio']],
                                ['label' => 'Modelo B', 'url' => ['/aux_planejamento/relatorios/relatorio-modelo-b/gerar-relatorio']],
                                ['label' => 'Relatórios DEP', 'url' => ['/aux_planejamento/relatorios/relatorios-dep/gerar-relatorio']],
                            ]],
                     ],
            ],
               
            [
            'label' => 'Usuário (' . utf8_encode(ucwords(strtolower($session['sess_nomeusuario']))) . ')',
            'items' => [
                         '<li class="dropdown-header">Área Usuário</li>',
                                //['label' => 'Alterar Senha', 'url' => ['usuario-usu/update', 'id' => $sess_codusuario]],
                                //['label' => 'Versões Anteriores', 'url' => ['/site/versao']],
                                ['label' => 'Sair', 'url' => 'http://portalsenac.am.senac.br/portal_senac/control_base_vermodulos/control_base_vermodulos.php'],
                    
                        ],
            ],
        ],
    ]);

}
    NavBar::end();
    ?>