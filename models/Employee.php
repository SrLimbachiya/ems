<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "your_table_name".
 *
 * @property int $id
 * @property string|null $employee_code
 * @property string|null $first_name
 * @property string|null $middle_name
 * @property string|null $last_name
 * @property string|null $type
 * @property int|null $department
 * @property int|null $designation
 * @property string|null $birth_date
 * @property string|null $joining_date
 * @property string|null $retirement_date
 * @property string|null $gender
 * @property string|null $category
 * @property string|null $country
 * @property string|null $state
 * @property string|null $city
 * @property string|null $pincode
 * @property string|null $address
 * @property string|null $phone_no
 * @property string|null $email
 * @property string|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property string|null $ip
 */
class Employee extends ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee_records';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'type', 'employee_code', 'department', 'designation','last_name', 'gender', 'category', 'country', 'state', 'city', 'status', 'birth_date', 'joining_date'], 'required'],
            [['department', 'designation', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['employee_code', 'first_name', 'middle_name', 'last_name', 'gender', 'category', 'country', 'state', 'city', 'status'], 'string', 'max' => 50],
            [['retirement_date','birth_date', 'joining_date'], 'string', 'max' => 50],
            [['pincode', 'status'], 'string', 'max' => 10],
            [['address'], 'string', 'max' => 500],
            [['phone_no'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 80],
            [['ip'], 'string', 'max' => 20],
            [['email'], 'email'],
            [['employee_code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_code' => 'Employee Code',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'department' => 'Department',
            'designation' => 'Designation',
            'birth_date' => 'Birth Date',
            'joining_date' => 'Joining Date',
            'retirement_date' => 'Retirement Date',
            'gender' => 'Gender',
            'category' => 'Category',
            'country' => 'Country',
            'state' => 'State',
            'city' => 'City',
            'pincode' => 'Pincode',
            'address' => 'Address',
            'phone_no' => 'Phone No',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'ip' => 'IP',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(), //BlameableBehavior automatically fills the specified attributes with the current user ID.
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }
}
