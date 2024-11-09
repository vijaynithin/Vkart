<?php

    include('../includes/connect.php');
    if(isset($_POST['insert_catagory'])){
      $catagory_title=$_POST['catagory_title'];

      //select data from database
      $select_query="select * from `catagories` where catagory_title='$catagory_title'";
      $result_select=mysqli_query($con,$select_query);
      $number=mysqli_num_rows($result_select);
      //to check if the catagory is already present
      if($number>0){
        echo "<script>alert('This catagory is present inside the database')</script>";
      }else{
      $insert_query="insert into `catagories` (catagory_title) values ('$catagory_title')";
      $result=mysqli_query($con,$insert_query);
      if($result){
        echo"<script>alert('Catagory has been inserted successfully')</script>";
      }
    }
  }

?>

<h2 class="text-center">Insert catagories</h2>
<form action="" method="post" class="mb-2">
<div class="input-group w-90 mb-2">
    <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
  <input type="text" class="form-control" placeholder="Insert catagories" 
  name="catagory_title" aria-label="Username" aria-describedby="basic-addon1">
</div>
<div class="input-group w-10 mb-2 m-auto">
<input type="submit" class="bg-info border-0 p-2 my-3" placeholder="Insert catagories" 
  name="insert_catagory" value="Insert catagories" >
  
</div>
</form>