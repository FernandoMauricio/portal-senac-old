<?php

namespace app\modules\comunicacaointerna\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\modules\comunicacaointerna\models\LoginForm;
use app\modules\comunicacaointerna\models\ContactForm;
use app\modules\comunicacaointerna\models\Comunicacaointerna;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        session_start();

        if (!isset($_SESSION['sess_codusuario']) && !isset($_SESSION['sess_codcolaborador']) && !isset($_SESSION['sess_codunidade']) && !isset($_SESSION['sess_nomeusuario']) && !isset($_SESSION['sess_coddepartamento']) && !isset($_SESSION['sess_codcargo']) && !isset($_SESSION['sess_cargo']) && !isset($_SESSION['sess_setor']) && !isset($_SESSION['sess_unidade']) && !isset($_SESSION['sess_responsavelsetor'])) 
        {
           return $this->redirect('http://portalsenac.am.senac.br');
        }

             //BUSCA NO BANCO SE EXISTE CI PENDENTE
             $checar_ci = Comunicacaointerna::find()
                ->where(['com_codcomunicacao' => 4])
                ->count(); 


        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }


    public function actionVersao()
    {
        session_start();

        if (!isset($_SESSION['sess_codusuario']) && !isset($_SESSION['sess_codcolaborador']) && !isset($_SESSION['sess_codunidade']) && !isset($_SESSION['sess_nomeusuario']) && !isset($_SESSION['sess_coddepartamento']) && !isset($_SESSION['sess_codcargo']) && !isset($_SESSION['sess_cargo']) && !isset($_SESSION['sess_setor']) && !isset($_SESSION['sess_unidade']) && !isset($_SESSION['sess_responsavelsetor'])) 
        {
           return $this->redirect('http://portalsenac.am.senac.br');
        }

        return $this->render('versao');
    }


    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
