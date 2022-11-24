
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

if(isset($_POST['search'])){
    $search=$_POST['postTag'];
    $querry="SELECT * FROM posts WHERE post_tag like '%$search%' ";
    $searchQuerry=mysqli_query($connect,$querry);
    if(!$searchQuerry){
        die('Querry FAILED!'.mysqli_error($connect));
            }
    $count=mysqli_num_rows($searchQuerry);
    if($count==0){
        echo"<h1 class='text-center' style='color:red'>NO RESULT</h1>";
        }else{
while($row=mysqli_fetch_assoc($searchQuerry)){
    $postsTitle=$row['post_title'];
    $postsCatId=$row['post_cat_id'];
    $postsOthor=$row['post_othor'];
    $postsDate=$row['post_date'];
    $postsImage=$row['post_image'];
    $postsContent=$row['post_content'];
    $postsTag=$row['post_tag'];
    ?>


                <h2>
                    <a href="#"><?php echo $postsTitle ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $postsOthor ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo 'Posted on'. $postsDate. 'at 17:00 PM' ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $postsImage?>" alt="">
                <hr>
                <p><?php echo $postsContent ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

<?php } 
        }
    }
    ?>
      <!-- Second Blog Post -->
      
            </div>

            <!-- Blog Sidebar Widgets Column -->
         <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
      <?php include "includes/footer.php"?>