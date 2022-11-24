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
                            <small>Author name</small>
                        </h1>

<?php

if(isset($_GET['source'])){
    $source=$_GET['source'];    
}else{
    $source='';//for avoiding the notice of undefined variable $source the assigning value to it
}
switch($source){
    case 'addUser';
    include "./includes/addUser.php";
    break;

    case 'editUser';
    include "includes/editUser.php";
    break;

    case 30;
    echo 'case 30';
    break;

    default;
    include "includes/viewAllUsers.php";
}

?>


                      
                    </div>
                </div>
                
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

       <?php include "includes/adminFooter.php"?>