<?php include "connect.php"?>
<?php session_start()?>
<?php
if($connect){
    echo "connected";
}
if(isset($_POST['login'])){

    $username=$_POST['userName'];
    $password=$_POST['password'];
    //avoiding hackerz who can send bad requests in our database so that they can harm
    // our infos on database : Cleaning data from form for security mejors
    $username=mysqli_real_escape_string($connect,$username);    
    $password=mysqli_real_escape_string($connect,$password);   

   
      

    $query="SELECT * FROM users WHERE username ='$username'";
    $selectUserInfo=mysqli_query($connect,$query);
    if(!$selectUserInfo){
        die("not Pulling the user information".mysqli_error($connect));
    }
    while($row=mysqli_fetch_assoc($selectUserInfo)){
        $dbUserId=$row['user_id'];
        $dbUserName=$row['username'];
        $dbUserPassword=$row['password'];
        $dbUserFirstName=$row['user_firstname'];
        $dbUserLastName=$row['user_lastname'];
        $dbUserEmail=$row['user_email'];
        $dbUserImage=$row['user_image'];
        $dbUserRole=$row['user_role'];
        $dbUserRandSalt=$row['randSalt'];  
        // $password= crypt($password,$dbUserPassword);  
    }

    // if($username===$dbUserName && $password===$dbUserPassword)
if(password_verify($password,$dbUserPassword)){
        $_SESSION['username']=$dbUserName;
        $_SESSION['userImage']=$dbUserImage;
        $_SESSION['randSalt']=$dbUserRandSalt;
        $_SESSION['userFirstName']=$dbUserFirstName;
        $_SESSION['userLastName']=$dbUserLastName;
        $_SESSION['userRole']=$dbUserRole;//this will differentiate adminUsers with others
        // if Role is admin will redirect him to adminPanel else to home site
        header("Location: ../admin/index.php");
     }
  
    else{
        header("Location: ../index.php");
    } 

}

?>