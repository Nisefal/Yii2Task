<?php
/**
 * Created by PhpStorm.
 * User: kolya
 * Date: 9/19/2018
 * Time: 8:57 PM
 */
namespace app\adapters;

use yii\db\ActiveRecord;

class Brands extends ActiveRecord
{
    public static function tableName()
    {
        return 'brands';
    }

}