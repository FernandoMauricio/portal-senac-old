<?php

namespace app\modules\manut_transporte\controllers;

use Yii;
use app\modules\manut_transporte\models\Bairro;
use app\modules\manut_transporte\models\Forum;
use app\modules\manut_transporte\models\Motorista;
use app\modules\manut_transporte\models\TipoCarga;
use app\modules\manut_transporte\models\Emailusuario;
use app\modules\manut_transporte\models\TransporteAdminAcompanhamento;
use app\modules\manut_transporte\models\TransporteAdminAcompanhamentoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TransporteAdminAcompanhamentoController implements the CRUD actions for TransporteAdminAcompanhamento model.
 */
class TransporteAdminAcompanhamentoController extends Controller
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
     * Lists all TransporteAdminAcompanhamento models.
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

        $searchModel = new TransporteAdminAcompanhamentoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TransporteAdminAcompanhamento model.
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


         $forum->transporte_id = $model->id;
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
                            ->setSubject('Nova Mensagem! - Solicitação de Transporte '.$model->id.'')
                            ->setTextBody('Por favor, verique uma nova mensagem na solicitação de transporte de código: '.$model->id.' com status de '.$model->situacao->nome.' ')
                            ->setHtmlBody('<p>Prezado(a), <span style="color:rgb(247, 148, 29)"><strong>'.$model->usuario_solic_nome.'</strong></span></p>

                            <p>A solicita&ccedil;&atilde;o de transporte de c&oacute;digo <span style="color:rgb(247, 148, 29)"><strong>'.$model->id.'</strong></span> foi atualizada:</p>

                            <p><strong>Mensagem</strong>: '.$forum->mensagem.'</p>

                            <p><strong>Respons&aacute;vel pelo Atendimento</strong>: '.$model->usuario_suport_nome.'</p>

                            <p>Por favor, n&atilde;o responda esse e-mail. Acesse http://portalsenac.am.senac.br</p>

                            <p>Atenciosamente,&nbsp;</p>

                            <p>Ger&ecirc;ncia de Manutenção e Transporte - GMT</p>')
                            ->send();
               } 


            //MENSAGEM DE CONFIRMAÇÃO
            Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> A solicitação de Transporte de código <strong>' .$model->id. '</strong> foi ATUALIZADA!</strong>');

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
     * Creates a new TransporteAdminAcompanhamento model.
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

        $model = new TransporteAdminAcompanhamento();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TransporteAdminAcompanhamento model.
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
    
        $session = Yii::$app->session;

        $model = $this->findModel($id);

        //Localização dos bairros, motoristas e tipo de carga
        $bairros = Bairro::find()->all();
        $motoristas = Motorista::find()->where(['status' => 1])->all();
        $tipoCarga = TipoCarga::find()->all();

        //Atualiza a Solicitação para Agendado e inclui o usuário que está realizando o agendamento
        $model->idusuario_suport = $session['sess_codusuario'];
        $model->usuario_suport_nome = $session['sess_nomeusuario'];
        $model->cod_unidade_suport = $session['sess_codunidade'];


        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->situacao_id = 2; //Agendado
            $model->save();

     if($model->situacao_id == 2){

         //ENVIANDO EMAIL PARA O USUÁRIO INFORMANDO SOBRE A SITUAÇÃO, MOTORISTA, CONFIRMAÇÃO DE DATA E HORA, RESPONSÁVEL PELO ATENDIMENTO....
          $sql_email = "SELECT emus_email FROM `db_base`.emailusuario_emus WHERE emus_codusuario = '".$model->idusuario_solic."'";
      
      $email_solicitacao = Emailusuario::findBySql($sql_email)->all(); 
      foreach ($email_solicitacao as $email)
          {
            $email_usuario  = $email["emus_email"];

                            Yii::$app->mailer->compose()
                            ->setFrom(['gmt.suporte@am.senac.br' => 'GMT - INFORMA'])
                            ->setTo($email_usuario)
                            ->setSubject('Solicitação de Transporte '.$model->id.' - ' . $model->situacao->nome)
                            ->setTextBody('A solicitação de transporte de código: '.$model->id.' está com status de '.$model->situacao->nome.' ')
                            ->setHtmlBody('<p>Prezado(a), <span style="color:rgb(247, 148, 29)"><strong>'.$model->usuario_solic_nome.'</strong></span></p>

                            <p>A solicita&ccedil;&atilde;o de transporte de c&oacute;digo <span style="color:rgb(247, 148, 29)"><strong>'.$model->id.'</strong></span> foi atualizada:</p>

                            <p><strong>Situa&ccedil;&atilde;o</strong>: '.$model->situacao->nome.'</p>

                            <p><strong>Motorista Respons&aacute;vel</strong>: '.$model->motorista->descricao.'</p>

                            <p><strong>Data Confirmada</strong>: '.date('d/m/Y', strtotime($model->data_confirmacao)).'</p>

                            <p><strong>Hora Confirmada</strong>: '.$model->hora_confirmacao.'</p>

                            <p><strong>Respons&aacute;vel pelo Atendimento</strong>: '.$model->usuario_suport_nome.'</p>

                            <p>Por favor, n&atilde;o responda esse e-mail. Acesse http://portalsenac.am.senac.br</p>

                            <p>Atenciosamente,&nbsp;</p>

                            <p>Ger&ecirc;ncia de Manutenção e Transporte - GMT</p>')
                                                        ->send();
                                                    } 

        }

            //MENSAGEM DE CONFIRMAÇÃO
            Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> A solicitação de Transporte de código <strong>' .$model->id. '</strong> foi ATUALIZADA!</strong>');
                
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'bairros'=> $bairros,
                'motoristas'=>$motoristas,
                'tipoCarga'=>$tipoCarga,
            ]);
        }
    }



    public function actionEncerrar($id)
    {
     $session = Yii::$app->session;

     $model = $this->findModel($id);

     $model->usuario_encerramento = $session['sess_nomeusuario'];
     $model->data_encerramento = date('Y-m-d H:i:s');

     //encerra a solicitação de transporte
     $connection = Yii::$app->db;
     $command = $connection->createCommand(
     "UPDATE `db_manut_transporte`.`transporte` SET `situacao_id` = '3' , `usuario_encerramento` = '".$model->usuario_encerramento."', `data_encerramento` = '".$model->data_encerramento."' WHERE `id` = '".$model->id."'");
     $command->execute();

     $model->situacao_id = 3;
     if($model->situacao_id == 3){

         //ENVIANDO EMAIL PARA O USUÁRIO INFORMANDO SOBRE A SOLICITAÇÃO QUE FOI ENCERRADA
          $sql_email = "SELECT emus_email FROM `db_base`.emailusuario_emus WHERE emus_codusuario = '".$model->idusuario_solic."'";
      
      $email_solicitacao = Emailusuario::findBySql($sql_email)->all(); 
      foreach ($email_solicitacao as $email)
          {
            $email_usuario  = $email["emus_email"];

                            Yii::$app->mailer->compose()
                            ->setFrom(['gmt.suporte@am.senac.br' => 'GMT - INFORMA'])
                            ->setTo($email_usuario)
                            ->setSubject('Solicitação de Transporte '.$model->id.' - ' . $model->situacao->nome)
                            ->setTextBody('A solicitação de transporte de código: '.$model->id.' está com status de '.$model->situacao->nome.' ')
                            ->setHtmlBody('<p>Prezado(a), <span style="color:rgb(247, 148, 29)"><strong>'.$model->usuario_solic_nome.'</strong></span></p>

                            <p>A solicita&ccedil;&atilde;o de transporte de c&oacute;digo <span style="color:rgb(247, 148, 29)"><strong>'.$model->id.'</strong></span> foi atualizada:</p>

                            <p><strong>Respons&aacute;vel pelo Encerramento</strong>: '.$model->usuario_encerramento.'</p>

                            <p><strong>Data do Encerramento</strong>: '.date('d/m/Y H:i', strtotime($model->data_encerramento)).'</p>

                            <p>Por favor, n&atilde;o responda esse e-mail. Acesse http://portalsenac.am.senac.br</p>

                            <p>Atenciosamente,&nbsp;</p>

                            <p>Ger&ecirc;ncia de Manutenção e Transporte - GMT</p>')
                            ->send();
                        } 

        }

 //MENSAGEM DE CONFIRMAÇÃO DA SOLICITAÇÃO DE CONTRATAÇÃO ENCERRADA  
            Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> A solicitação de Transporte de código <strong>' .$model->id. '</strong> foi FINALIZADA!</strong>');
            
     
return $this->redirect(['index']);

    }



    /**
     * Deletes an existing TransporteAdminAcompanhamento model.
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
     * Finds the TransporteAdminAcompanhamento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransporteAdminAcompanhamento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransporteAdminAcompanhamento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
