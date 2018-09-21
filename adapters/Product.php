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
use app\models\ProductData;

class Product extends ActiveRecord   //can't find class
{
    public static function tableName()
    {
        return 'products';
    }

    public static function WriteProductOverwievBlock($name, $brand, $description, $product_id, $price, $category)
    {
        echo "<div class='good'>";
        echo "<table>";
        echo "<tr>";
        $path = \app\adapters\Image::GetImagePathById($product_id);
        echo "<td><img width='200' src=\"/images" . $path['image_path'] . "\"> </td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td valign='top'>";
        echo "<p><h4>Category:</h4> ".$category."</p>";
        echo "<p><h4>Name:</h4> ".$name."</p>";
        echo "<p><h4>Price:</h4> ".$price."</p>";
        echo "</td>";

        echo "<td valign='top' width='500'>";
        echo "<p><h4>Description:</h4> ".$description."</p>";
        echo "</td>";
        echo "</tr>";
        echo "</table>";
        echo "</div>";
    }

    /*
     * Returns array like
     * [
     * "path"   - path to firs image occured in DB
     * "description"    -
     * "brand_name"
     * "cname"
     * ]
     */
    public static function GetProductsByCategoryName($name)
    {
        $result = [];
        $sql_goods = "SELECT description, brand_name, products.name, category_name as cname, products.product_id, products.price FROM
                    (
                    (
                      categories INNER JOIN category_products ON categories.category_id=category_products.category_id
                    )
                    INNER JOIN products ON products.product_id=category_products.product_id 
                  )
                  INNER JOIN brands ON products.brand_id = brands.brand_id
                  WHERE category_name='".$name."'";
        $products = Yii::$app->db->createCommand($sql_goods)->queryAll();
        for ($i = 0; $i<count($products); $i++)
        {
            $paths = Image::GetImagesPathById($products[$i]["product_id"]);
            $result[] = new ProductData($products[$i], $paths);
        }
        return $result;
    }

    public static function GetMostCommentedProduct()
    {
        $sql = 'SELECT product_id, product_name, description, brand_name, price, MAX(count_comm) as amount FROM (SELECT count(comments.comment_id) as count_comm FROM comments INNER JOIN products ON comment.product_id=products.product_id GROUP BY products.product_id INNER JOIN brands on products.brand_id=brands.brand_id)';
        $result = Yii::$app->db->createCommand($sql)->queryOne();
        return $result;
    }
}