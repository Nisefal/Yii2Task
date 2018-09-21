<?php
/**
 * Created by PhpStorm.
 * User: kolya
 * Date: 9/19/2018
 * Time: 9:03 PM
 */
namespace app\adapters;
use yii\db\ActiveRecord;

class User extends ActiveRecord   //can't find class
{
    public static function tableName()
    {
        return 'users';
    }

}