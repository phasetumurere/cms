<?php

if(isset($_GET['editUser'])){
    $userId=$_GET['editUser'];
    $query="SELECT * FROM users WHERE user_id= $userId";
    $singleUser=mysqli_query($connect,$query);
    while($row=mysqli_fetch_assoc($singleUser)){
        $id=$row['user_id'];
        $userName=$row['username'];
        $userFirstName=$row['user_firstname'];
        $userLastName=$row['user_lastname'];
        $userPassword=$row['password'];
        $userEmail=$row['user_email'];
        $userImage=$row['user_image'];
        $userRole=$row['user_role'];
    }
    
   
    
}

if(isset($_POST['updateUser'])){
    $userName=$_POST['userName'];
    $firstName=$_POST['firstName'];
    $lastName=$_POST['lastName'];
    $userEmail=$_POST['userEmail'];

    $postImage=$_FILES['post_image']['name'];
    $postImageTemp=$_FILES['post_image']['tmp_name'];

    $userPassword=$_POST['userPassword'];
    $userRole=$_POST['userRole'];

    //encryping Password

    // $query="SELECT randSalt FROM users";
    // $selectRandSaltQuery=mysqli_query($connect,$query);
    // $row=mysqli_fetch_array($selectRandSaltQuery);
    // $salt=$row['randSalt'];
    // $hashPassword=crypt($userPassword,$salt);

    $hashPassword= password_hash($userPassword,PASSWORD_BCRYPT,array('cost'=>5));


    move_uploaded_file($postImageTemp,"./images/$postImage");
    if(empty($postImage)){
        $query = "SELECT * FROM users WHERE user_id=$userId";
        $selectImage=mysqli_query($connect,$query);
        while($row = mysqli_fetch_array($selectImage)){
            $postImage=$row['user_image'];
        }
    }
    $query="UPDATE users SET username = '$userName', password='$hashPassword',
     user_firstname = '$firstName', user_lastname='$lastName',
     user_email='$userEmail', user_image='$postImage', user_role='$userRole',randSalt='InyanyanaDod' 
      WHERE user_id=$userId ";
    $addPostQuery=mysqli_query($connect,$query);
    $decryptPassword =password_verify($userPassword,$hashPassword);
    // if(!$query){
    //     die('DAMN FAILED'.mysqli_error($connect));
    //     }else{
    //         echo "inserted successifully";
    //     }
    echo "<h5>User $userName is Updated. <a href='users.php'>viewAllUsers?</a></h5>";
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
        <input type="password" class="form-control" name="userPassword" value="">
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
echo "<option value='$usersRoles'>$usersRoles</option> ";
}

?>
        </select>

    </div>

 

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="updateUser" value="UPDATE">
    </div>
</form>