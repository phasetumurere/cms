<?php include "includes/adminHeader.php";?>

    <div id="wrapper">


<!-- Creating Online Users -->





        <!-- Navigation -->
        <?php include "includes/adminNavigation.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            
                            <small><?php echo $_SESSION['username']?></small>
                            
                        </h1>
                      
                    </div>
                </div>
                <!-- /.row -->




                <div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <?php
                    
                    $query="SELECT * FROM posts";
                    $selectAllPosts=mysqli_query($connect,$query);
                    $postsCount=mysqli_num_rows($selectAllPosts);
                    echo "<div class='huge'> $postsCount </div>"
                    ?>


                  <!-- <?php //echo $postsCount?></div> -->
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <?php 
                        
                        $query="SELECT * FROM comments";
                        $selectAllComments=mysqli_query($connect,$query);
                        $commentsCount=mysqli_num_rows($selectAllComments);
                        
                        ?>
                     <div class='huge'><?php echo $commentsCount?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <?php
                    
                    $query="SELECT * FROM users";
                    $selectAllUsers=mysqli_query($connect,$query);
                    $usersCount=mysqli_num_rows($selectAllUsers);
                    echo "<div class='huge'> $usersCount </div>"
                    ?>

                    
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                    
                    $query="SELECT * FROM categories";
                    $selectAllCategories=mysqli_query($connect,$query);
                    $categoriesCount=mysqli_num_rows($selectAllCategories);
                    echo "<div class='huge'> $categoriesCount </div>"
                    ?>

                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
               



  


              <div class="row">
<h1>Chart graphs</h1>

<?php

$query= "SELECT * FROM posts WHERE post_status = 'draft'";
$selectAllDraftPosts=mysqli_query($connect,$query);
$allDraftPostCount=mysqli_num_rows($selectAllDraftPosts);

$query= "SELECT * FROM users WHERE user_role = 'Subscriber'";
$selectAllSubscriberUser=mysqli_query($connect,$query);
$allSubscriberUsersCount=mysqli_num_rows($selectAllSubscriberUser);

$query= "SELECT * FROM comments WHERE comment_status = 'UnApproved'";
$selectAllUnApprovedComment=mysqli_query($connect,$query);
$allUnApprovedCommentsCount=mysqli_num_rows($selectAllUnApprovedComment);

$query= "SELECT * FROM comments WHERE comment_status = 'Approved'";
$selectAllApprovedComment=mysqli_query($connect,$query);
$allApprovedCommentsCount=mysqli_num_rows($selectAllApprovedComment);

$query= "SELECT * FROM posts WHERE post_status = 'published'";
$selectAllPublishedPosts=mysqli_query($connect,$query);
$allPublishedPostsCount=mysqli_num_rows($selectAllPublishedPosts);

?>
<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Count'],

          <?php
          
          $elementsText=['AllPosts','ActivePosts','DraftPosts','Comments','UnApprovedComments', 'ApprovedComments','Users','SubscriberUsers','Categories'];
          $elementsCount=[$postsCount,$allPublishedPostsCount,$allDraftPostCount,$commentsCount,$allApprovedCommentsCount,$allUnApprovedCommentsCount,$usersCount,$allSubscriberUsersCount,$categoriesCount];
          for($i =0; $i <9; $i++){
              echo" ['$elementsText[$i]'".","."$elementsCount[$i]],";
          }
          
          ?>
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>

<div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
<?php 
// include "chart.php"?>
</div>
            </div>


            </div>
            <!-- /.container-fluid -->

            

       <?php include "includes/adminFooter.php"?>