<?php
    include('../includes\connect.php');
    if(isset($_POST['insert_product'])){

        $product_title=$_POST['product_title'];
        $product_description=$_POST['product_description'];
        $product_keywords=$_POST['product_keywords'];
        $product_catagory=$_POST['product_catagory'];
        $product_brands=$_POST['product_brands'];
        $product_price=$_POST['product_price'];
        
    
        //To access images
        $product_image1=$_FILES['product_image1']['name'];
        $product_image2=$_FILES['product_image2']['name'];
        $product_image3=$_FILES['product_image3']['name'];

        //accessing temporary image names
        $temp_image1=$_FILES['product_image1']['tmp_name'];
        $temp_image2=$_FILES['product_image2']['tmp_name'];
        $temp_image3=$_FILES['product_image3']['tmp_name'];

        $product_status='true';

        //checking empty conditions
        if($product_title=='' or $product_description=='' or $product_keywords=='' or
        $product_catagory=='' or $product_brands=='' or $product_price=='' or
        $product_image1=='' or $product_image2=='' or $product_image3==''){
            echo "<script>alert('Please fill all the fields')</script>";
            exit();
        }else{
            move_uploaded_file($temp_image1,"./product_images/$product_image1");
            move_uploaded_file($temp_image2,"./product_images/$product_image2");
            move_uploaded_file($temp_image3,"./product_images/$product_image3");

            //insert query
            $insert_products="insert into `products` (product_title,product_description,product_keywords,
            catagory_id,brand_id,product_price,product_image1,product_image2,product_image3,date,status)
             values('$product_title','$product_description','$product_keywords','$product_catagory',
             '$product_brands','$product_price','$product_image1','$product_image2',
             '$product_image3',NOW(),'$product_status')";
            $result_query=mysqli_query($con,$insert_products);
            if($result_query){
                echo "<script>alert('Successfully inserted the products')</script>";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert product - Admin dashboard</title>

    <!-- bootstrap CSS link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
    crossorigin="anonymous">

    <!-- font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!--cssfile-->
    <link rel="stylesheet" href="../styles.css">
</head>
<body class="bg-light">
    
        <div class="container mt-3">
            <h1 class="text-center">Insert Products</h1>
            <!--Form-->                             <!--data not related to text-->
            <form action="" method="post" enctype="multipart/form-data">
                    <!--title-->
                    <div class="form-outline mb-4 w-50 m-auto">
                        <label for="product_title" class="form-label">Product Title</label>
                        <input type="text"name="product_title"
                        id="product_title" class="form-control" placeholder="Enter product title" 
                        autocomplete="off" required="required">
                    </div>
                    <!--description-->
                    <div class="form-outline mb-4 w-50 m-auto">
                        <label for="product_description" class="form-label">Product description</label>
                        <input type="text"name="product_description"
                        id="product_description" class="form-control" placeholder="Enter product description" 
                        autocomplete="off" required="required">
                    </div>
                    <!--keyword-->
                    <div class="form-outline mb-4 w-50 m-auto">
                        <label for="product_keywords" class="form-label">Product keyword</label>
                        <input type="text"name="product_keywords"
                        id="product_keywords" class="form-control" placeholder="Enter product keyword" 
                        autocomplete="off" required="required">
                    </div>

                    <!--catagories-->
                    <div class="form-outline mb-4 w-50 m-auto">
                        <select name="product_catagory" id="" class="product_catagory">
                            <option value="">select a catagory</option>
                            
                            <?php
                                $select_query="select * from `catagories`";
                                $result_query=mysqli_query($con,$select_query);
                                while($row=mysqli_fetch_assoc($result_query)){
                                    $catagory_title=$row['catagory_title'];
                                    $catagory_id=$row['catagory_id'];
                                    echo "<option value='$catagory_id'>$catagory_title</option>";
                                }
                            ?>
                            
                            
                        </select>
                    </div>
                    <!--Brands-->
                    <div class="form-outline mb-4 w-50 m-auto p-2">
                        <select name="product_brands" id="" class="form-select">
                            <option value="">select a brand</option>
                            <?php
                                $select_query="select * from `brands`";
                                $result_query=mysqli_query($con,$select_query);
                                while($row=mysqli_fetch_assoc($result_query)){
                                    $brand_title=$row['brand_title'];
                                    $brand_id=$row['brand_id'];
                                    echo "<option value='$brand_id'>$brand_title</option>";
                                }
                            ?>
                            
                        </select>
                    </div>

                     <!--image1-->
                     <div class="form-outline mb-4 w-50 m-auto ">
                        <label for="product_image1" class="form-label">Product image 1</label>
                        <input type="file" name="product_image1"
                        id="product_image1" class="form-control" required="required">
                    </div>
                    <!--image2-->
                    <div class="form-outline mb-4 w-50 m-auto ">
                        <label for="product_image2" class="form-label">Product image2</label>
                        <input type="file" name="product_image2" id="product_image2" class="form-control" 
                        required="required">
                    </div>
                    <!--image3-->
                    <div class="form-outline mb-4 w-50 m-auto ">
                        <label for="product_image3" class="form-label">Product image3</label>
                        <input type="file"name="product_image3"
                        id="product_image3" class="form-control" required="required">
                    </div>

                    <!--price-->
                    <div class="form-outline mb-4 w-50 m-auto">
                        <label for="product_price" class="form-label">Product price</label>
                        <input type="text"name="product_price"
                        id="product_price" class="form-control" placeholder="Enter product price" 
                        autocomplete="off" required="required">
                    </div>
                    <!--submit-->
                    <div class="form-outline mb-4 w-50 m-auto">
                        <input type="submit" name="insert_product" class="btn btn-info mb-3 px-3" value="Insert Products">
                    </div>

            </form>
        </div>


<!--Bootstrap js link-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    
</body>
</html>