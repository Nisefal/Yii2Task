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
    public static function GetProductsByCategoryName($name, $id=null)
    {
        $result = [];
        if ($id==null)
            $sql_goods = "SELECT description, brand_name as bname, products.name, category_name as cname, products.product_id, products.price FROM
                    (
                    (
                      categories INNER JOIN category_products ON categories.category_id=category_products.category_id
                    )
                    INNER JOIN products ON products.product_id=category_products.product_id 
                  )
                  INNER JOIN brands ON products.brand_id = brands.brand_id
                  WHERE category_name='".$name."'";
        else
            $sql_goods = "SELECT description, brand_name as bname, products.name, category_name as cname, products.product_id, products.price FROM
                    (
                    (
                      categories INNER JOIN category_products ON categories.category_id=category_products.category_id
                    )
                    INNER JOIN products ON products.product_id=category_products.product_id 
                  )
                  INNER JOIN brands ON products.brand_id = brands.brand_id
                  WHERE category_name='".$name."' AND products.product_id<>".$id;
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
        $sql = 'SELECT product_id, pname, description, bname, price, cname, MAX(count_comm) as amount FROM (
					 SELECT products.product_id, name as pname, description, brand_name as bname, price, category_name as cname, count(comments.comment_id) as count_comm 
                   FROM 
                   comments INNER JOIN products ON comments.product_id=products.product_id
                            INNER JOIN brands on products.brand_id=brands.brand_id
                            INNER JOIN category_products on products.product_id=category_products.product_id
                            INNER JOIN categories on categories.category_id=category_products.category_id
                   GROUP BY products.product_id
                   ) as tab
                   GROUP BY product_id
                   ORDER BY amount DESC';
        $result = Yii::$app->db->createCommand($sql)->queryOne();
        return ["product" => $result, "comments" => Comment::GetCommentsById($result["product_id"])];
    }

    public static function DisplayMostCommentedProduct()
    {
        $product = Product::GetMostCommentedProduct();
        $name = $product["product"]["name"];
        $brand = $product["product"]["bname"];
        $descript = $product["product"]["description"];
        $id = $product["product"]["product_id"];
        $categ = $product["product"]["cname"];
        $price = $product["product"]["price"];
        echo "<h4>The most commented product:</h4>";
        Product::WriteProductOverwievBlock($name,$brand,$descript,$id,$price,$categ);
        echo "<br>";
        for ($i =0; $i<count($product["comments"]); $i++)
        {
            $comentator = $product["comments"][$i]["user_name"];
            $text = $product["comments"][$i]["comment_text"];
            Comment::DisplayComment($text, $comentator);
        }

    }

    public static function DisplayMostCommentedProductWithRandom()
    {
        $product = Product::GetMostCommentedProduct();
        $name = $product["product"]["name"];
        $brand = $product["product"]["bname"];
        $descript = $product["product"]["description"];
        $id = $product["product"]["product_id"];
        $categ = $product["product"]["cname"];
        $price = $product["product"]["price"];
        echo "<h4>The most commented product:</h4>";
        Product::WriteProductOverwievBlock($name,$brand,$descript,$id,$price,$categ);
        echo "<br>";
        for ($i =0; $i<count($product["comments"]); $i++)
        {
            $comentator = $product["comments"][$i]["user_name"];
            $text = $product["comments"][$i]["comment_text"];
            Comment::DisplayComment($text, $comentator);
        }

        $products = Product::GetProductsByCategoryName($categ, $id);
        $first = rand(1,count($products)-1);
        $second = 0;
        do{
            $second = rand(0,count($products)-1);
        } while($second==$first);

        $name = $products[$first]->product_info["name"];
        $brand = $products[$first]->product_info["bname"];
        $descript = $products[$first]->product_info["description"];
        $id = $products[$first]->product_info["product_id"];
        $categ = $products[$first]->product_info["cname"];
        $price = $products[$first]->product_info["price"];
        Product::WriteProductOverwievBlock($name,$brand,$descript,$id,$price,$categ);

        $name = $products[$second]->product_info["name"];
        $brand = $products[$second]->product_info["bname"];
        $descript = $products[$second]->product_info["description"];
        $id = $products[$second]->product_info["product_id"];
        $categ = $products[$second]->product_info["cname"];
        $price = $products[$second]->product_info["price"];
        Product::WriteProductOverwievBlock($name,$brand,$descript,$id,$price,$categ);
    }
}