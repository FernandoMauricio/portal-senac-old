<?php

namespace app\modules\manut_transporte\controllers;

use Yii;
use app\modules\manut_transporte\models\Emailusuario;
use app\modules\manut_transporte\models\Forum;
use app\modules\manut_transporte\models\ManutencaoAdmin;
use app\modules\manut_transporte\models\ManutencaoAdminSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ManutencaoAdminController implements the CRUD actions for ManutencaoAdmin model.
 */
class ManutencaoAdminController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ManutencaoAdmin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;
        if (!isset($session['sess_codusuario']) && !isset($session['sess_codcolaborador']) && !isset($session['sess_codunidade']) && !isset($session['sess_nomeusuario']) && !isset($session['sess_coddepartamento']) && !isset($session['sess_codcargo']) && !isset($session['sess_cargo']) && !isset($session['sess_setor']) && !isset($session['sess_unidade']) && !isset($session['sess_responsavelsetor'])) 
        {
           return $this->redirect('http://portalsenac.am.senac.br');
        }

    //VERIFICA SE O COLABORADOR FAZ PARTE DA EQUIPE DO GMT
    if($session['sess_coddepartamento'] != 16){

        $this->layout = 'main-acesso-negado';
        return $this->render('/site/acesso_negado');

    }else

        $searchModel = new ManutencaoAdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ManutencaoAdmin model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $session = Yii::$app->session;
        if (!isset($session['sess_codusuario']) && !isset($session['sess_codcolaborador']) && !isset($session['sess_codunidade']) && !isset($session['sess_nomeusuario']) && !isset($session['sess_coddepartamento']) && !isset($session['sess_codcargo']) && !isset($session['sess_cargo']) && !isset($session['sess_setor']) && !isset($session['sess_unidade']) && !isset($session['sess_responsavelsetor'])) 
        {
           return $this->redirect('http://portalsenac.am.senac.br');
        }

    //VERIFICA SE O COLABORADOR FAZ PARTE DA EQUIPE DO GMT
    if($session['sess_coddepartamento'] != 16){

        $this->layout = 'main-acesso-negado';
        return $this->render('/site/acesso_negado');

    }else

