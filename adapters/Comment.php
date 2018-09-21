<?php
/**
 * Created by PhpStorm.
 * User: kolya
 * Date: 9/19/2018
 * Time: 9:01 PM
 */
namespace app\adapters;
use yii\db\ActiveRecord;
use yii;

class Comment extends ActiveRecord   //can't find class
{
    public static function tableName()
    {
        return 'comments';
    }

    public static function GetCommentsById($product_id)
    {
        $sql = 'SELECT comment_text, user_name, user_email FROM products INNER JOIN comments ON products.product_id=comments.product_id INNER JOIN users ON comments.user_id=users.user_id WHERE products.product_id ='.$product_id;
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        return $result;
    }

    public static function DisplayComment($comment, $username)
    {
        echo "<h5><p>User ". $username." commented:</p></h5>";
        echo "<p>".$comment."</p>";
        echo "<br>";
    }
}