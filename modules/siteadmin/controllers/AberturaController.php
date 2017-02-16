<?php

namespace app\modules\siteadmin\controllers;

use Yii;
use app\modules\siteadmin\models\Abertura;
use app\modules\siteadmin\models\AberturaSearch;
use app\modules\siteadmin\models\Classificados;
use app\modules\siteadmin\models\ClassificadosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\controllers\Query;

/**
 * AberturaController implements the CRUD actions for Abertura model.
 */
class AberturaController extends Controller
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

    /**
     * Lists all Abertura models.
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
 
 if($codunidade == 11){
        $searchModel = new AberturaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }else{
        $this->layout = 'main-acesso-negado-menu';
        return $this->render('../site/acesso_negado_menu');
        }
    }

    /**
     * Displays a single Abertura model.
     * @param integer $id
     * @param integer $estado_id
     * @param integer $status_id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Abertura model.
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
 
 if($codunidade == 11){
        $model = new Abertura();

        if ($model->load(Yii::$app->request->post())) {

            //DATA DE CADASTRO
            $model->data = date('Y-m-d');


            //INCLUSÃO DO ARQUIVO DE ABERTURA DE VAGAS
            $model->file = UploadedFile::getInstance($model, 'file');


                if(empty($model->file)){
                Yii::$app->session->setFlash('danger', 'É obrigatório o envio do arquivo para criar a Abertura de Vagas! ');
                return $this->render('create', ['model' => $model]);
                }


            if ($model->file && $model->validate()) {  
            $model->arquivo = 'uploads/siteadmin/psg/' . $model->file->baseName . '.' . $model->file->extension;
            $model->save();

            if($model->save()){
            $model->file->saveAs('uploads/siteadmin/psg/' . $model->file->baseName . '.' . $model->file->extension);
                
                Yii::$app->session->setFlash('success', 'Abertura de Vagas criada com sucesso! ');
            }
        } 

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }else{
        $this->layout = 'main-acesso-negado-menu';
        return $this->render('../site/acesso_negado_menu');
        }
    }

    /**
     * Updates an existing Abertura model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $estado_id
     * @param integer $status_id
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
 
 if($codunidade == 11){
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

Yii::$app->session->setFlash('success', 'Abertura de Vagas atualizada com sucesso! ');

            //DATA DE CADASTRO
            $model->data = date('Y-m-d');

            //INCLUSÃO DO ARQUIVO DE ABERTURA DE VAGAS
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->file && $model->validate()) 
            {  
                $model->arquivo = 'uploads/siteadmin/psg/' . $model->file->baseName . '.' . $model->file->extension;
                $model->save();

                if($model->save())
                {
                    if (!empty($_POST)) 
                    {
                          $model->file->saveAs('uploads/siteadmin/psg/' . $model->file->baseName . '.' . $model->file->extension);
                    }   
                                
                }

            }  

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }else{
        $this->layout = 'main-acesso-negado-menu';
        return $this->render('../site/acesso_negado_menu');
        }
    }

    /**
     * Deletes an existing Abertura model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $estado_id
     * @param integer $status_id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }




    public function actionClassificados($id) 
    {


        $model = Abertura::findOne($id);
        $session = Yii::$app->session;
        $session->set('sess_abertura', $model->id);

        return $this->redirect('http://portalsenac.am.senac.br/siteadmin/web/index.php?r=classificados/index', [
             'model' => $model,
         ]);
    }

    public function actionComunicado($id) 
    {


        $model = Abertura::findOne($id);
        $session = Yii::$app->session;
        $session->set('sess_abertura', $model->id);

        return $this->redirect('http://portalsenac.am.senac.br/siteadmin/web/index.php?r=comunicado/index', [
             'model' => $model,
         ]);
    }

    public function actionErrata($id) 
    {


        $model = Abertura::findOne($id);
        $session = Yii::$app->session;
        $session->set('sess_abertura', $model->id);

        return $this->redirect('http://portalsenac.am.senac.br/siteadmin/web/index.php?r=errata/index', [
             'model' => $model,
         ]);
    }



    /**
     * Finds the Abertura model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $estado_id
     * @param integer $status_id
     * @return Abertura the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Abertura::findOne(['id' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
