<?php
        //including connect file
        include('./includes/connect.php');
        

        //getting products
        function getproducts(){
            global $con;
         // condition to check isset or not :
            if(!isset($_GET['catagory'])){
                if(!isset($_GET['brand'])){
            $select_query="Select * from `products` order by rand() LIMIT 0,9";
            $result_query=mysqli_query($con,$select_query);
                   
                    while($row=mysqli_fetch_assoc($result_query)){
                        $product_id=$row['product_id'];
                        $product_title=$row['product_title'];
                        $product_description=$row['product_description'];
                        $product_image2=$row['product_image2'];
                        $product_price=$row['product_price'];
                        $catagory_id=$row['catagory_id'];
                        $brand_id=$row['brand_id'];
                
                        echo "<div class='col-md-4 mb-2'>
                        <div class='card'>
                            <img  src='./admin_area/product_images/$product_image2' class='card-img-top' alt='$product_title' >
                            <div class='card-body'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'>$product_description.</p>
                            <h6 class='card-title'>RS- $product_price /-</h6>
                            <a href='#' class='btn btn-info'>add to cart</a>
                            <a href='#' class='btn btn-secondary'>view more</a>
                        </div>
                        </div> 
                        </div>";                      
                }
        }
    }}


// getting unique catagories
function get_unique_catagories(){
    global $con;
 // condition to check isset or not :
    if(isset($_GET['catagory_id'])){
        $catagory_id=$_GET['catagory_id'];
    $select_query="Select * from `products` where catagory_id=$catagory_id";
    $result_query=mysqli_query($con,$select_query);
           
            while($row=mysqli_fetch_assoc($result_query)){
                $product_id=$row['product_id'];
                $product_title=$row['product_title'];
                $product_description=$row['product_description'];
                $product_image2=$row['product_image2'];
                $product_price=$row['product_price'];
                $catagory_id=$row['catagory_id'];
                $brand_id=$row['brand_id'];
        
                echo "<div class='col-md-4 mb-2'>
                <div class='card'>
                    <img  src='./admin_area/product_images/$product_image2' class='card-img-top' alt='$product_title' >
                    <div class='card-body'>
                    <h5 class='card-title'>$product_title</h5>
                    <p class='card-text'>$product_description.</p>
                    <h6 class='card-title'>RS- $product_price /-</h6>
                    <a href='#' class='btn btn-info'>add to cart</a>
                    <a href='#' class='btn btn-secondary'>view more</a>
                </div>
                </div> 
                </div>";                      
        }
}
}

        // displaying brands in side nav 
        function getbrands(){
            global $con;

                $select_brands="select * from brands";
                $result_brands=mysqli_query($con,$select_brands);                    
                
                while($row_data=mysqli_fetch_assoc($result_brands)){
                      $brand_title=$row_data['brand_title'];
                      $brand_id=$row_data['brand_id'];
                      echo "<li class='nav-item text-center'>
                      <a href='#index.php?brand=$brand_id' class='nav-link text-light'>$brand_title</a>
                  </li>";
                    }

        }

        // displaying catagories in side nav
        function getcatagories(){
            global $con;

            $select_catagories="select * from `catagories`";
            $result_catagories=mysqli_query($con,$select_catagories);
            
            while($row_data=mysqli_fetch_assoc($result_catagories)){
              $catagory_title=$row_data['catagory_title'];
              $catagory_id=$row_data['catagory_id'];
              echo "<li class='nav-item text-center'>
              <a href='#index.php?catagory=$catagory_id' class='nav-link text-light'>$catagory_title</a>
          </li>";
            }
        }
    ?>