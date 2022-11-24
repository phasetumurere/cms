<?php

if(isset($_GET['post_othor'])){
    $othor=$_GET['post_othor'];
}

?>

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



<?php
                
                $query = "SELECT * FROM posts WHERE post_othor = '$othor' ";
                $allPostsByPhase=mysqli_query($connect,$query);
                while($row=mysqli_fetch_assoc($allPostsByPhase)){
                    $postId=escape($row['post_id']);
                    $postsTitle=escape($row['post_title']);
                    $postsCatId=escape($row['post_cat_id']);
                    $postsOthor=escape($row['post_othor']);
                    $postsDate=escape($row['post_date']);
                    $postsImage=escape($row['post_image']);
                    $postsContent= escape(substr($row['post_content'], 0,50)) ;//will display only first 50 characters 
                    $postsTag=escape($row['post_tag']);
               
                
                ?>

<h2>
                    <a href="post.php?postId=<?php echo $postId?>"><?php echo $postsTitle ?></a>
                </h2>
                <p class="lead">
                   Post by <?php echo $postsOthor ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo 'Posted on'. $postsDate. 'at 17:00 PM' ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $postsImage?>" alt="">
                <hr>
                <p><?php echo $postsContent ?></p>
                <!-- <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a> -->

                <hr>
                <?php }?>
                
                </div>

<!-- Blog Sidebar Widgets Column -->

<?php include "includes/sidebar.php" ?>
</div>
<!-- /.row -->

<hr>

<!-- Footer -->
<?php include "includes/footer.php"?>