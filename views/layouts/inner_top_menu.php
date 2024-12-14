<?php

namespace uims\employee\modules\employee\models;

use uims\core\modules\core\helper\StatusHelper;
use uims\core\modules\core\models\EmploymentNature;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use function array_key_exists;
use function json_decode;
use function print_r;
use function var_dump;
use const SORT_ASC;

/**
 * This is the model class for table "ems_masters".
 *
 * @property int $id
 * @property string $master_name
 * @property string|null $item_id
 * @property string|null $item_name
 * @property string|null $item_desc
 * @property string|null $item_data
 * @property string|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property string $updated
 */
class EmsMasters extends ActiveRecord
{

    const ACTIVE = 'ACTIVE';
    const INACTIVE = 'INACTIVE';

    const MASTER_NAME_FOR_EMPLOYEE_CATEGORY = 'employee-category';
    const MASTER_NAME_FOR_TRAVEL_REASON = 'employee-travel-reason';
    const MASTER_NAME_FOR_TRAVEL_PURPOSES = 'employee-travel-purposes';
    const MASTER_NAME_FOR_SUBJECT_SPECIALIZATION = 'employee-subject-specialization';
    const MASTER_NAME_FOR_SOCIAL_CATEGORY = 'social-category';
    const MASTER_POST_SANCTION_AUTHORITY = 'post-sanction-authority';
    const MASTER_POST_ALLOTMENT_AUTHORITY = 'post-allotment-authority';
    const MASTER_NATURE_OF_WORK = 'nature_of_work';
    const MASTER_IMPACT_FACTOR_AGENCY = 'impact-factor-agency';
    const MASTER_NOTIFICATION_CATEGORY = 'notification-category';
    const MASTER_SEPARATION_REASON_TYPE = 'separation_reason_type';
    const MASTER_NATURE_OF_EMPLOYMENT = 'nature_of_employment';
    const MASTER_NATURE_OF_DISABILITY = 'nature_of_disability';
    const MASTER_EO_TYPE = 'eo_type';

    const MASTER_EMAIL_TEMPLATE = 'email-template';
    const EMAIL_TEMPLATE_LIFECYCLE_INFORMATION = 'Lifecycle Information';

    const CONFIG_ADMIN_WORKFLOW = 'admin-workflow';
    const CONFIG_WORKFLOW_TOGGLE = 'Workflow-toggle';
    const CONFIG_HRMIS_CHECK = 'HRMIS-check';

