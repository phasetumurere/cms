<?php session_start()?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">HOME</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php   
                             
                $selectAllNavigation="SELECT * FROM categories";
                $query=mysqli_query($connect,$selectAllNavigation);
                while($row=mysqli_fetch_assoc($query)){
                    $catTitle = escape($row['cat_title']);
                    $catId= escape($row['cat_id']);
                    ?>
                    <ul class="nav navbar-nav">
                   <?php echo "<li><a href='./category.php?categoryId=$catId'> $catTitle</a></li>";
                }
                ?>
                <li><a href="admin">Admin</a></li>
                <li><a href="registration.php">Registration</a></li>
                   

<?php
if(isset($_SESSION['username'])){
    if(isset($_GET['postId'])){
        $postId=$_GET['postId'];
        echo "<li><a href='admin/posts.php?source=editPost&postId=$postId'>EditPost</a></li> ";
        }
   
    }else{
        echo "SESSION NOT STARTED";
    }

?>   
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>