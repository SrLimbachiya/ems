<?php

namespace app\controllers;

use app\models\Departments;
use components\HelperComponent;
use components\SideBarMenuItems;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class DashboardController extends Controller
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

        $genderRaw = (new \yii\db\Query())
            ->select([
                'gender',
                'COUNT(ems.id) AS count',
            ])->from('employee_records ems')
            ->groupBy('ems.gender')->all();


        $departmentRaw = (new \yii\db\Query())
            ->select([
                'dep.id',
                'name',
                'COUNT(ems.id) AS count',
            ])->from('department_master dep')->leftJoin('employee_records ems', 'ems.department = dep.id')
            ->groupBy('dep.id')
            ->orderBy(['count' => SORT_DESC]);

        $designationRaw = (new \yii\db\Query())
            ->select([
                'dep.id',
                'name',
                'COUNT(ems.id) AS count',
            ])->from('designation_master dep')->leftJoin('employee_records ems', 'ems.designation = dep.id')
            ->groupBy('dep.id')
            ->orderBy(['count' => SORT_DESC])->all();

        // Paginated Data Provider
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $departmentRaw->all(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        // Full Data Provider (for client-side filtering)
        $fullDataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $departmentRaw->all(),
            'pagination' => false, // Disable pagination for full data
        ]);


        $empCount = (new \yii\db\Query())
            ->select([
                'SUM(CASE WHEN ems.status = "Active" THEN 1 ELSE 0 END) AS active_emp',
                'SUM(CASE WHEN ems.status = "Inactive" THEN 1 ELSE 0 END) AS inactive_emp',
                'COUNT(*) AS total_emp',
            ])->from('employee_records ems')
            ->all();
        return $this->render('index',[
            'empCount' => $empCount[0] ?? ['active_emp' => 0, 'inactive_emp' => 0, 'total_emp' => 0],
            'genderData' => $genderRaw ?? [],
            'designationData' => $designationRaw ?? [],
            'departmentData' => $departmentRaw ?? [],
            'dataProvider' => $dataProvider ?? [],
            'fullDataProvider' => $fullDataProvider ?? [],
        ]);
    }

}
