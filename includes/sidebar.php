<div class="col-md-4">


<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
    <form action="search.php" method="post">
    <div class="input-group">
        <input type="text" class="form-control" name="postTag">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit" name="search">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div>
    </form>
    <!-- /.input-group -->
</div>

<div class="well">
    <h4>Login</h4>
    <form action="includes/login.php" method="post">
    <div class="form-group">
    <input type="text" class="form-control" name="userName" placeholder="Enter username">
     </div>  
     
     <div class="form-group">
    <input type="password" class="form-control" name="password" placeholder="Inter password">
    <!-- <span class="input-group-btn">
         <button class="btn btn-primary" name="login" type="submit">Login</button>
    </span> -->

     </div>  
     <div class="form-group"> 
        <input type="submit" class="btn btn-primary" name="login" value="LOGIN">
     </div>      
    
    </form>
    <!-- /.input-group -->
</div>



<!-- Blog Categories Well -->
<div class="well">
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-6">
            <ul class="list-unstyled">
     <?php
     
$query= "SELECT * FROM categories";// LIMIT 3: For limitting the categories to certain number
$allCategories=mysqli_query($connect,$query);
if(!$allCategories){
    die("damn".mysqli_error($connect));
}
while($row=mysqli_fetch_assoc($allCategories)){
    $catId=$row['cat_id'];
    $catTitle=$row['cat_title'];
    echo "<li><a href='./category.php?categoryId=$catId'>$catTitle </a></li>";

 }

?>
                <!-- <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li> -->
            </ul>
        </div>
        <!-- /.col-lg-6 -->
        <div class="col-lg-6">
            <ul class="list-unstyled">
                <li><a href="#">Category Name</a>
                
            </ul>
        </div>
        <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<?php include "widget.php" ?>
</div>