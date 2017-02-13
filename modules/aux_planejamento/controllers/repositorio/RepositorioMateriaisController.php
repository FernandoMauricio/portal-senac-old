<?php

namespace app\modules\aux_planejamento\controllers\repositorio;

use Yii;
use app\modules\aux_planejamento\models\repositorio\Elementodespesa;
use app\modules\aux_planejamento\models\repositorio\Categoria;
use app\modules\aux_planejamento\models\repositorio\Editora;
use app\modules\aux_planejamento\models\repositorio\Tipomaterial;
use app\modules\aux_planejamento\models\repositorio\Repositorio;
use app\modules\aux_planejamento\models\repositorio\RepositorioMateriaisSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

/**
 * RepositorioMateriaisController implements the CRUD actions for Repositorio model.
 */
class RepositorioMateriaisController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {

      $this->AccessAllow(); //Irá ser verificado se o usuário está logado no sistema

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
     * Lists all Repositorio models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RepositorioMateriaisSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Repositorio model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    //Localiza os dados de tipos de material cadastrados no repositorio
    public function actionGetTipoMaterial($tipmatId){

        $getTipomaterial = Tipomaterial::find()->where(['tip_descricao' => $tipmatId])->one();

        echo Json::encode($getTipomaterial);
    }

    /**
     * Creates a new Repositorio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $session = Yii::$app->session;

        $model = new Repositorio();

        $categoria = Categoria::find()->where(['cat_status' => 1])->orderBy('cat_codcategoria')->all();
        $editora = Editora::find()->where(['edi_status' => 1])->orderBy('edi_descricao')->all();
        $tipomaterial = Tipomaterial::find()->where(['tip_status' => 1])->orderBy('tip_codtipo')->all();

        $model->rep_data = date('Y-m-d');
        $model->rep_codunidade = $session['sess_codunidade'];
        $model->rep_codcolaborador = $session['sess_codcolaborador'];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            //INCLUSÃO DO ARQUIVO
            $model->file = UploadedFile::getInstance($model, 'file');
                       if (!is_null($model->file)) {
                           //criação da pasta que constará o arquivo 
                          mkdir(Yii::$app->basePath . '/web/uploads/repositorio/' . $model->rep_codrepositorio);
                          $model->rep_arquivo = $model->file->baseName . '.' . $model->file->extension;
                          //salva o arquivo no caminho da criação da pasta
                          Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/repositorio/' . $model->rep_codrepositorio .'/';
                          $path = Yii::$app->params['uploadPath'] . $model->file;
                           $model->file->saveAs($path);
                        }
              //INCLUSÃO DA CAPA
            $image = UploadedFile::getInstance($model, 'image');
                       if (!is_null($image)) {
                         $model->rep_image_src_filename = $image->name;
                         $ext = end((explode(".", $image->name)));
                          // generate a unique file name to prevent duplicate filenames
                          $model->rep_image_web_filename = Yii::$app->security->generateRandomString().".{$ext}";
                          // the path to save file, you can set an uploadPath
                          // in Yii::$app->params (as used in example below)                       
                          Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/repositorio/capas/';
                          $path = Yii::$app->params['uploadPath'] . $model->rep_image_web_filename;
                           $image->saveAs($path);
                        }
                        if ($model->save()) {  
                        Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Material didático cadastrado!</strong>');           
                            return $this->redirect(['index']);       
                        }  else {
                            var_dump ($model->getErrors()); die();
                         }
                } 
            return $this->render('create', [
                'model' => $model,
                'categoria' => $categoria,
                'editora' => $editora,
                'tipomaterial' => $tipomaterial,
            ]);
    }

    /**
     * Updates an existing Repositorio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $session = Yii::$app->session;

        $model = $this->findModel($id);

        $categoria = Categoria::find()->where(['cat_status' => 1])->orderBy('cat_codcategoria')->all();
        $editora = Editora::find()->where(['edi_status' => 1])->orderBy('edi_descricao')->all();
        $tipomaterial = Tipomaterial::find()->where(['tip_status' => 1])->orderBy('tip_codtipo')->all();

        $model->rep_data = date('Y-m-d');
        $model->rep_codunidade = $session['sess_codunidade'];
        $model->rep_codcolaborador = $session['sess_codcolaborador'];
        $model->file = $model->rep_arquivo;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            //INCLUSÃO DO ARQUIVO
            $model->file = UploadedFile::getInstance($model, 'file');
                       if (!is_null($model->file)) {
                          $model->rep_arquivo = $model->file->baseName . '.' . $model->file->extension;
                          //salva o arquivo no caminho da criação da pasta
                          Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/repositorio/' . $model->rep_codrepositorio .'/';
                          $path = Yii::$app->params['uploadPath'] . $model->file;
                           $model->file->saveAs($path);
                        }
            //INCLUSÃO DA CAPA
            $image = UploadedFile::getInstance($model, 'image');
                       if (!is_null($image)) {
                         $model->rep_image_src_filename = $image->name;
                         $ext = end((explode(".", $image->name)));
                          // generate a unique file name to prevent duplicate filenames
                          $model->rep_image_web_filename = Yii::$app->security->generateRandomString().".{$ext}";
                          // the path to save file, you can set an uploadPath
                          // in Yii::$app->params (as used in example below)                       
                          Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/repositorio/capas/';
                          $path = Yii::$app->params['uploadPath'] . $model->rep_image_web_filename;
                           $image->saveAs($path);
                        }
                        if ($model->save()) {  
                        Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Material didático atualizado!</strong>');           
                            return $this->redirect(['index']);       
                        }  else {
                            var_dump ($model->getErrors()); die();
                         }
                } 
            return $this->render('update', [
                'model' => $model,
                'categoria' => $categoria,
                'editora' => $editora,
                'tipomaterial' => $tipomaterial,
            ]);
    }

    /**
     * Deletes an existing Repositorio model.
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
     * Finds the Repositorio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Repositorio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Repositorio::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('A página solicitada não existe.');
        }
    }

    public function AccessAllow()
    {
        $session = Yii::$app->session;
        if (!isset($session['sess_codusuario']) && !isset($session['sess_codcolaborador']) && !isset($session['sess_codunidade']) && !isset($session['sess_nomeusuario']) && !isset($session['sess_coddepartamento']) && !isset($session['sess_codcargo']) && !isset($session['sess_cargo']) && !isset($session['sess_setor']) && !isset($session['sess_unidade']) && !isset($session['sess_responsavelsetor'])) 
        {
           return $this->redirect('http://portalsenac.am.senac.br');
        }
    }
}
