<?php
/**
 * Created by PhpStorm.
 * User: kolya
 * Date: 9/19/2018
 * Time: 9:02 PM
 */
namespace app\adapters;
use yii\db\ActiveRecord;
use yii;

class Image extends ActiveRecord   //can't find class
{
    public static function tableName()
    {
        return 'images';
    }

    public static function GetImagesPathById($product_id)
    {
        $sql_amount = "SELECT image_path FROM images WHERE product_id=".$product_id;
        return Yii::$app->db->createCommand($sql_amount)->queryAll();
    }

    public static function GetImagePathById($product_id)
    {
        $sql_amount = "SELECT image_path FROM images WHERE product_id=".$product_id;
        return Yii::$app->db->createCommand($sql_amount)->queryOne();
    }

}