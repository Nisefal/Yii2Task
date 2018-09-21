<?php
/**
 * Created by PhpStorm.
 * User: kolya
 * Date: 9/19/2018
 * Time: 8:57 PM
 */
namespace app\adapters;

use yii\db\ActiveRecord;
use yii;

class Brands extends ActiveRecord
{
    public static function tableName()
    {
        return 'brands';
    }

    /*
    * returns ["brand_name", "ctn"] - amount of comments to products of brand
    */
    public static function GetAmountCommentsToBrand()
    {
        $sql = 'SELECT brands.brand_name, COUNT(comments.comment_id) as cnt FROM                  
                    brands LEFT JOIN products ON brands.brand_id=products.brand_id
                      LEFT JOIN comments ON products.product_id=comments.product_id 
                GROUP BY brands.brand_id';
        $response = Yii::$app->db->createCommand($sql)->queryAll();
        return $response;
    }

    public static function DisplayBrandsWithAmountComments()
    {
        echo "<table>
                <col width='150'>
                <col width='20'>
                <tr>
                    <td align='center'><h4>Brand</h4></td>
                    <td align='center'><h4>Amount of comments</h4></td>
                </tr>";
        $list = Brands::GetAmountCommentsToBrand();
        for ($i = 0; $i < count($list); $i++) {
            echo "<tr>";

            echo "<td class='col-catname' align='left' width='50'>" . $list[$i]["brand_name"] . "</td>";
            echo "<td class='col-count' align='center' width='20'>" . $list[$i]["cnt"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}