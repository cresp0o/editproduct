<?php 
$id=$_GET['id'];
$select_product = $connect -> query("SELECT * FROM products WHERE id='$id'");
$row_product = $select_product -> fetch_assoc();
?>
<form method="post" action="functions/edit_product.php" enctype='multipart/form-data'>
    <input type="hidden" name="id" value="<?php echo$row_product['id']?>">
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input name="name" value="<?php echo$row_product['name'];?>" type="text" class="form-control" placeholder="Enter product Name">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">price</label>
    <input type="number" name="price" value="<?php echo$row_product['price'];?>" class="form-control" placeholder="Enter product price">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">sale</label>
    <input type="number" name="sale" value="<?php echo$row_product['sale'];?>" class="form-control" placeholder="Enter price sale">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">seller</label>
    <input type="text" name="seller" value="<?php echo$row_product['seller'];?>" class="form-control" placeholder="Enter product seller name">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">description</label>
    <input type="text" name="description" value="<?php echo$row_product['description'];?>" class="form-control" placeholder="Enter product description">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">image</label>
    <input type="file" name="image[]" multiple>
    <input type="hidden" name="old_image" value="<?php echo$row_product['image'];?>">
  </div>
  <div class="form-group">
  <label for="cars">Select Category:</label>

  <select name="cat" class="form-control" >
    <?php 
    $select_cat = $connect -> query("SELECT * FROM category");
    foreach($select_cat as $row_cat){
    ?>
      <option value="<?php $cat=$row_product['category'];
  if($cat){echo'selected';}?>"><?php echo$row_cat['type']?></option>
     <?php } ?>
  </select>
</div>
<input type="submit" name="submit" class="btn btn-primary" value="Submit">
</form>
