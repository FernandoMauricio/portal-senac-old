<?php

namespace app\modules\manut_transporte\controllers;

use Yii;
use app\modules\manut_transporte\models\Emailusuario;
use app\modules\manut_transporte\models\Forum;
use app\modules\manut_transporte\models\Manutencao;
use app\modules\manut_transporte\models\ManutencaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ManutencaoController implements the CRUD actions for Manutencao model.
 */
class ManutencaoController extends Controller
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
     * Lists all Manutencao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ManutencaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Manutencao model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        $session = Yii::$app->session;

         $model = $this->findModel($id);
         $forum = new Forum();


         $forum->manutencao_id = $model->id;
         $forum->usuario_id = $session['sess_codusuario'];
         $forum->data = date('Y-m-d H:i');

        //CONVERSA ENTRE USUARIO E SUPORTE
        if ($forum->load(Yii::$app->request->post()) && $forum->save()) {

         //ENVIANDO EMAIL PARA O USUÁRIO INFORMANDO SOBRE UMA NOVA MENSAGEM....
          $sql_email = "SELECT emus_email FROM `db_base`.emailusuario_emus WHERE emus_codusuario = '".$model->idusuario_suport."'";
      
      $email_solicitacao = Emailusuario::findBySql($sql_email)->all(); 
      foreach ($email_solicitacao as $email)
          {
            $email_usuario  = $email["emus_email"];

                            Yii::$app->mailer->compose()
                            ->setFrom(['gmt.suporte@am.senac.br' => 'GMT - INFORMA'])
                            ->setTo($email_usuario)
                            ->setSubject('Nova Mensagem! - Solicitação de Manutenção '.$model->id.'')
                            ->setTextBody('Por favor, verique uma nova mensagem na solicitação de manutenção de código: '.$model->id.' com status de '.$model->situacao->nome.' ')
                            ->setHtmlBody('<p>Prezado(a), <span style="color:rgb(247, 148, 29)"><strong>'.$model->usuario_suport_nome.'</strong></span></p>

                            <p>A solicita&ccedil;&atilde;o de manutenção de c&oacute;digo <span style="color:rgb(247, 148, 29)"><strong>'.$model->id.'</strong></span> foi atualizada:</p>

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
     * Creates a new Manutencao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $session = Yii::$app->session;

        $model = new Manutencao();

        //Encaminhado para providências
        $model->tipo_solic_id = 2; // Solicitação de Manutenção
        $model->idusuario_solic = $session['sess_codusuario'];
        $model->usuario_solic_nome = $session['sess_nomeusuario'];
        $model->cod_unidade_solic = $session['sess_codunidade'];
        $model->data_solicitacao = date('Y-m-d');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           
        //ENVIANDO EMAIL PARA OS RESPONSÁVEIS DO GMT INFORMANDO SOBRE O RECEBIMENTO DE UMA NOVA SOLICITAÇÃO DE MANUTENÇÃO 
        //-- 12 - GERENCIA DE MANUTENÇÃO E TRANSPORTE // 16 - SEDE ADMINISTRATIVA GMT
                  $sql_email = "SELECT DISTINCT emus_email FROM emailusuario_emus,colaborador_col,responsavelambiente_ream,responsaveldepartamento_rede WHERE ream_codunidade = '12' AND rede_coddepartamento = '16' AND rede_codcolaborador = col_codcolaborador AND col_codusuario = emus_codusuario";
              
              $email_solicitacao = Emailusuario::findBySql($sql_email)->all(); 
              foreach ($email_solicitacao as $email)
                  {
                    $email_usuario  = $email["emus_email"];

                                    Yii::$app->mailer->compose()
                                    ->setFrom(['gmt.suporte@am.senac.br' => 'GMT - INFORMA'])
                                    ->setTo($email_usuario)
                                    ->setSubject('Solicitação de Manutenção - ' . $model->id)
                                    ->setTextBody('Existe uma solicitação de '.$model->tipoSolic->descricao.' de código: '.$model->id.' - PENDENTE')
                                    ->setHtmlBody('<p>Prezado(a) Senhor(a),</p>

                                    <p>Existe uma solicita&ccedil;&atilde;o de '.$model->tipoSolic->descricao.' de c&oacute;digo: <strong><span style="color:#F7941D">'.$model->id.' </span></strong>- <strong><span style="color:#F7941D">PENDENTE</span></strong></p>

                                    <p>Por favor, n&atilde;o responda esse e-mail. Acesse http://portalsenac.am.senac.br para ANALISAR a solicita&ccedil;&atilde;o de  '.$model->tipoSolic->descricao.'.</p>

                                    <p>Atenciosamente,</p>

                                    <p>Ger&ecirc;ncia de Manuten&ccedil;&atilde;o e Transporte -&nbsp;GMT</p>
                                    ')
                                    ->send();
                                } 


            //MENSAGEM DE CONFIRMAÇÃO
            Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Solicitação de '.$model->tipoSolic->descricao.' <strong> criada!</strong>');

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Manutencao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
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
              $sql_email = "SELECT emus_email FROM `db_base`.emailusuario_emus WHERE emus_codusuario = '".$model->idusuario_suport."'";
          
          $email_solicitacao = Emailusuario::findBySql($sql_email)->all(); 
          foreach ($email_solicitacao as $email)
              {
                $email_usuario  = $email["emus_email"];

                                Yii::$app->mailer->compose()
                                ->setFrom(['gmt.suporte@am.senac.br' => 'GMT - INFORMA'])
                                ->setTo($email_usuario)
                                ->setSubject('Solicitação de Manutenção '.$model->id.' - ' . $model->situacao->nome)
                                ->setTextBody('A solicitação de manutenção de código: '.$model->id.' está com status de '.$model->situacao->nome.' ')
                                ->setHtmlBody('<p>Prezado(a), <span style="color:rgb(247, 148, 29)"><strong>'.$model->usuario_suport_nome.'</strong></span></p>

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
     * Deletes an existing Manutencao model.
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
     * Finds the Manutencao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Manutencao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Manutencao::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
