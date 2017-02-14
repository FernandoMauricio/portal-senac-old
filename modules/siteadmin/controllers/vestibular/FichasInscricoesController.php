<?php

namespace app\modules\siteadmin\controllers\vestibular;

use Yii;
use app\modules\siteadmin\models\vestibular\FichasInscricoes;
use app\modules\siteadmin\models\vestibular\FichasInscricoesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * FichasInscricoesController implements the CRUD actions for FichasInscricoes model.
 */
class FichasInscricoesController extends Controller
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
     * Lists all FichasInscricoes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;
        if (!isset($session['sess_codusuario']) && !isset($session['sess_codcolaborador']) && !isset($session['sess_codunidade']) && !isset($session['sess_nomeusuario']) && !isset($session['sess_coddepartamento']) && !isset($session['sess_codcargo']) && !isset($session['sess_cargo']) && !isset($session['sess_setor']) && !isset($session['sess_unidade']) && !isset($session['sess_responsavelsetor'])) 
        {
           return $this->redirect('http://portalsenac.am.senac.br');
        }
         $codunidade   = $session['sess_codunidade'];
         $session->close();

if($codunidade == 47){

        $searchModel = new FichasInscricoesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }else{
        $this->layout = 'main-acesso-negado-menu';
        return $this->render('../../site/acesso_negado_menu');
        }
    }

    /**
     * Displays a single FichasInscricoes model.
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
         $codunidade   = $session['sess_codunidade'];
         $session->close();

if($codunidade == 47){

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }else{
        $this->layout = 'main-acesso-negado-menu';
        return $this->render('../../site/acesso_negado_menu');
        }
    }

    /**
     * Creates a new FichasInscricoes model.
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
         $codunidade   = $session['sess_codunidade'];
         $session->close();

if($codunidade == 47){
        
        $model = new FichasInscricoes();

        $model->data = date('Y-m-d');        
        $model->vestibular_id = $session['sess_vestibular'];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            //INCLUSÃO DE EDITAIS
            $model->file = UploadedFile::getInstance($model, 'file');


                if(empty($model->file)){
                Yii::$app->session->setFlash('danger', 'É obrigatório o envio do arquivo para inserir a ficha de inscrição! ');
                return $this->render('create', ['model' => $model]);
                }


            if ($model->file && $model->validate()) {  
            $model->arquivoInscricao = 'uploads/vestibular/fichasinscricoes/' . $model->file->baseName . '.' . $model->file->extension;
            $model->save();

            if($model->save()){
            $model->file->saveAs('uploads/vestibular/fichasinscricoes/' . $model->file->baseName . '.' . $model->file->extension);
                
                Yii::$app->session->setFlash('success', 'Ficha de Inscrição inserida com sucesso! ');
            }
        }
            return $this->redirect(['index']);

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }else{
        $this->layout = 'main-acesso-negado-menu';
        return $this->render('../../site/acesso_negado_menu');
        }
    }

    /**
     * Updates an existing FichasInscricoes model.
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
         $codunidade   = $session['sess_codunidade'];
         $session->close();

if($codunidade == 47){

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            Yii::$app->session->setFlash('success', 'Ficha de Inscrição atualizada com sucesso! ');

            //DATA DE CADASTRO
            $model->data = date('Y-m-d');

            //INCLUSÃO DO ARQUIVO DE ABERTURA DE VAGAS
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->file && $model->validate()) 
            {  
                $model->arquivoInscricao = 'uploads/vestibular/fichasinscricoes/' . $model->file->baseName . '.' . $model->file->extension;
                $model->save();

                if($model->save())
                {
                    if (!empty($_POST)) 
                    {
                          $model->file->saveAs('uploads/vestibular/fichasinscricoes/' . $model->file->baseName . '.' . $model->file->extension);
                    }   
                                 

                }

            }  

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }else{
        $this->layout = 'main-acesso-negado-menu';
        return $this->render('../../site/acesso_negado_menu');
        }
    }

    /**
     * Deletes an existing FichasInscricoes model.
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
     * Finds the FichasInscricoes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FichasInscricoes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FichasInscricoes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
