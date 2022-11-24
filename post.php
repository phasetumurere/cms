
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

if(isset($_GET['postId'])){
    $individualPostId=$_GET['postId'];
    $query = "UPDATE posts SET post_views = post_views + 1 WHERE post_id = $individualPostId";
    $updatePostViews = mysqli_query($connect,$query);
    if(!$updatePostViews){
        die("query failed".mysqli_error($connect));
    }
 
$query="SELECT * FROM posts WHERE post_id = $individualPostId";
$selectIndividualPost=mysqli_query($connect,$query);
while($row=mysqli_fetch_assoc($selectIndividualPost)){
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
                    <a href=""><?php echo $postsTitle ?></a>
                </h2>
                <p class="lead">
                    by <a href="othor.php?post_othor=<?php echo $postsOthor?>"><?php echo $postsOthor ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo 'Posted on'. $postsDate. 'at 17:00 PM' ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $postsImage?>" alt="">
                <hr>
                <p><?php echo $postsContent ?></p>
                <!-- <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a> -->

                <hr>

<?php 
}
}
?>

                <!-- Second Blog Post -->
                
         

<?php 

    if(isset($_POST['submit_comment'])){

        $othorName=escape($_POST['othor_name']);
        $comment=escape($_POST['comment']);
        $othorEmail=escape($_POST['comment_email']);
        $commentPostId=$_GET['postId'];

        if(!empty($othorName) && !empty($comment) && !empty($othorEmail)) {
            $query = "INSERT INTO comments (comment_post_id, comment_othor, comment_email, comment_content, comment_status, comment_date) 
            VALUES($commentPostId, '$othorName', '$othorEmail', '$comment', 'ON', now())";
            $insertComment=mysqli_query($connect,$query);
            if(!$insertComment){
                die("FAILED".mysqli_error($connect));
            }else{
            echo $othorEmail;  
            }
        $query="UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $individualPostId";
        $updateCommentCount=mysqli_query($connect,$query);
        // echo $postsOthor; it can display the data that is inside post table

        }else{
            echo "<script> alert('field can not be empty') </script>";
        }

    
    }

?>

                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post">
                        <div class="form-group">
                            <label for="othorName">Comment Othor</label>
                            <input type="text" name="othor_name" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="comment_email">Comment Email</label>
                            <input type="text" name="comment_email" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <textarea  name="comment" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->



<?php
if(isset($_GET['postId'])){
    $getCommId=$_GET['postId'];
}
$query="SELECT * FROM comments WHERE comment_post_id = $getCommId AND comment_status ='Approved' ORDER BY comment_id DESC ";
$allComments=mysqli_query($connect,$query);
if(!$allComments){
    die("Damn failed to display the comments".mysqli_error($connect));
}
while($row=mysqli_fetch_assoc($allComments)){
    $othor=$row['comment_othor'];
    $email=$row['comment_email'];
    $content=$row['comment_content'];
    $date=$row['comment_date'];
  
    ?>            <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $othor?>
                            <small><?php echo $date?> at 9:30 PM</small>
                        </h4>
                        <?php echo $content?>
                    </div>
                </div>
<?php      
}

?>
                <!-- Comment -->
           

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