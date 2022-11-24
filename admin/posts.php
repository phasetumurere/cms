<?php include "includes/adminHeader.php";?>


    <div id="wrapper" >

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
                            
                            if($_SESSION['randSalt']=='draft'){//based on condition fore exapmle if gender is M or F
                        echo "<small>".$_SESSION['userFirstName']."</small>";
                            }else{
                                echo "<small>".$_SESSION['userFirstName']."</small>";
                            }

                            ?>
                            
                        </h1>

<?php

if(isset($_GET['source'])){
    $source=escape($_GET['source']);    
}else{
    $source='';//for avoiding the notice of undefined variable $source the assigning value to it
}
switch($source){
    case 'addPost';
    include "includes/addPost.php";
    break;

    case 'editPost';
    include "includes/editPost.php";
    break;

    case 30;
    echo 'case 30';
    break;

    default;
    include "includes/viewAllPosts.php";
}

?>


                      
                    </div>
                </div>
                
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

       <?php include "includes/adminFooter.php"?>