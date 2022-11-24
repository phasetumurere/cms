<?php

if(isset($_POST['create_user'])){
    $userName=escape($_POST['userName']);
    $firstName=escape($_POST['firstName']);
    $lastName=escape($_POST['lastName']);
    $userEmail=escape($_POST['userEmail']);

    $postImage=$_FILES['post_image']['name'];
    $postImageTemp=$_FILES['post_image']['tmp_name'];

    $userPassword=escape($_POST['userPassword']);

    $userRole=escape($_POST['userRole']);
    
    //Encryping Password
    // $selectSalt="SELECT randSalt FROM users";
    // $allSalt=mysqli_query($connect,$selectSalt);
    // $row=mysqli_fetch_array($allSalt);
    // $salt=$row['randSalt'];
    // $userPassword=crypt($userPassword,$salt);

    // Better way en very secure way of Encrypting password
    $userPassword=password_hash($userPassword,PASSWORD_BCRYPT,array('cost'=>5));

    move_uploaded_file($postImageTemp,"./images/$postImage");

    $query="INSERT INTO users (username, password, user_firstname, user_lastname, user_email, user_image, user_role)
     VALUES ('$userName', '$userPassword', '$firstName', '$lastName', '$userEmail', '$postImage', '$userRole')";
    $addPostQuery=mysqli_query($connect,$query);
   
    if($addPostQuery){
        echo "<h1> <mark>User </mark> </h1><em>$userName</em> Is Created as Successifully<small> <a href='users.php'>View Users</a></small>";
    }

}

?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">FirstName</label>
        <input type="text" class="form-control" name="firstName">
    </div>
    <div class="form-group">
        <label for="lastname">lastName</label>
        <input type="text" class="form-control" name="lastName">
    </div>

    <div class="form-group">
        <label for="username">username</label>
        <input type="text" class="form-control" name="userName">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="userPassword">
    </div>
    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" name="post_image">
    </div>
    <div class="form-group">
        <label for="content">User Email</label>
        <input class="form-control" name="userEmail" type="email">
    </div>
   
    
    <div class="form-group">
        <label for="userRoles">User Roles</label><br>
        <select name="userRole" id="">
        <option value="subscriber">SELECT OPTION</option>
        <option value="admin">Admin</option>
        <option value="subscriber">Subscriber</option>
        </select>

    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
    </div>
</form>