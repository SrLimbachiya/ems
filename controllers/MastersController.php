<?php

namespace app\controllers;

use app\models\CityMaster;
use app\models\Departments;
use app\models\Designations;
use app\models\StateMaster;
use components\HelperComponent;
use components\Masters;
use yii\helpers\Json;
use components\SideBarMenuItems;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class MastersController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
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


    public function beforeAction($action) {
        if (!parent::beforeAction($action)) {
            return false;
        }
        if (Yii::$app->user->isGuest) {
            $this->redirect(['/site/login']);
            return false;
        }
        return true;
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $departmentCount = Departments::find()->where(['status' => Masters::STATUS_ACTIVE])->count();
        $designations = Designations::find()->where(['status' => Masters::STATUS_ACTIVE])->count();
        return $this->render('index', ['designations' => $designations, 'departments' => $departmentCount]);
    }


    public function actionDepartments() {
        var_dump('DEPARTMENTS');
    }

    public function actionDesignations() {
        var_dump('DEPARTMENTS');
    }

    public function actionGetState()
    { // this function will get all POSTS from OU
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $country = isset($parents[0]) ? $parents[0] : null;
                $states = StateMaster::find()->where(['country_id' => $country])->asArray()->all();
                if (!empty($states)) {
                    asort($states);
                    foreach ($states as $key => $value) {
                        $out[] = ['id' => $value['id'], 'name' => $value['name']];
                    }
                    return Json::encode(['output' => $out, 'selected' => '']);
                } else {
                    return Json::encode(['output' => $out, 'selected' => 'NOT FOUND']);
                }
            }
        }
        return Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionGetCity()
    { // this function will get all POSTS from OU
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $state = isset($parents[0]) ? $parents[0] : null;
                $cities = CityMaster::find()->where(['state_id' => $state])->asArray()->all();
                if (!empty($cities)) {
                    asort($cities);
                    foreach ($cities as $key => $value) {
                        $out[] = ['id' => $value['id'], 'name' => $value['name']];
                    }
                    return Json::encode(['output' => $out, 'selected' => '']);
                } else {
                    return Json::encode(['output' => $out, 'selected' => 'NOT FOUND']);
                }
            }
        }
        return Json::encode(['output' => '', 'selected' => '']);
    }

}
