<?php

namespace app\controllers;

use app\models\Departments;
use app\models\Designations;
use app\models\Employee;
use app\models\search\EmployeeSearch;
use components\HelperComponent;
use Faker\Factory;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends Controller
{
    /**
     * @inheritDoc
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
     * Lists all Employee models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new EmployeeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Employee model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Employee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Employee();
        $model->id = HelperComponent::generateId();
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($model->save()) {
                    \Yii::$app->getSession()->setFlash('success', 'Employee created successfully.');
                } else {
                    \Yii::$app->getSession()->setFlash('danger', Html::errorSummary($model));
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Employee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employee::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionGenerateEmployees($count = 100)
    {
        $faker = Factory::create();

        // Loop to create multiple employees
        for ($i = 0; $i < $count; $i++) {
            $employee = new Employee(); // Replace with your actual model class

            // Generate fake employee data for the listed attributes
            $employee->id = HelperComponent::generateId();
            $employee->employee_code = $faker->unique()->numerify('EMP###');
            $employee->first_name = $faker->firstName;
            $employee->middle_name = $faker->optional()->firstName;
            $employee->last_name = $faker->lastName;
            $employee->department = $faker->numberBetween(1, 26); // Adjust department ID range as needed
            $employee->designation = $faker->numberBetween(1, 27); // Adjust designation ID range as needed
            $employee->birth_date = $faker->date('Y-m-d', '2000-01-01');
            $employee->joining_date = $faker->date('Y-m-d', '2020-01-01');
            $employee->retirement_date = $faker->date('Y-m-d', '2050-01-01');
            $employee->gender = $faker->randomElement(['Male', 'Female', 'Other']);
            $employee->category = $faker->randomElement(['General', 'OBC', 'SC', 'ST']);
            $employee->country = $faker->country;
            $employee->state = $faker->state;
            $employee->city = $faker->city;
            $employee->pincode = $faker->postcode;
            $employee->address = $faker->address;
            $employee->phone_no = $faker->phoneNumber;
            $employee->email = $faker->unique()->safeEmail;
            $employee->status = $faker->randomElement(['Active', 'Inactive']);
            $employee->created_at = $faker->unixTime;
            $employee->created_by = $faker->numberBetween(1, 10); // Assuming user IDs between 1 and 10
            $employee->updated_at = $faker->unixTime;
            $employee->updated_by = $faker->numberBetween(1, 10);
            $employee->ip = $faker->ipv4;

            // Save the employee if validation passes
            if ($employee->validate() && $employee->save()) {
                echo "Employee {$employee->first_name} {$employee->last_name} added successfully.\n";
            } else {
                echo "Failed to save employee: " . print_r($employee->errors, true) . "\n";
            }
        }
    }

    public function actionGenerateDepartments($count = 100)
    {
        $departments = [
            'Department of Education',
            'Department of Physical Education',
            'Department of Sahitya',
            'Department of Puranetihasa',
            'Department of English',
            'Department of Telugu',
            'Department of Hindi',
            'Department of Research and Publications',
            'Department of Translation Studies',
            'Department of Performing Arts',
            'Department of Nyaya',
            'Department of Advaita Vedanta',
            'Department of Visistadvaita Vedanta',
            'Department of Dvaita Vedanta',
            'Department of Agama',
            'Department of Mimamsa',
            'Department of Sankhya Yoga',
            'Department of Sabdabodha Systems and Computational Linguistics',
            'Department of Yoga Vijnana',
            'Department of Vyakarana',
            'Department of Jyotisha and Vastu',
            'Department of Dharmasastra',
            'Department of Veda Bhashya',
            'Department of Computer Science',
            'Department of History',
            'Department of Mathematics',
        ]; // 26
        foreach ($departments as $departmentName) {
            $department = new Departments(); // Replace with your actual model class
            $department->name = $departmentName;
            $department->status = 'Active'; // Default status
            $department->created_at = time(); // Current Unix timestamp
            $department->created_by = 1; // Assuming created by user with ID 1 (adjust as needed)
            $department->updated_at = time(); // Current Unix timestamp
            $department->updated_by = 1; // Assuming updated by user with ID 1 (adjust as needed)
            $department->ip = \Yii::$app->request->userIP; // Current IP address

            // Save the department if validation passes
            if ($department->validate() && $department->save()) {
                echo "Department {$department->name} added successfully.\n";
            } else {
                echo "Failed to save department: " . print_r($department->errors, true) . "\n";
            }
        }
    }


    public function actionGenerateDesignations($count = 50)
    {

        $designations = [
            'Professor',
            'Assistant Professor',
            'Associate Professor',
            'Vice-Chancellor',
            'Finance Officer',
            'Controller of Examinations',
            'Head of the Department',
            'Deputy Registrar',
            'Assistant Registrar',
            'Section Officer',
            'Assistant',
            'Deputy Librarian',
            'Assistant Librarian',
            'Information Scientist',
            'Professional Assistant',
            'Library Assistant',
            'Preservation Assistant',
            'Library Attendant',
            'Research Assistant',
            'System Analyst',
            'Junior Engineer',
            'Technical Assistant',
            'Laboratory Technician',
            'Laboratory Assistant',
            'Assistant Engineer'
        ]; //27

        $faker = Factory::create();
        foreach ($designations as $designationName) {
            $designation = new Designations(); // Replace with your actual model class
            // Generate fake department data
            $designation->name = $designationName; // Random job title as designation name
            $designation->status = 'Active'; // Default status
            $designation->created_at = $faker->unixTime; // Random Unix timestamp for created_at
            $designation->created_by = $faker->numberBetween(1, 10); // Assuming user IDs between 1 and 10
            $designation->updated_at = $faker->unixTime; // Random Unix timestamp for updated_at
            $designation->updated_by = $faker->numberBetween(1, 10); // Assuming user IDs between 1 and 10
            $designation->ip = $faker->ipv4; // Random IP address

            // Save the department if validation passes
            if ($designation->validate() && $designation->save()) {
                echo "Department {$designation->name} added successfully.\n";
            } else {
                echo "Failed to save department: " . print_r($designation->errors, true) . "\n";
            }
        }
    }

}
