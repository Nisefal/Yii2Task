<?php
/**
 * Created by PhpStorm.
 * User: kolya
 * Date: 9/19/2018
 * Time: 8:59 PM
 */
namespace app\adapters;

use yii\db\ActiveRecord;
use Yii;
use app\adapters\Image;

class Category extends ActiveRecord   //can't find class
{
    public static function tableName()
    {
        return 'categories';
    }

    //Books::find()
    //    ->joinWith(['reviews'])
    //    ->select(['*', 'COUNT(reviews.*) as cnt'])
    //    ->groupBy('RELATION_FIELD(Example: reviews.book_id)')
    //    ->orderBy(['cnt' => 'DESC'])
    //    ->all();

    //    $var = self::find()
    //        ->joinWith(['category_products'])
    //       ->where(['category_products.category_id' => 'categories.category_id'])
    //       //->joinWith(['products'])
    //        //->where(['products.id_product' => 'category_products.product_id'])
    //        //->groupBy('products.id_product')
    //        //->count('products.id_product')
    //        ->all();

    public function getCategory_products()
    {
        return $this->hasMany(CategoryProduct::className(), ['category_id' => 'category_id']);
    }

    /*
     * returns ["category_name", "ctn"] - amount of goods in category
     */
    public static function getCategoriesWithAmountOfGoods()
    {
        //$var = self::find()
        //    ->joinWith('category_products',true, 'INNER JOIN')
        //    ->where(['categories.category_id' => 'category_products.category_id'])
        //    ->all();
        //return $var;
        $sql = 'SELECT categories.category_name, COUNT(category_products.category_id) as cnt FROM
                  (
                    categories LEFT JOIN category_products ON categories.category_id=category_products.category_id)
                     LEFT JOIN products ON products.product_id=category_products.product_id 
                GROUP BY categories.category_name';
        $response = Yii::$app->db->createCommand($sql)->queryAll();
        return $response;
    }

    public static function WriteCategoryTable()
    {
        echo "<table>
                <col width='150'>
                <col width='20'>
                <tr>
                    <td align='center'><h4>Category</h4></td>
                    <td align='center'><h4>Amount</h4></td>
                </tr>";
        $list = Category::getCategoriesWithAmountOfGoods();
        for ($i = 0; $i < count($list); $i++) {
            echo "<tr>";

            echo "<td class='col-catname' align='left' width='50'>" . $list[$i]["category_name"] . "</td>";
            echo "<td class='col-count' align='center' width='20'>" . $list[$i]["cnt"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    /*
     * Array [
     * "path"- image path
     * "description" - good's description
     * "brand_name" - good's name of brand
     * "name" - name of good (product)
     * "cname" - good's name of category
     * ]
     */

    /*
     * returns array
     * [
     * "cname" - name of category
     * ]
     */
    public static function GetCategoriesNames()
    {
        $sql_categories = "SELECT category_name as cname FROM categories";
        return Yii::$app->db->createCommand($sql_categories)->queryAll();
    }
}