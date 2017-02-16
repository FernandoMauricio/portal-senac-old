<?php

namespace app\modules\contratacao\controllers;

use Yii;
use app\modules\contratacao\models\Contratacao;
use app\modules\contratacao\models\ContratacaoJustificativas;
use app\modules\contratacao\models\ContratacaoEmAndamentoSearch;
use app\modules\contratacao\models\Emailusuario;
use app\modules\contratacao\models\EmailusuarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

use mPDF;
/**
 * ContratacaoEmAndamentoController implements the CRUD actions for Contratacao model.
 */
class ContratacaoEmAndamentoController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }


    public function actionImprimir($id) {

            $pdf = new Pdf([
                'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
                'content' => $this->renderPartial('imprimir'),
                'options' => [
                    'title' => 'Recrutamento e Seleção - Senac AM',
                    //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
                ],
                'methods' => [
                    'SetHeader' => ['SOLICITAÇÃO DE CONTRATAÇÃO - SENAC AM||Gerado em: ' . date("d/m/Y - H:i:s")],
                    'SetFooter' => ['Recrutamento e Seleção - GRH||Página {PAGENO}'],
                ]
            ]);

        return $pdf->render('imprimir', [
            'model' => $this->findModel($id),

        ]);
        }
        
    /**
     * Lists all Contratacao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;
        if (!isset($session['sess_codusuario']) && !isset($session['sess_codcolaborador']) && !isset($session['sess_codunidade']) && !isset($session['sess_nomeusuario']) && !isset($session['sess_coddepartamento']) && !isset($session['sess_codcargo']) && !isset($session['sess_cargo']) && !isset($session['sess_setor']) && !isset($session['sess_unidade']) && !isset($session['sess_responsavelsetor'])) 
        {
           return $this->redirect('http://portalsenac.am.senac.br');
        }
    
    //VERIFICA SE O COLABORADOR FAZ PARTE DO SETOR GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO
    if($session['sess_codunidade'] != 7 || $session['sess_coddepartamento'] != 82){

        $this->layout = 'main-acesso-negado';
        return $this->render('/site/acesso_negado');

    }else

        $searchModel = new ContratacaoEmAndamentoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (Yii::$app->request->post('hasEditable')) {

        // instantiate your ComunicacaointernaAut model for saving
        $contratacaoEmAndamento = Yii::$app->request->post('editableKey');
        $model = Contratacao::findOne($contratacaoEmAndamento);
 
        $post = [];
        $posted = current($_POST['Contratacao']);
        $post['Contratacao'] = $posted;
 
        // load model like any single model validation
        if ($model->load($post)) {
            // similarly you can check if the name attribute was posted as well
             if($posted['situacao_id'] == 7) // PEDIDO RECEBIDO
              {
                $connection = Yii::$app->db;
                $command = $connection->createCommand(
                 "UPDATE `db_processos`.`contratacao` SET `situacao_id` = '7' WHERE `contratacao`.`id` =" . $_POST['editableKey']);
                $command->execute();

         //ENVIANDO EMAIL PARA O GERENTE INFORMANDO SOBRE O PROCESSO
          $sql_email = "SELECT emus_email FROM emailusuario_emus, colaborador_col, responsavelambiente_ream WHERE ream_codunidade = '".$model->cod_unidade_solic."' AND ream_codcolaborador = col_codcolaborador AND col_codusuario = emus_codusuario";
      
      $email_solicitacao = Emailusuario::findBySql($sql_email)->all(); 
      foreach ($email_solicitacao as $email)
          {
            $email_gerente  = $email["emus_email"];

                            Yii::$app->mailer->compose()
                            ->setFrom(['contratacao@am.senac.br' => 'Contratação - Senac AM'])
                            ->setTo($email_gerente)
                            ->setSubject('Solicitação de Contratação '.$model->id.' - ' . $model->situacao->descricao)
                            ->setTextBody('A solicitação de contratação de código: '.$model->id.' está com status de '.$model->situacao->descricao.' ')
                            ->setHtmlBody('<h4>Prezado(a) Gerente, <br><br>Existe uma solicitação de contratação de <strong style="color: #337ab7"">código: '.$model->id.'</strong> com status de '.$model->situacao->descricao.'. <br> Por favor, não responda esse e-mail. Acesse http://portalsenac.am.senac.br para ANALISAR a solicitação de contratação. <br><br> Atenciosamente, <br> Contratação de Pessoal - Senac AM.</h4>')
                            ->send();
                        } 

                Yii::$app->getSession()->setFlash('info', [
                         'type' => 'info',
                         'duration' => 5000,
                         'icon' => 'glyphicon glyphicon-ok',
                         'message' => 'A solicitação de Contratação foi alterada para ' .$model->situacao->descricao,
                         'title' => 'Solicitação de Contratação',
                         'positonY' => 'top',
                         'positonX' => 'right'
                     ]);


             }elseif($posted['situacao_id'] == 8) // AGUARDANDO AUTORIZAÇÃO DE CUSTO
              {
                $connection = Yii::$app->db;
                $command = $connection->createCommand(
                 "UPDATE `db_processos`.`contratacao` SET `situacao_id` = '8' WHERE `contratacao`.`id` =" . $_POST['editableKey']);
                $command->execute();

         //ENVIANDO EMAIL PARA O GERENTE INFORMANDO SOBRE O PROCESSO
          $sql_email = "SELECT emus_email FROM emailusuario_emus, colaborador_col, responsavelambiente_ream WHERE ream_codunidade = '".$model->cod_unidade_solic."' AND ream_codcolaborador = col_codcolaborador AND col_codusuario = emus_codusuario";
      
      $email_solicitacao = Emailusuario::findBySql($sql_email)->all(); 
      foreach ($email_solicitacao as $email)
          {
            $email_gerente  = $email["emus_email"];

                            Yii::$app->mailer->compose()
                            ->setFrom(['contratacao@am.senac.br' => 'Contratação - Senac AM'])
                            ->setTo($email_gerente)
                            ->setSubject('Solicitação de Contratação '.$model->id.' - ' . $model->situacao->descricao)
                            ->setTextBody('A solicitação de contratação de código: '.$model->id.' está com status de '.$model->situacao->descricao.' ')
                            ->setHtmlBody('<h4>Prezado(a) Gerente, <br><br>Existe uma solicitação de contratação de <strong style="color: #337ab7"">código: '.$model->id.'</strong> com status de '.$model->situacao->descricao.'. <br> Por favor, não responda esse e-mail. Acesse http://portalsenac.am.senac.br para ANALISAR a solicitação de contratação. <br><br> Atenciosamente, <br> Contratação de Pessoal - Senac AM.</h4>')
                            ->send();
                        } 

                Yii::$app->getSession()->setFlash('info', [
                         'type' => 'info',
                         'duration' => 5000,
                         'icon' => 'glyphicon glyphicon-ok',
                         'message' => 'A solicitação de Contratação foi alterada para ' .$model->situacao->descricao,
                         'title' => 'Solicitação de Contratação',
                         'positonY' => 'top',
                         'positonX' => 'right'
                     ]);
            
             }elseif($posted['situacao_id'] == 9) // ELABORAÇÃO DE EDITAL
              {
                $connection = Yii::$app->db;
                $command = $connection->createCommand(
                 "UPDATE `db_processos`.`contratacao` SET `situacao_id` = '9' WHERE `contratacao`.`id` =" . $_POST['editableKey']);
                $command->execute();

         //ENVIANDO EMAIL PARA O GERENTE INFORMANDO SOBRE O PROCESSO
          $sql_email = "SELECT emus_email FROM emailusuario_emus, colaborador_col, responsavelambiente_ream WHERE ream_codunidade = '".$model->cod_unidade_solic."' AND ream_codcolaborador = col_codcolaborador AND col_codusuario = emus_codusuario";
      
      $email_solicitacao = Emailusuario::findBySql($sql_email)->all(); 
      foreach ($email_solicitacao as $email)
          {
            $email_gerente  = $email["emus_email"];

                            Yii::$app->mailer->compose()
                            ->setFrom(['contratacao@am.senac.br' => 'Contratação - Senac AM'])
                            ->setTo($email_gerente)
                            ->setSubject('Solicitação de Contratação '.$model->id.' - ' . $model->situacao->descricao)
                            ->setTextBody('A solicitação de contratação de código: '.$model->id.' está com status de '.$model->situacao->descricao.' ')
                            ->setHtmlBody('<h4>Prezado(a) Gerente, <br><br>Existe uma solicitação de contratação de <strong style="color: #337ab7"">código: '.$model->id.'</strong> com status de '.$model->situacao->descricao.'. <br> Por favor, não responda esse e-mail. Acesse http://portalsenac.am.senac.br para ANALISAR a solicitação de contratação. <br><br> Atenciosamente, <br> Contratação de Pessoal - Senac AM.</h4>')
                            ->send();
                        } 

                Yii::$app->getSession()->setFlash('info', [
                         'type' => 'info',
                         'duration' => 5000,
                         'icon' => 'glyphicon glyphicon-ok',
                         'message' => 'A solicitação de Contratação foi alterada para ' .$model->situacao->descricao,
                         'title' => 'Solicitação de Contratação',
                         'positonY' => 'top',
                         'positonX' => 'right'
                     ]);

             }elseif($posted['situacao_id'] == 10) // PERÍODO DE INSCRIÇÃO
              {
                $connection = Yii::$app->db;
                $command = $connection->createCommand(
                 "UPDATE `db_processos`.`contratacao` SET `situacao_id` = '10' WHERE `contratacao`.`id` =" . $_POST['editableKey']);
                $command->execute();

         //ENVIANDO EMAIL PARA O GERENTE INFORMANDO SOBRE O PROCESSO
          $sql_email = "SELECT emus_email FROM emailusuario_emus, colaborador_col, responsavelambiente_ream WHERE ream_codunidade = '".$model->cod_unidade_solic."' AND ream_codcolaborador = col_codcolaborador AND col_codusuario = emus_codusuario";
      
      $email_solicitacao = Emailusuario::findBySql($sql_email)->all(); 
      foreach ($email_solicitacao as $email)
          {
            $email_gerente  = $email["emus_email"];

                            Yii::$app->mailer->compose()
                            ->setFrom(['contratacao@am.senac.br' => 'Contratação - Senac AM'])
                            ->setTo($email_gerente)
                            ->setSubject('Solicitação de Contratação '.$model->id.' - ' . $model->situacao->descricao)
                            ->setTextBody('A solicitação de contratação de código: '.$model->id.' está com status de '.$model->situacao->descricao.' ')
                            ->setHtmlBody('<h4>Prezado(a) Gerente, <br><br>Existe uma solicitação de contratação de <strong style="color: #337ab7"">código: '.$model->id.'</strong> com status de '.$model->situacao->descricao.'. <br> Por favor, não responda esse e-mail. Acesse http://portalsenac.am.senac.br para ANALISAR a solicitação de contratação. <br><br> Atenciosamente, <br> Contratação de Pessoal - Senac AM.</h4>')
                            ->send();
                        } 

                Yii::$app->getSession()->setFlash('info', [
                         'type' => 'info',
                         'duration' => 5000,
                         'icon' => 'glyphicon glyphicon-ok',
                         'message' => 'A solicitação de Contratação foi alterada para ' .$model->situacao->descricao,
                         'title' => 'Solicitação de Contratação',
                         'positonY' => 'top',
                         'positonX' => 'right'
                     ]);

            }elseif($posted['situacao_id'] == 11) // ANÁLISE DE CURRICULO
              {
                $connection = Yii::$app->db;
                $command = $connection->createCommand(
                 "UPDATE `db_processos`.`contratacao` SET `situacao_id` = '11' WHERE `contratacao`.`id` =" . $_POST['editableKey']);
                $command->execute();

         //ENVIANDO EMAIL PARA O GERENTE INFORMANDO SOBRE O PROCESSO
          $sql_email = "SELECT emus_email FROM emailusuario_emus, colaborador_col, responsavelambiente_ream WHERE ream_codunidade = '".$model->cod_unidade_solic."' AND ream_codcolaborador = col_codcolaborador AND col_codusuario = emus_codusuario";
      
      $email_solicitacao = Emailusuario::findBySql($sql_email)->all(); 
      foreach ($email_solicitacao as $email)
          {
            $email_gerente  = $email["emus_email"];

                            Yii::$app->mailer->compose()
                            ->setFrom(['contratacao@am.senac.br' => 'Contratação - Senac AM'])
                            ->setTo($email_gerente)
                            ->setSubject('Solicitação de Contratação '.$model->id.' - ' . $model->situacao->descricao)
                            ->setTextBody('A solicitação de contratação de código: '.$model->id.' está com status de '.$model->situacao->descricao.' ')
                            ->setHtmlBody('<h4>Prezado(a) Gerente, <br><br>Existe uma solicitação de contratação de <strong style="color: #337ab7"">código: '.$model->id.'</strong> com status de '.$model->situacao->descricao.'. <br> Por favor, não responda esse e-mail. Acesse http://portalsenac.am.senac.br para ANALISAR a solicitação de contratação. <br><br> Atenciosamente, <br> Contratação de Pessoal - Senac AM.</h4>')
                            ->send();
                        } 

                Yii::$app->getSession()->setFlash('info', [
                         'type' => 'info',
                         'duration' => 5000,
                         'icon' => 'glyphicon glyphicon-ok',
                         'message' => 'A solicitação de Contratação foi alterada para ' .$model->situacao->descricao,
                         'title' => 'Solicitação de Contratação',
                         'positonY' => 'top',
                         'positonX' => 'right'
                     ]);

            }elseif($posted['situacao_id'] == 12) // AVALIAÇÃO ESCRITA
              {
                $connection = Yii::$app->db;
                $command = $connection->createCommand(
                 "UPDATE `db_processos`.`contratacao` SET `situacao_id` = '12' WHERE `contratacao`.`id` =" . $_POST['editableKey']);
                $command->execute();

         //ENVIANDO EMAIL PARA O GERENTE INFORMANDO SOBRE O PROCESSO
          $sql_email = "SELECT emus_email FROM emailusuario_emus, colaborador_col, responsavelambiente_ream WHERE ream_codunidade = '".$model->cod_unidade_solic."' AND ream_codcolaborador = col_codcolaborador AND col_codusuario = emus_codusuario";
      
      $email_solicitacao = Emailusuario::findBySql($sql_email)->all(); 
      foreach ($email_solicitacao as $email)
          {
            $email_gerente  = $email["emus_email"];

                            Yii::$app->mailer->compose()
                            ->setFrom(['contratacao@am.senac.br' => 'Contratação - Senac AM'])
                            ->setTo($email_gerente)
                            ->setSubject('Solicitação de Contratação '.$model->id.' - ' . $model->situacao->descricao)
                            ->setTextBody('A solicitação de contratação de código: '.$model->id.' está com status de '.$model->situacao->descricao.' ')
                            ->setHtmlBody('<h4>Prezado(a) Gerente, <br><br>Existe uma solicitação de contratação de <strong style="color: #337ab7"">código: '.$model->id.'</strong> com status de '.$model->situacao->descricao.'. <br> Por favor, não responda esse e-mail. Acesse http://portalsenac.am.senac.br para ANALISAR a solicitação de contratação. <br><br> Atenciosamente, <br> Contratação de Pessoal - Senac AM.</h4>')
                            ->send();
                        } 

                Yii::$app->getSession()->setFlash('info', [
                         'type' => 'info',
                         'duration' => 5000,
                         'icon' => 'glyphicon glyphicon-ok',
                         'message' => 'A solicitação de Contratação foi alterada para ' .$model->situacao->descricao,
                         'title' => 'Solicitação de Contratação',
                         'positonY' => 'top',
                         'positonX' => 'right'
                     ]);

            }elseif($posted['situacao_id'] == 13) // AVALIAÇÃO COMPORTAMENTAL
              {
                $connection = Yii::$app->db;
                $command = $connection->createCommand(
                 "UPDATE `db_processos`.`contratacao` SET `situacao_id` = '13' WHERE `contratacao`.`id` =" . $_POST['editableKey']);
                $command->execute();

         //ENVIANDO EMAIL PARA O GERENTE INFORMANDO SOBRE O PROCESSO
          $sql_email = "SELECT emus_email FROM emailusuario_emus, colaborador_col, responsavelambiente_ream WHERE ream_codunidade = '".$model->cod_unidade_solic."' AND ream_codcolaborador = col_codcolaborador AND col_codusuario = emus_codusuario";
      
      $email_solicitacao = Emailusuario::findBySql($sql_email)->all(); 
      foreach ($email_solicitacao as $email)
          {
            $email_gerente  = $email["emus_email"];

                            Yii::$app->mailer->compose()
                            ->setFrom(['contratacao@am.senac.br' => 'Contratação - Senac AM'])
                            ->setTo($email_gerente)
                            ->setSubject('Solicitação de Contratação '.$model->id.' - ' . $model->situacao->descricao)
                            ->setTextBody('A solicitação de contratação de código: '.$model->id.' está com status de '.$model->situacao->descricao.' ')
                            ->setHtmlBody('<h4>Prezado(a) Gerente, <br><br>Existe uma solicitação de contratação de <strong style="color: #337ab7"">código: '.$model->id.'</strong> com status de '.$model->situacao->descricao.'. <br> Por favor, não responda esse e-mail. Acesse http://portalsenac.am.senac.br para ANALISAR a solicitação de contratação. <br><br> Atenciosamente, <br> Contratação de Pessoal - Senac AM.</h4>')
                            ->send();
                        } 

                Yii::$app->getSession()->setFlash('info', [
                         'type' => 'info',
                         'duration' => 5000,
                         'icon' => 'glyphicon glyphicon-ok',
                         'message' => 'A solicitação de Contratação foi alterada para ' .$model->situacao->descricao,
                         'title' => 'Solicitação de Contratação',
                         'positonY' => 'top',
                         'positonX' => 'right'
                     ]);

            }elseif($posted['situacao_id'] == 14) // AVALIAÇÃO DIDÁTICA
              {
                $connection = Yii::$app->db;
                $command = $connection->createCommand(
                 "UPDATE `db_processos`.`contratacao` SET `situacao_id` = '14' WHERE `contratacao`.`id` =" . $_POST['editableKey']);
                $command->execute();

         //ENVIANDO EMAIL PARA O GERENTE INFORMANDO SOBRE O PROCESSO
          $sql_email = "SELECT emus_email FROM emailusuario_emus, colaborador_col, responsavelambiente_ream WHERE ream_codunidade = '".$model->cod_unidade_solic."' AND ream_codcolaborador = col_codcolaborador AND col_codusuario = emus_codusuario";
      
      $email_solicitacao = Emailusuario::findBySql($sql_email)->all(); 
      foreach ($email_solicitacao as $email)
          {
            $email_gerente  = $email["emus_email"];

                            Yii::$app->mailer->compose()
                            ->setFrom(['contratacao@am.senac.br' => 'Contratação - Senac AM'])
                            ->setTo($email_gerente)
                            ->setSubject('Solicitação de Contratação '.$model->id.' - ' . $model->situacao->descricao)
                            ->setTextBody('A solicitação de contratação de código: '.$model->id.' está com status de '.$model->situacao->descricao.' ')
                            ->setHtmlBody('<h4>Prezado(a) Gerente, <br><br>Existe uma solicitação de contratação de <strong style="color: #337ab7"">código: '.$model->id.'</strong> com status de '.$model->situacao->descricao.'. <br> Por favor, não responda esse e-mail. Acesse http://portalsenac.am.senac.br para ANALISAR a solicitação de contratação. <br><br> Atenciosamente, <br> Contratação de Pessoal - Senac AM.</h4>')
                            ->send();
                        } 

                Yii::$app->getSession()->setFlash('info', [
                         'type' => 'info',
                         'duration' => 5000,
                         'icon' => 'glyphicon glyphicon-ok',
                         'message' => 'A solicitação de Contratação foi alterada para ' .$model->situacao->descricao,
                         'title' => 'Solicitação de Contratação',
                         'positonY' => 'top',
                         'positonX' => 'right'
                     ]);

            }elseif($posted['situacao_id'] == 15) // ENTREVISTA
              {
                $connection = Yii::$app->db;
                $command = $connection->createCommand(
                 "UPDATE `db_processos`.`contratacao` SET `situacao_id` = '15' WHERE `contratacao`.`id` =" . $_POST['editableKey']);
                $command->execute();

         //ENVIANDO EMAIL PARA O GERENTE INFORMANDO SOBRE O PROCESSO
          $sql_email = "SELECT emus_email FROM emailusuario_emus, colaborador_col, responsavelambiente_ream WHERE ream_codunidade = '".$model->cod_unidade_solic."' AND ream_codcolaborador = col_codcolaborador AND col_codusuario = emus_codusuario";
      
      $email_solicitacao = Emailusuario::findBySql($sql_email)->all(); 
      foreach ($email_solicitacao as $email)
          {
            $email_gerente  = $email["emus_email"];

                            Yii::$app->mailer->compose()
                            ->setFrom(['contratacao@am.senac.br' => 'Contratação - Senac AM'])
                            ->setTo($email_gerente)
                            ->setSubject('Solicitação de Contratação '.$model->id.' - ' . $model->situacao->descricao)
                            ->setTextBody('A solicitação de contratação de código: '.$model->id.' está com status de '.$model->situacao->descricao.' ')
                            ->setHtmlBody('<h4>Prezado(a) Gerente, <br><br>Existe uma solicitação de contratação de <strong style="color: #337ab7"">código: '.$model->id.'</strong> com status de '.$model->situacao->descricao.'. <br> Por favor, não responda esse e-mail. Acesse http://portalsenac.am.senac.br para ANALISAR a solicitação de contratação. <br><br> Atenciosamente, <br> Contratação de Pessoal - Senac AM.</h4>')
                            ->send();
                        } 

                Yii::$app->getSession()->setFlash('info', [
                         'type' => 'info',
                         'duration' => 5000,
                         'icon' => 'glyphicon glyphicon-ok',
                         'message' => 'A solicitação de Contratação foi alterada para ' .$model->situacao->descricao,
                         'title' => 'Solicitação de Contratação',
                         'positonY' => 'top',
                         'positonX' => 'right'
                     ]);

            }elseif($posted['situacao_id'] == 16) // HOMOLOGAÇÃO
              {
                $connection = Yii::$app->db;
                $command = $connection->createCommand(
                 "UPDATE `db_processos`.`contratacao` SET `situacao_id` = '16' WHERE `contratacao`.`id` =" . $_POST['editableKey']);
                $command->execute();

         //ENVIANDO EMAIL PARA O GERENTE INFORMANDO SOBRE O PROCESSO
          $sql_email = "SELECT emus_email FROM emailusuario_emus, colaborador_col, responsavelambiente_ream WHERE ream_codunidade = '".$model->cod_unidade_solic."' AND ream_codcolaborador = col_codcolaborador AND col_codusuario = emus_codusuario";
      
      $email_solicitacao = Emailusuario::findBySql($sql_email)->all(); 
      foreach ($email_solicitacao as $email)
          {
            $email_gerente  = $email["emus_email"];

                            Yii::$app->mailer->compose()
                            ->setFrom(['contratacao@am.senac.br' => 'Contratação - Senac AM'])
                            ->setTo($email_gerente)
                            ->setSubject('Solicitação de Contratação '.$model->id.' - ' . $model->situacao->descricao)
                            ->setTextBody('A solicitação de contratação de código: '.$model->id.' está com status de '.$model->situacao->descricao.' ')
                            ->setHtmlBody('<h4>Prezado(a) Gerente, <br><br>Existe uma solicitação de contratação de <strong style="color: #337ab7"">código: '.$model->id.'</strong> com status de '.$model->situacao->descricao.'. <br> Por favor, não responda esse e-mail. Acesse http://portalsenac.am.senac.br para ANALISAR a solicitação de contratação. <br><br> Atenciosamente, <br> Contratação de Pessoal - Senac AM.</h4>')
                            ->send();
                        } 

                Yii::$app->getSession()->setFlash('info', [
                         'type' => 'info',
                         'duration' => 5000,
                         'icon' => 'glyphicon glyphicon-ok',
                         'message' => 'A solicitação de Contratação foi alterada para ' .$model->situacao->descricao,
                         'title' => 'Solicitação de Contratação',
                         'positonY' => 'top',
                         'positonX' => 'right'
                     ]);

            }else{ // PEDIDO DE CONTRATAÇÃO

           $connection = Yii::$app->db;
           $command = $connection->createCommand(
           "UPDATE `db_processos`.`contratacao` SET `situacao_id` = '17' WHERE `contratacao`.`id` =" . $_POST['editableKey']);
           $command->execute();    

         //ENVIANDO EMAIL PARA O GERENTE INFORMANDO SOBRE O PROCESSO
          $sql_email = "SELECT emus_email FROM emailusuario_emus, colaborador_col, responsavelambiente_ream WHERE ream_codunidade = '".$model->cod_unidade_solic."' AND ream_codcolaborador = col_codcolaborador AND col_codusuario = emus_codusuario";
      
      $email_solicitacao = Emailusuario::findBySql($sql_email)->all(); 
      foreach ($email_solicitacao as $email)
          {
            $email_gerente  = $email["emus_email"];

                            Yii::$app->mailer->compose()
                            ->setFrom(['contratacao@am.senac.br' => 'Contratação - Senac AM'])
                            ->setTo($email_gerente)
                            ->setSubject('Solicitação de Contratação '.$model->id.' - ' . $model->situacao->descricao)
                            ->setTextBody('A solicitação de contratação de código: '.$model->id.' está com status de '.$model->situacao->descricao.' ')
                            ->setHtmlBody('<h4>Prezado(a) Gerente, <br><br>Existe uma solicitação de contratação de <strong style="color: #337ab7"">código: '.$model->id.'</strong> com status de '.$model->situacao->descricao.'. <br> Por favor, não responda esse e-mail. Acesse http://portalsenac.am.senac.br para ANALISAR a solicitação de contratação. <br><br> Atenciosamente, <br> Contratação de Pessoal - Senac AM.</h4>')
                            ->send();
                        } 

                Yii::$app->getSession()->setFlash('info', [
                         'type' => 'info',
                         'duration' => 5000,
                         'icon' => 'glyphicon glyphicon-ok',
                         'message' => 'A solicitação de Contratação foi alterada para ' .$model->situacao->descricao,
                         'title' => 'Solicitação de Contratação',
                         'positonY' => 'top',
                         'positonX' => 'right'
                     ]);
            }

        return $this->redirect(['index']);
    }
}

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contratacao model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $session = Yii::$app->session;
        if (!isset($session['sess_codusuario']) && !isset($session['sess_codcolaborador']) && !isset($session['sess_codunidade']) && !isset($session['sess_nomeusuario']) && !isset($session['sess_coddepartamento']) && !isset($session['sess_codcargo']) && !isset($session['sess_cargo']) && !isset($session['sess_setor']) && !isset($session['sess_unidade']) && !isset($session['sess_responsavelsetor'])) 
        {
           return $this->redirect('http://portalsenac.am.senac.br');
        }

    //VERIFICA SE O COLABORADOR FAZ PARTE DO SETOR GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO
    if($session['sess_codunidade'] != 7 || $session['sess_coddepartamento'] != 82){

        $this->layout = 'main-acesso-negado';
        return $this->render('/site/acesso_negado');

    }else

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Contratacao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $session = Yii::$app->session;
        if (!isset($session['sess_codusuario']) && !isset($session['sess_codcolaborador']) && !isset($session['sess_codunidade']) && !isset($session['sess_nomeusuario']) && !isset($session['sess_coddepartamento']) && !isset($session['sess_codcargo']) && !isset($session['sess_cargo']) && !isset($session['sess_setor']) && !isset($session['sess_unidade']) && !isset($session['sess_responsavelsetor'])) 
        {
           return $this->redirect('http://portalsenac.am.senac.br');
        }

    //VERIFICA SE O COLABORADOR FAZ PARTE DO SETOR GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO
    if($session['sess_codunidade'] != 7 || $session['sess_coddepartamento'] != 82){

        $this->layout = 'main-acesso-negado';
        return $this->render('/site/acesso_negado');

    }else

        $model = new Contratacao();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Contratacao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $session = Yii::$app->session;
        if (!isset($session['sess_codusuario']) && !isset($session['sess_codcolaborador']) && !isset($session['sess_codunidade']) && !isset($session['sess_nomeusuario']) && !isset($session['sess_coddepartamento']) && !isset($session['sess_codcargo']) && !isset($session['sess_cargo']) && !isset($session['sess_setor']) && !isset($session['sess_unidade']) && !isset($session['sess_responsavelsetor'])) 
        {
           return $this->redirect('http://portalsenac.am.senac.br');
        }

    //VERIFICA SE O COLABORADOR FAZ PARTE DO SETOR GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO
    if($session['sess_codunidade'] != 7 || $session['sess_coddepartamento'] != 82){

        $this->layout = 'main-acesso-negado';
        return $this->render('/site/acesso_negado');

    }else
    
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionEncerrar($id)
    {

     $model = $this->findModel($id);

     //encerra a comunicacao que está em Circulação
     $session = Yii::$app->session;
     $connection = Yii::$app->db;
     $command = $connection->createCommand(
     "UPDATE `db_processos`.`contratacao` SET `situacao_id` = '5' WHERE `id` = '".$model->id."'");
    $command->execute();

     $model->situacao_id = 5;
     if($model->situacao_id == 5){

         //ENVIANDO EMAIL PARA O GERENTE INFORMANDO SOBRE O PROCESSO  DE CONTRATAÇÃO QUE FOI ENCERRADO
          $sql_email = "SELECT emus_email FROM emailusuario_emus, colaborador_col, responsavelambiente_ream WHERE ream_codunidade = '".$model->cod_unidade_solic."' AND ream_codcolaborador = col_codcolaborador AND col_codusuario = emus_codusuario";
      
      $email_solicitacao = Emailusuario::findBySql($sql_email)->all(); 
      foreach ($email_solicitacao as $email)
          {
            $email_gerente  = $email["emus_email"];

                            Yii::$app->mailer->compose()
                            ->setFrom(['contratacao@am.senac.br' => 'Contratação - Senac AM'])
                            ->setTo($email_gerente)
                            ->setSubject('Solicitação de Contratação '.$model->id.' - ' . $model->situacao->descricao)
                            ->setTextBody('A solicitação de contratação de código: '.$model->id.' está com status de '.$model->situacao->descricao.' ')
                            ->setHtmlBody('<h4>Prezado(a) Gerente, <br><br>Existe uma solicitação de contratação de <strong style="color: #337ab7"">código: '.$model->id.'</strong> com status de '.$model->situacao->descricao.'. <br> Por favor, não responda esse e-mail. Acesse http://portalsenac.am.senac.br para ANALISAR a solicitação de contratação. <br><br> Atenciosamente, <br> Contratação de Pessoal - Senac AM.</h4>')
                            ->send();
                        } 

        }

 //MENSAGEM DE CONFIRMAÇÃO DA SOLICITAÇÃO DE CONTRATAÇÃO ENCERRADA  
                Yii::$app->getSession()->setFlash('success', [
                         'type' => 'success',
                         'duration' => 5000,
                         'icon' => 'glyphicon glyphicon-ok',
                         'message' => 'A solicitação de Contratação foi ENCERRADA',
                         'title' => 'Solicitação de Contratação',
                         'positonY' => 'top',
                         'positonX' => 'right'
                     ]);
     
return $this->redirect(['index']);

    }

    public function actionCorrecao($id) 
    {


        $model = Contratacao::findOne($id);
        $session = Yii::$app->session;
        $session->set('sess_contratacao', $model->id);

        return $this->redirect(Yii::$app->request->BaseUrl . '/index.php?r=contratacao-justificativas/index', [
             'model' => $model,
         ]);
    }



    public function actionCancelar($id)
    {

     $model = $this->findModel($id);

     //envia para correção a contratação que está em recebido pelo GRH
     $session = Yii::$app->session;
     $connection = Yii::$app->db;
     $command = $connection->createCommand(
     "UPDATE `db_processos`.`contratacao` SET `situacao_id` = '6' WHERE `id` = '".$model->id."'");
     $command->execute();

     $model->situacao_id = 6;
     if($model->situacao_id == 6){

         //ENVIANDO EMAIL PARA O GERENTE INFORMANDO SOBRE O PROCESSO  DE CONTRATAÇÃO QUE FOI ENVIADO PARA CORREÇÃO
          $sql_email = "SELECT emus_email FROM emailusuario_emus, colaborador_col, responsavelambiente_ream WHERE ream_codunidade = '".$model->cod_unidade_solic."' AND ream_codcolaborador = col_codcolaborador AND col_codusuario = emus_codusuario";
      
      $email_solicitacao = Emailusuario::findBySql($sql_email)->all(); 
      foreach ($email_solicitacao as $email)
          {
            $email_gerente  = $email["emus_email"];

                            Yii::$app->mailer->compose()
                            ->setFrom(['contratacao@am.senac.br' => 'Contratação - Senac AM'])
                            ->setTo($email_gerente)
                            ->setSubject('Solicitação de Contratação '.$model->id.' - ' . $model->situacao->descricao)
                            ->setTextBody('A solicitação de contratação de código: '.$model->id.' está com status de '.$model->situacao->descricao.' ')
                            ->setHtmlBody('<h4>Prezado(a) Gerente, <br><br>Existe uma solicitação de contratação de <strong style="color: #337ab7"">código: '.$model->id.'</strong> com status de '.$model->situacao->descricao.'. <br> Por favor, não responda esse e-mail. Acesse http://portalsenac.am.senac.br para ANALISAR a solicitação de contratação. <br><br> Atenciosamente, <br> Contratação de Pessoal - Senac AM.</h4>')
                            ->send();
                        }
        } 


         //MENSAGEM DE CONFIRMAÇÃO DA SOLICITAÇÃO DE CONTRATAÇÃO FOI CANCELADA
                Yii::$app->getSession()->setFlash('success', [
                         'type' => 'success',
                         'duration' => 5000,
                         'icon' => 'glyphicon glyphicon-ok',
                         'message' => 'A solicitação de Contratação foi CANCELADA',
                         'title' => 'Solicitação de Contratação',
                         'positonY' => 'top',
                         'positonX' => 'right'
                     ]);
     
return $this->redirect(['index']);

    }



    /**
     * Deletes an existing Contratacao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Contratacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Contratacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contratacao::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