    const SETTING_HRMIS_SETTINGS = 'hrmis-setting';
    const UPDATE_DISABLED_YES = 1;
    const UPDATE_DISABLED_NO = 0;
    const EMPLOYEE_CATEGORY_ITEM_DATA = 2;
    const EMPLOYEE_TRAVEL_REASON_ITEM_DATA = 3;
    const EMPLOYEE_TRAVEL_PURPOSES_ITEM_DATA = 4;
    const EMPLOYEE_SUBJECT_SPECIALIZATION_ITEM_DATA = 5;
    const EMPLOYEE_SOCIAL_CATEGORY_ITEM_DATA = 6;
    public const COLORS = [
        '#6B84F7' => 'Blue',
        '#6c757d' => 'Grey',
        '#28a745' => 'Green',
        '#dc3545' => 'Red',
        '#eaaf00' => 'Yellow',
        '#17a2b8' => 'Teal',
        '#343a40' => 'Dark',
        '#FF1493' => 'Pink',
        '#C71585' => 'Violet',
        '#8B4513' => 'Brown',
    ];


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ems_masters';
    }

    public static function getNotificationTagColor($tagName)
    {
        $tagInfo = self::find()->select('additional_field')->where(['master_name' => self::MASTER_NOTIFICATION_CATEGORY, 'item_name' => $tagName])->one();

        if (!empty($tagInfo->additional_field)) {
            return $tagInfo->additional_field;
        } else {
            return '#FFFFFF';
        }
    }

    public static function workflowMasterToggleCheck($sectionName)
    {
        $model = self::find()->cache(7200)->where(['master_name' => 'Workflow-toggle', 'item_id' => $sectionName])->one();
        if ($model) {
            if ($model->item_data == 1) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public static function getMasterConfigItemData($masterName, $itemId)
    {
        $model = self::find()->where(['master_name' => $masterName, 'item_id' => $itemId])->one();
        if ($model) {
            if ($model->item_data == 1) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public static function getWorkflowToggleMaster()
    {
        $data = self::find()->select(['id', 'item_id', 'item_name', 'item_data', 'status'])->where(['master_name' => 'Workflow-toggle', 'status' => StatusHelper::STATE_ACTIVE])->asArray()->all();
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    public static function getEmployeeCategoryMaster()
    {
        $data = self::find()->select(['id', 'master_name', 'item_id', 'item_name as name', 'item_data', 'status'])->where(['master_name' => 'employee-category', 'status' => 'ACTIVE'])->asArray()->all();
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    public static function getStatus()
    {
        return [self::ACTIVE => 'Active', self::INACTIVE => 'In-Active'];
    }

    /*
     *
     * */

    public static function getCategoriesStr()
    {
        $categories = [];
        $models = self::find()->cache(7200)->where(['master_name' => self::MASTER_NAME_FOR_SOCIAL_CATEGORY, 'status' => StatusHelper::STATE_ACTIVE])->asArray()->all();
        if (!empty($models)) {
            $categories = ArrayHelper::map($models, 'item_id', 'item_name');
        }
        return $categories;
    }

    public static function resolveCategoryIdByName($categoryName)
    {
        $categories = [];
        $models = self::find()->cache(7200)->where(['master_name' => self::MASTER_NAME_FOR_SOCIAL_CATEGORY, 'status' => StatusHelper::STATE_ACTIVE])->orderBy(['item_data' => SORT_ASC])->asArray()->all();
        if (!empty($models)) {
            $categories = ArrayHelper::map($models, 'item_name', 'item_data');
        }
        if (array_key_exists($categoryName, $categories)) {
            return $categories[$categoryName];
        }
        return 1;
    }

    public static function resolveCategoryNameById($id)
    {
        if (array_key_exists($id, self::getCategoriesInt())) {
            return self::getCategoriesInt()[$id];
        } else {
            return '';
        }
    }

    public static function getCategoriesInt()
    {
        $categories = [];
        $models = self::find()->cache(7200)->where(['master_name' => self::MASTER_NAME_FOR_SOCIAL_CATEGORY, 'status' => StatusHelper::STATE_ACTIVE])->orderBy(['item_data' => SORT_ASC])->asArray()->all();
        if (!empty($models)) {
            $categories = ArrayHelper::map($models, 'item_data', 'item_name');
        }
        return $categories;
    }

    public static function getSubjectSpecialization()
    {
        $subjectSpecializations = [];
        $models = self::find()->cache(7200)->where(['master_name' => self::MASTER_NAME_FOR_SUBJECT_SPECIALIZATION, 'status' => StatusHelper::STATE_ACTIVE])->asArray()->all();
        if (!empty($models)) {
            $subjectSpecializations = ArrayHelper::map($models, 'item_id', 'item_name');
        }
        return $subjectSpecializations;
    }

    public static function getAuthorityType()
    {
        return [
            self::MASTER_POST_SANCTION_AUTHORITY => 'Sanction Autority',
            self::MASTER_POST_ALLOTMENT_AUTHORITY => 'Allotment Authority'
        ];
    }

    public static function getMasterData($master, $status = 'ACTIVE')
    {
        $masterData = [];
        $models = self::find()->where(['master_name' => $master, 'status' => $status])->asArray()->all();
        if (!empty($models)) {
            $masterData = ArrayHelper::map($models, 'item_id', 'item_name');
        }
        return $masterData;
    }

    public static function getMasterJsonData($master)
    {
        $masterData = [];
        $models = self::find()->select(['item_json'])->where(['master_name' => $master])->asArray()->one();
        if (!empty($models)) {
            $masterData = json_decode($models['item_json']);
        }
        return $masterData;
    }

    public static function getConfigValue($configConst, $status = 'ACTIVE')
    {
        $configValue = 0;
        $model = self::find()->where(['master_name' => $configConst, 'status' => $status])->one();
        if ($model) {
            $configValue = $model->item_data;
        }
        return $configValue;

    }

    public static function getContrastYIQ($hexcolor)
    {
        $hexcolor = str_replace("#", "", $hexcolor);
        $r = hexdec(substr($hexcolor, 0, 2));
        $g = hexdec(substr($hexcolor, 2, 2));
        $b = hexdec(substr($hexcolor, 4, 2));
        $yiq = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;
        return ($yiq >= 128) ? 'black' : 'white';
    }


    // test this function in both php 7.4 and 8.2
    public static function getSeparationTypeByReason($reason)
    {
        // getting all the reasons of saperation
        $reaons = Profile::getReasonsOfEvent(9);
        if (array_key_exists($reason, $reaons)) {
            $separation = self::find()->cache(0)->select(['item_json'])->where(['master_name' => self::MASTER_SEPARATION_REASON_TYPE])->asArray()->one();
            if (isset($separation['item_json'])) {
                var_dump($separation);
                $typeObj = json_decode($separation['item_json']);
                return $typeObj->{$reason};
            }
        }
        return null;
    }

    public static function getEventType()
    {
        return [
            'Temporary' => 'Temporary',
            'Permanent' => 'Permanent'
        ];
    }


    public static function getJsonMasters($masterConstant)
    {
        $model = self::find()->cache(0)->select(['item_json'])->where(['master_name' => $masterConstant])->asArray()->one();
        $data = [];
        if (!empty($model)) {
            $natureData = json_decode($model['item_json']);
            $finalData = [];
            foreach ($natureData as $item) {
                $finalData[$item->item_id] = $item->name;
            }
            return $finalData;
        }
        return [];
    }

    public static function getEmailTemplate($templateId)
    {
        $data = '';
        $masterRecord = self::find()->where(['master_name' => self::MASTER_EMAIL_TEMPLATE, 'item_id' => $templateId])->asArray()->one();
        if (!empty($masterRecord)) {
            $data = $masterRecord['additional_field'];
        }
        return $data;
    }

    public function setMasterData($data, $keyToSearch, $valueToSet) {
        $itemJson = $this->item_json;
        foreach ($itemJson as $itemKey => &$itemData) {
            if (isset($data[$itemData[$keyToSearch]])) {
                $itemJson[$itemKey][$valueToSet] = $data[$itemData[$keyToSearch]];
            }
        }
        $this->item_json = $itemJson;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['master_name', 'item_name', 'status'], 'required'],
            [['created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['updated', 'additional_field', 'item_json'], 'safe'],
            [['item_data'], 'integer'],
            [['master_name', 'item_id', 'item_name'], 'string', 'max' => 190],
            [['status'], 'string', 'max' => 25],
            [['additional_field'], 'string', 'max' => 500],
            [['item_name'], 'unique', 'message' => 'This Category is already mapped.', 'when' => function ($model) {
                return $model->master_name === 'social-category';
            }],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'master_name' => Yii::t('app', 'Master Name'),
            'item_id' => Yii::t('app', 'Item ID'),
            'item_name' => Yii::t('app', 'Section Name'),
            'item_json' => Yii::t('app', 'Json Data'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }


    // this function takes hex color code, and returns the black or white based on contrast of the provided color

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
