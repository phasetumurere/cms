<?php include "includes/adminHeader.php";?>
<?php 
if(isset($_SESSION['username'])){
    $userName=$_SESSION['username'];
    $query= "SELECT * FROM users WHERE username = '$userName'";
    $selectUserProfileQuery=mysqli_query($connect,$query);
    while($row=mysqli_fetch_assoc($selectUserProfileQuery)){
        $userFirstName=$row['user_firstname'];
        $userLastName=$row['user_lastname'];
        $userPassword=$row['password'];
        $userEmail=$row['user_email'];
        $userImage=$row['user_image'];
        $userRole=$row['user_role'];
        $randSalt=$row['randSalt'];
    }

}
?>
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
                            <small><?php echo $userName?></small>
                        </h1>
<?php

if(isset($_POST['updateUser'])){
    $userName=$_POST['userName'];
    $firstName=$_POST['firstName'];
    $lastName=$_POST['lastName'];
    $userEmail=$_POST['userEmail'];

    $postImage=$_FILES['post_image']['name'];
    $postImageTemp=$_FILES['post_image']['tmp_name'];

    $userPassword=$_POST['userPassword'];
    $userRole=$_POST['userRole'];
    $randSalt=$_POST['randSalt'];

    move_uploaded_file($postImageTemp,"./images/$postImage");
    if(empty($postImage)){
        $query = "SELECT * FROM users WHERE username = '$userName'";
        $selectImage=mysqli_query($connect,$query);
        while($row = mysqli_fetch_array($selectImage)){
            $postImage=$row['user_image'];
        }
    }
    $query="UPDATE users SET username = '$userName', password='$userPassword',
     user_firstname = '$firstName', user_lastname='$lastName',
     user_email='$userEmail', user_image='$postImage', user_role='$userRole', 
     randSalt='$randSalt' WHERE username = '$userName' ";
    $addPostQuery=mysqli_query($connect,$query);
   
    // if(!$query){
    //     die('DAMN FAILED'.mysqli_error($connect));
    //     }else{
    //         echo "inserted successifully";
    //     }

}

?>
                        <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">FirstName</label>
        <input type="text" class="form-control" name="firstName" value="<?php echo $userFirstName?>">
    </div>
    <div class="form-group">
        <label for="lastname">lastName</label>
        <input type="text" class="form-control" name="lastName" value="<?php echo $userLastName?>">
    </div>

    <div class="form-group">
        <label for="username">username</label>
        <input type="text" class="form-control" name="userName" value="<?php echo $userName?>">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" autocomplete="off" class="form-control" name="userPassword">
    </div>
    <div class="form-group">
        <label for="image">Post Image</label><br>
        <img src="./images/<?php echo $userImage?> " width="80">
        <input type="file" name="post_image" value="">
    </div>
    <div class="form-group">
        <label for="content">User Email</label>
        <input class="form-control" name="userEmail" type="email" value="<?php echo $userEmail?>">
    </div>
   
    
    <div class="form-group">
        <label for="userRoles">User Roles</label><br>
        <select name="userRole" id="">
<?php

$query ="SELECT * FROM users";
$allUsers=mysqli_query($connect,$query);
while($row=mysqli_fetch_assoc($allUsers)){
    $usersId=$row['user_id'];
    $usersRoles=$row['user_role'];
echo "<option value='Subscriber'>$usersRoles</option> ";
}

?>
        </select>

    </div>

    <div class="form-group">
        <label for="content">RandSalt</label>
        <input class="form-control" name="randSalt" type="text" value="<?php echo $randSalt?>">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="updateUser" value="Update Profile">
    </div>
</form>


                      
                    </div>
                </div>
                
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

       <?php include "includes/adminFooter.php"?>