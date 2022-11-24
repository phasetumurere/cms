
<?php include "includes/header.php"?>

<!-- Navigation -->
<?php include "includes/navigation.php";?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <!-- First Blog Post -->
<?php 
if(isset($_GET['categoryId'])){
    $postCategoryId=$_GET['categoryId'];
}
$query="SELECT * FROM posts WHERE post_cat_id=$postCategoryId";

$selectAllPosts=mysqli_query($connect,$query);
while($row=mysqli_fetch_assoc($selectAllPosts)){
$postId=$row['post_id'];
$postsTitle=$row['post_title'];
$postsCatId=$row['post_cat_id'];
$postsOthor=$row['post_othor'];
$postsDate=$row['post_date'];
$postsImage=$row['post_image'];
$postsContent= substr($row['post_content'], 0,50) ;//will display only first 50 characters 
$postsTag=$row['post_tag'];

?>


            <h2>
                <a href="post.php?postId=<?php echo $postCategoryId?>"><?php echo $postsTitle ?></a>
            </h2>
            <p class="lead">
                by <a href="post.php?postId=<?php echo $postCategoryId?>"><?php echo $postsOthor ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> <?php echo 'Posted on'. $postsDate. 'at 17:00 PM' ?></p>
            <hr>
            <a href="post.php?postId=<?php echo $postCategoryId?>">Click here</a><img class="img-responsive" src="images/<?php echo $postsImage?>" alt="">
            <hr>
            <p><?php echo $postsContent ?></p>
            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>

<?php }
if($postCategoryId == 0){
    echo "Phase TUMURERE";
} 
?>

            <!-- Second Blog Post -->
            
        

            <!-- Third Blog Post -->
          



            <!-- Pager -->
           

        </div>

        <!-- Blog Sidebar Widgets Column -->
     <?php include "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
  <?php include "includes/footer.php"?>