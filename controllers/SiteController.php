<?php

namespace app\controllers;

use app\models\Post;
use app\models\Shipment;
use app\models\ShipmentCode;
use app\models\ShipmentCodeSearch;
use app\models\ShipmentQuery;
use app\models\ShipmentSearch;
use app\models\TrackForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\AssetManager;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

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
//        Post::find()->innerJoinWith('termRelationships')->innerJoinWith('categoryTaxonomies')->innerJoinWith('categoryTerms')->select('post.*, post_term.name, post_term.slug')->where(['post.id'=>'5501'])->all();
        //die(var_dump(Post::find()->innerJoinWith('termRelationships')->innerJoinWith('categoryTaxonomies')->innerJoinWith('categoryTerms')->select('post.*, post_term.name, post_term.slug')->where(['post.id'=>'5501'])->all()->createCommand()->queryAll()));
        //die(var_dump(Post::find()->innerJoinWith('categoryTaxonomies')->innerJoin('post_term','term_id=post_term.id')->select('post.*, post_term.name, post_term.slug')->where(['post.id'=>'5501'])->createCommand()->rawSql));
        //die(var_dump(Post::findOne('5501')->tags[0]->getPostTerm()->createCommand()->rawSql));


        $this->layout = 'frontend';
        Yii::$app->assetManager->bundles['yii\bootstrap\BootstrapAsset'] = false;
        Yii::$app->assetManager->bundles['yii\web\JqueryAsset'] = false;
        Yii::$app->assetManager->bundles['yii\web\YiiAsset'] = false;
        return $this->render('index');
    }

    public function actionTrack()
    {
        $this->layout = 'frontend';

        $model = new TrackForm();
        $shipment = null;

        if(Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) && $model->validate()){

//            $shipment = @ShipmentCodeSearch::findOne(array('code'=>Yii::$app->request->post('TrackForm')['code'], 'delete_time'=>null))->shipment;

            $shipments = (new ShipmentSearch)->search(array('ShipmentSearch'=>array('marking_code'=>Yii::$app->request->post('TrackForm')['code'])));

            if($shipments && !$shipments->getCount())
                $shipments = (new ShipmentSearch)->search(array('ShipmentSearch'=>array('resi'=>Yii::$app->request->post('TrackForm')['code'])));

            if(!$shipments || !$shipments->getCount()) $shipment = false;
            else{
                $shipment = $shipments->query->orderBy(['update_time' => SORT_DESC])->one();
            }

        }

        Yii::$app->assetManager->bundles['yii\bootstrap\BootstrapAsset'] = false;
        Yii::$app->assetManager->bundles['yii\web\JqueryAsset'] = false;
//        Yii::$app->assetManager->bundles['yii\web\YiiAsset'] = false;
        return $this->render('track',compact('model','shipment'));
    }

    /*public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }*/

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    // HACK dirty css
    public function actionContact_us()
    {
        $model = new ContactForm;
        $this->layout = 'frontend';
        Yii::$app->assetManager->bundles['yii\bootstrap\BootstrapAsset'] = false;
        Yii::$app->assetManager->bundles['yii\web\JqueryAsset'] = false;
        Yii::$app->assetManager->bundles['yii\web\YiiAsset'] = false;
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->redirect(['site/contact_us']);
        }
        return $this->render('contact_us', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        $this->layout = 'frontend';
        Yii::$app->assetManager->bundles['yii\bootstrap\BootstrapAsset'] = false;
        Yii::$app->assetManager->bundles['yii\web\JqueryAsset'] = false;
        Yii::$app->assetManager->bundles['yii\web\YiiAsset'] = false;
        return $this->render('about');
    }
}
