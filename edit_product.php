<?php
require "connect.php";

$id=$_POST['id'];

$name = $_POST['name'];
$price = $_POST['price'];
$sale = $_POST['sale'];
$seller = $_POST['seller'];
$description = $_POST['description'];
$cat = $_POST['cat'];
$imagee=$_FILES['image']['name'];
$old_img = $_POST['old_image'];
if(empty($imagee)){   
    // update data without changing image
    $update = $connect -> query("UPDATE products SET name='$name',price='$price',sale='$sale',seller='$seller',description='$description',image='$old_img' WHERE id='$id'");
    header("location:../products.php");
}else{
    // add new images
    $array=[];
    $num = count($_FILES['image']['name']);
    for($j=0;$j<$num;$j++){
        $image=$_FILES['image']['name'][$j];
        if($_FILES['image']['error'][$j]==0){
            $extenstion = array('jpg','png','jfif','jpeg');
            $image_ex = pathinfo($image,PATHINFO_EXTENSION);
            if(in_array($image_ex,$extenstion)){
                if($_FILES['image']['size'][$j]<=1000000){
                    $new_name = md5(uniqid()).".".$image_ex;
                    move_uploaded_file($_FILES['image']['tmp_name'][$j],"../image/".$new_name);
                    array_push($array,$new_name);
            }else{
            echo"file is too long";
        }
        }else{
            echo"file format unknown";
        }
        }
    }
            $new_img=implode("/",$array);
            $update_product = $connect -> query("UPDATE products SET name='$name',price='$price',sale='$sale',seller='$seller',description='$description',image='$new_img'");
            header("location:../products.php");

            if($update_product){

                $delete_product = $connect -> query("SELECT * FROM products WHERE id='$id'");
                $img_data=$delete_product->fetch_assoc();
                $old_image=$img_data['image'];
                $img_arr=explode("/",$old_image);
                foreach($img_arr as $row_img){
                unlink("../image/".$row_img);
                }
            }
}