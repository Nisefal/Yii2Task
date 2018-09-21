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
    public static function GetGoodsOfCategory($name)
    {
        $sql_goods = "SELECT image_path as path, description, brand_name, products.name, category_name as cname FROM
                  (
                    (
                      categories INNER JOIN category_products ON categories.category_id=category_products.category_id
                    )
                    INNER JOIN products ON products.product_id=category_products.product_id 
                  )
                  INNER JOIN images ON products.product_id=images.product_id
                  WHERE category_name=".$name;
        return Yii::$app->db->createCommand($sql_goods)->queryAll();
    }

    public static function GetCategoriesNames()
    {
        $sql_categories = "SELECT category_name FROM category";
        return Yii::$app->db->createCommand($sql_categories)->queryAll();
    }

    public static function WriteGoodBlock($name, $brand, $description, $product_id, $category)
    {
        echo "<div class='good'>";
        echo "<table>";

        $paths = \app\adapters\Image::GetImagesPathById($product_id);
        $amount = count($paths);
        for ($i=1; $i<=$amount; $i++)
            echo "<col width='200'>";
            echo "<tr>";
        for ($i = 0; $i < $amount; $i++) {
            echo "<td class='col-image'><img width='200' src=\"/images" . $paths[$i]['image_path'] . "\"> </td>";
        }
        echo "</tr>";
        echo "</table>";
        echo "<p>Name: ".$name."</p><br>";
        echo "<p>Brand: ".$brand."</p><br>";
        echo "<br>";
        echo "<p>Description: ".$description."</p><br>";
        echo "</div>";
    }
}