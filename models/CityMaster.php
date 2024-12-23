<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "city_master".
 *
 * @property int $ID
 * @property string $Name
 * @property string $CountryCode
 * @property string $District
 * @property int $Population
 *
 * @property CountryMaster $countryCode
 */
class CityMaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master_city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 35],
            [['state_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'state_id' => 'State',
        ];
    }

    public static function getAllCities() {
        $models = self::find()->cache(0)->select(['id', 'name'])->all();
        $finalData = [];
        foreach ($models as $model) {
            $finalData[$model->id] = $model->name;
        }
        return $finalData;
    }

    public static function getCityById($id) {
       $allCities = self::getAllCities();
       if (!empty($allCities[$id])) {
           return $allCities[$id];
       }
       return "NA";
    }

}
