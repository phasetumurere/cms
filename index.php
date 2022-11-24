
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

if(isset($_GET['page'])){
    $page = escape($_GET['page']);

}else{
    $page=1;
}
$page1=($page*3)-3;

$query="SELECT * FROM posts";
$postCount=mysqli_query($connect,$query);
$count=mysqli_num_rows($postCount);
$count = ceil($count/3);
// echo $count;

$query="SELECT * FROM posts LIMIT $page1, 3";
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
    $postStatus=$row['post_status'];
   
    if($postStatus == 'published')
    {
    //    echo $count;
    ?>

                <h2>
                    <a href="post.php?postId=<?php echo $postId?>"><?php echo $postsTitle ?></a>
                </h2>
                
                <p class="lead">
                    by <a href="othor.php?post_othor=<?php echo $postsOthor?>"><?php echo $postsOthor ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo 'Posted on'. $postsDate. 'at 17:00 PM' ?></p>
                <hr>
                <a href="post.php?postId=<?php echo $postId?>">
                <img class="img-responsive" src="images/<?php echo $postsImage?>" alt=""></a>
                <hr>
                <p><?php echo $postsContent ?></p>
                <a class="btn btn-primary" href="post.php?postId=<?php echo $postId?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

<?php 
} }
 ?>

                <!-- Second Blog Post -->
                
                <h2>
                    


                <!-- Third Blog Post -->
              



                <!-- Pager -->
               

            </div>

            <!-- Blog Sidebar Widgets Column -->
         <?php include "includes/sidebar.php" ?>

        </div>
<ul class='pager'>

<?php



for($i=1;$i<=$count;$i++){
    
    if($i==$page){
        
        echo "<li><a class='active_link' href='index.php?page=$i'>$i</a></li>";
    }else{
        echo "<li><a href='index.php?page=$i'>$i</a></li>";
    }
}

?>

</ul>   <!-- /.row -->

        <hr>

        <!-- Footer -->
      <?php include "includes/footer.php"?>