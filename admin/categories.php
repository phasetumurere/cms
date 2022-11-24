<?php include "includes/adminHeader.php";?>

    <div id="wrapper">
<?php 

?>
        <!-- Navigation -->
        <?php include "includes/adminNavigation.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Author name</small>
                        </h1>

                        <div class="col-xs-6">
<?php

insertCategegories();

?>

                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="catTitle">Add category</label>
                                    <input type="text" name="catTitle" class="form-control">
                                </div>
                              
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            </form>
                        

<?php

if(isset($_GET['edit'])){
    $getCatId=$_GET['edit'];
    include "includes/updateCategories.php";
}

?>

                        </div>

                        <div class="col-xs-6">

                    <table class="table table-bordered table-hover">
                    
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category Title</th>
                            </tr>
                        </thead>
                            <tbody>
<!-- Add || insert into category table -->

<?php displayAllCategories();?>



<!-- Delete category -->
<?php deleteCategory();?>



                            </tbody>
                        
                    </table>
                </div>
                      
                    </div>
                </div>
                
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

       <?php include "includes/adminFooter.php"?>