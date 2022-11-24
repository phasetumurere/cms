<?php include "includes/adminHeader.php";?>

    <div id="wrapper" >
<?php 

?>
        <!-- Navigation -->
        <?php include "includes/adminNavigation.php"?>

        <div id="page-wrapper">

            <div class="container-fluid table-responsive" >

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <?php
                            if(isset($_SESSION['username'])){
                            //   =;
                            echo "<small>".$_SESSION['userFirstName']."</small>";   
                            }
                           
                            ?>
                           
                        </h1>

<?php

if(isset($_GET['source'])){
    $source=$_GET['source'];    
}else{
    $source='';//for avoiding the notice of undefined variable $source the assigning value to it
}
switch($source){
   
    case 'comment';
    include "includes/comment.php";
    break;

    default;
    include "includes/viewAllComments.php";
}

?>


                      
                    </div>
                </div>
                
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

       <?php include "includes/adminFooter.php"?>