<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "country_master".
 *
 * @property string $Code
 * @property string $Name
 * @property string $Continent
 * @property string $Region
 * @property float $SurfaceArea
 * @property int|null $IndepYear
 * @property int $Population
 * @property float|null $LifeExpectancy
 * @property float|null $GNP
 * @property float|null $GNPOld
 * @property string $LocalName
 * @property string $GovernmentForm
 * @property string|null $HeadOfState
 * @property int|null $Capital
 * @property string $Code2
 *
 * @property CityMaster[] $cityMasters
 */
class CountryMaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master_countries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'shortname'], 'string', 'max' => 35],
            [['phonecode'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'shortname' => 'Short name',
        ];
    }


    public static function getAllCountries() {
        $models = self::find()->cache(0)->select(['id', 'name'])->all();
        $finalData = [];
        foreach ($models as $model) {
            $finalData[$model->id] = $model->name;
        }
        return $finalData;
    }

    public static function getCountryById($id) {
        $allCities = self::getAllCountries();
        if (!empty($allCities[$id])) {
            return $allCities[$id];
        }
        return "NA";
    }

}