$session = Yii::$app->session;

         $model = $this->findModel($id);
         $forum = new Forum();


         $forum->manutencao_id = $model->id;
         $forum->usuario_id = $session['sess_codusuario'];
         $forum->data = date('Y-m-d H:i');

        //CONVERSA ENTRE USUARIO E SUPORTE
        if ($forum->load(Yii::$app->request->post()) && $forum->save()) {

         //ENVIANDO EMAIL PARA O USUÁRIO INFORMANDO SOBRE UMA NOVA MENSAGEM....
          $sql_email = "SELECT emus_email FROM `db_base`.emailusuario_emus WHERE emus_codusuario = '".$model->idusuario_solic."'";
      
      $email_solicitacao = Emailusuario::findBySql($sql_email)->all(); 
      foreach ($email_solicitacao as $email)
          {
            $email_usuario  = $email["emus_email"];

                            Yii::$app->mailer->compose()
                            ->setFrom(['gmt.suporte@am.senac.br' => 'GMT - INFORMA'])
                            ->setTo($email_usuario)
                            ->setSubject('Nova Mensagem! - Solicitação de Manutenção '.$model->id.'')
                            ->setTextBody('Por favor, verique uma nova mensagem na solicitação de transporte de código: '.$model->id.' com status de '.$model->situacao->nome.' ')
                            ->setHtmlBody('<p>Prezado(a), <span style="color:rgb(247, 148, 29)"><strong>'.$model->usuario_solic_nome.'</strong></span></p>

                            <p>A solicita&ccedil;&atilde;o de transporte de c&oacute;digo <span style="color:rgb(247, 148, 29)"><strong>'.$model->id.'</strong></span> foi atualizada:</p>

                            <p><strong>Mensagem</strong>: '.$forum->mensagem.'</p>

                            <p>Por favor, n&atilde;o responda esse e-mail. Acesse http://portalsenac.am.senac.br</p>

                            <p>Atenciosamente,&nbsp;</p>

                            <p>Ger&ecirc;ncia de Manutenção e Transporte - GMT</p>')
                            ->send();
               } 


            //MENSAGEM DE CONFIRMAÇÃO
            Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> A solicitação de Manutenção de código <strong>' .$model->id. '</strong> foi ATUALIZADA!</strong>');

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('view', [
                        'model' => $model,
                        'forum' => $forum,
                    ]);
            return $this->render('create', [
                'forum' => $forum,
            ]);
        }

    }
    /**
     * Creates a new ManutencaoAdmin model.
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

    //VERIFICA SE O COLABORADOR FAZ PARTE DA EQUIPE DO GMT
    if($session['sess_coddepartamento'] != 16){

        $this->layout = 'main-acesso-negado';
        return $this->render('/site/acesso_negado');

    }else

        $model = new ManutencaoAdmin();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ManutencaoAdmin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $session = Yii::$app->session;
        if (!isset($session['sess_codusuario']) && !isset($session['sess_codcolaborador']) && !isset($session['sess_codunidade']) && !isset($session['sess_nomeusuario']) && !isset($session['sess_coddepartamento']) && !isset($session['sess_codcargo']) && !isset($session['sess_cargo']) && !isset($session['sess_setor']) && !isset($session['sess_unidade']) && !isset($session['sess_responsavelsetor'])) 
        {
           return $this->redirect('http://portalsenac.am.senac.br');
        }

    //VERIFICA SE O COLABORADOR FAZ PARTE DA EQUIPE DO GMT
    if($session['sess_coddepartamento'] != 16){

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

 public function actionAssumir($id)
    {
        $session = Yii::$app->session;
        if (!isset($session['sess_codusuario']) && !isset($session['sess_codcolaborador']) && !isset($session['sess_codunidade']) && !isset($session['sess_nomeusuario']) && !isset($session['sess_coddepartamento']) && !isset($session['sess_codcargo']) && !isset($session['sess_cargo']) && !isset($session['sess_setor']) && !isset($session['sess_unidade']) && !isset($session['sess_responsavelsetor'])) 
        {
           return $this->redirect('http://portalsenac.am.senac.br');
        }

    //VERIFICA SE O COLABORADOR FAZ PARTE DA EQUIPE DO GMT
    if($session['sess_coddepartamento'] != 16){

        $this->layout = 'main-acesso-negado';
        return $this->render('/site/acesso_negado');

    }else

     $session = Yii::$app->session;

     $model = $this->findModel($id);

        //Atualiza a Solicitação para Agendado e inclui o usuário que está realizando o agendamento
        $model->idusuario_suport = $session['sess_codusuario'];
        $model->usuario_suport_nome = $session['sess_nomeusuario'];
        $model->cod_unidade_suport = $session['sess_codunidade'];

     //Atualiza a solicitação de manutenção
     $connection = Yii::$app->db;
     $command = $connection->createCommand(
     "UPDATE `db_manut_transporte`.`manutencao` SET `situacao_id` = '2' , `idusuario_suport` = '".$model->idusuario_suport."', `usuario_suport_nome` = '".$model->usuario_suport_nome."', `cod_unidade_suport` = '".$model->cod_unidade_suport."'  WHERE `id` = '".$model->id."'");
     $command->execute();

     $model->situacao_id = 2;
     if($model->situacao_id == 2){

         //ENVIANDO EMAIL PARA O USUÁRIO INFORMANDO SOBRE A SOLICITAÇÃO QUE FOI ENCERRADA
        //-- 12 - GERENCIA DE MANUTENÇÃO E TRANSPORTE // 16 - SEDE ADMINISTRATIVA GMT
          $sql_email = "SELECT emus_email FROM `db_base`.emailusuario_emus WHERE emus_codusuario = '".$model->idusuario_solic."'";
      
      $email_solicitacao = Emailusuario::findBySql($sql_email)->all(); 
      foreach ($email_solicitacao as $email)
          {
            $email_usuario  = $email["emus_email"];

                            Yii::$app->mailer->compose()
                            ->setFrom(['gmt.suporte@am.senac.br' => 'GMT - INFORMA'])
                            ->setTo($email_usuario)
                            ->setSubject('Solicitação de Manutenção '.$model->id.' - ' . $model->situacao->nome)
                            ->setTextBody('A solicitação de manutenção de código: '.$model->id.' está com status de '.$model->situacao->nome.' ')
                            ->setHtmlBody('<p>Prezado(a), <span style="color:rgb(247, 148, 29)"><strong>'.$model->usuario_solic_nome.'</strong></span></p>

                            <p>A solicita&ccedil;&atilde;o de manutenção de c&oacute;digo <span style="color:rgb(247, 148, 29)"><strong>'.$model->id.'</strong></span> foi atualizada:</p>

                            <p><strong>Respons&aacute;vel pelo Atendimento</strong>: '.$model->usuario_suport_nome.'</p>

                            <p>Por favor, n&atilde;o responda esse e-mail. Acesse http://portalsenac.am.senac.br</p>

                            <p>Atenciosamente,&nbsp;</p>

                            <p>Ger&ecirc;ncia de Manutenção e Manutenção - GMT</p>')
                            ->send();
                        } 

        }

            //MENSAGEM DE CONFIRMAÇÃO
            Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Solicitação de Manutenção foi <strong> ATUALIZADA!</strong>');

return $this->redirect(['index']);

    }


     public function actionEncerrar($id)
    {
        $session = Yii::$app->session;
        if (!isset($session['sess_codusuario']) && !isset($session['sess_codcolaborador']) && !isset($session['sess_codunidade']) && !isset($session['sess_nomeusuario']) && !isset($session['sess_coddepartamento']) && !isset($session['sess_codcargo']) && !isset($session['sess_cargo']) && !isset($session['sess_setor']) && !isset($session['sess_unidade']) && !isset($session['sess_responsavelsetor'])) 
        {
           return $this->redirect('http://portalsenac.am.senac.br');
        }

    //VERIFICA SE O COLABORADOR FAZ PARTE DA EQUIPE DO GMT
    if($session['sess_coddepartamento'] != 16){

        $this->layout = 'main-acesso-negado';
        return $this->render('/site/acesso_negado');

    }else
    
         $session = Yii::$app->session;

         $model = $this->findModel($id);

         $model->usuario_encerramento = $session['sess_nomeusuario'];
         $model->data_encerramento = date('Y-m-d H:i:s');

         //encerra a solicitação de manutenção
         $connection = Yii::$app->db;
         $command = $connection->createCommand(
         "UPDATE `db_manut_transporte`.`manutencao` SET `situacao_id` = '3' , `usuario_encerramento` = '".$model->usuario_encerramento."', `data_encerramento` = '".$model->data_encerramento."' WHERE `id` = '".$model->id."'");
         $command->execute();

         $model->situacao_id = 3;
         if($model->situacao_id == 3){

             //ENVIANDO EMAIL PARA O USUÁRIO INFORMANDO SOBRE A SOLICITAÇÃO QUE FOI ENCERRADA
            //-- 12 - GERENCIA DE MANUTENÇÃO E TRANSPORTE // 16 - SEDE ADMINISTRATIVA GMT
              $sql_email = "SELECT emus_email FROM `db_base`.emailusuario_emus WHERE emus_codusuario = '".$model->idusuario_solic."'";
          
          $email_solicitacao = Emailusuario::findBySql($sql_email)->all(); 
          foreach ($email_solicitacao as $email)
              {
                $email_usuario  = $email["emus_email"];

                                Yii::$app->mailer->compose()
                                ->setFrom(['gmt.suporte@am.senac.br' => 'GMT - INFORMA'])
                                ->setTo($email_usuario)
                                ->setSubject('Solicitação de Manutenção '.$model->id.' - ' . $model->situacao->nome)
                                ->setTextBody('A solicitação de manutenção de código: '.$model->id.' está com status de '.$model->situacao->nome.' ')
                                ->setHtmlBody('<p>Prezado(a), <span style="color:rgb(247, 148, 29)"><strong>'.$model->usuario_solic_nome.'</strong></span></p>

                                <p>A solicita&ccedil;&atilde;o de manutenção de c&oacute;digo <span style="color:rgb(247, 148, 29)"><strong>'.$model->id.'</strong></span> foi atualizada:</p>

                                <p><strong>Respons&aacute;vel pelo Encerramento</strong>: '.$model->usuario_encerramento.'</p>

                                <p><strong>Data do Encerramento</strong>: '.date('d/m/Y H:i', strtotime($model->data_encerramento)).'</p>

                                <p>Por favor, n&atilde;o responda esse e-mail. Acesse http://portalsenac.am.senac.br</p>

                                <p>Atenciosamente,&nbsp;</p>

                                <p>Ger&ecirc;ncia de Manutenção e Manutenção - GMT</p>')
                                ->send();
                            } 

            }

                //MENSAGEM DE CONFIRMAÇÃO
                Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Solicitação de Manutenção foi <strong> FINALIZADA!</strong>');

    return $this->redirect(['index']);

        }

    /**
     * Deletes an existing ManutencaoAdmin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ManutencaoAdmin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ManutencaoAdmin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ManutencaoAdmin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
