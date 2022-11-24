


<div class="table-responsive-md">
<table class="table table-bordered table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>FirstName</th>
                                    <th>LastName</th>
                                    <th>User Email</th>
                                    <th>Photo</th>
                                    <th>Role</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                
<?php

$query="SELECT * FROM users ORDER BY user_id DESC";
$allusers=mysqli_query($connect,$query);
while($row=mysqli_fetch_assoc($allusers)){
    $id=$row['user_id'];
    $userName=$row['username'];
    $firstName=$row['user_firstname'];
    $lastName=$row['user_lastname'];
    $userEmail=$row['user_email'];
    $password=$row['password'];
    $image=$row['user_image'];
    $role=$row['user_role'];
    $randSalt=$row['randSalt'];

    echo "<tr>";
    echo "<td>$id</td>";
    echo "<td>$userName</td>";

    // $query= "SELECT * FROM categories WHERE cat_id = $postCategoryId";// LIMIT 3: For limitting the categories to certain number
    // $allCategories=mysqli_query($connect,$query);

    // while($row=mysqli_fetch_assoc($allCategories)){
    // $catTitle=$row['cat_title'];
    // $catId=$row['cat_id'];

    // echo "<td>$catTitle</td>";
    //  }
    
    
    echo "<td>$firstName</td>";
    echo "<td>$lastName</td>";
    echo "<td>$userEmail</td>";
    echo "<td><img src='./images/$image' width='100' class='img-responsive'></td>";
    echo "<td>$role</td>";
    echo "<td><a href='users.php?toAdmin=$id'>toAdmin</a></td>";
    echo "<td><a href='users.php?toSub=$id'>toSubscriber</a></td>";
    echo "<td><a href='users.php?source=editUser&editUser=$id'>Edit</a></td>";
    echo "<td><a href='users.php?delete=$id'>Delete</a></td>";

   }

?>                                    
                                
                               
                            </tbody>
                        </table>
                    </div>
<?php

if($_SESSION['userRole']){

    if(mysqli_real_escape_string($connect,$_SESSION['userRole']=='Admin')){

        if(isset($_GET['delete'])){

    $userId=$_GET['delete'];
    // "<a onClick=\" javascript:return confirm('are you sure you want to delete Post?')  \" href='posts.php?delete=$id'>Delete</a>";
    $query ="DELETE FROM users WHERE user_id=$userId";
    $deleteComment=mysqli_query($connect,$query);
    header("Location: users.php");
            }
        }
    }

?>

<?php
if(isset($_GET['toAdmin'])){
    $theUserId=$_GET['toAdmin'];
    $query ="UPDATE users SET user_role = 'Admin' WHERE user_id = $theUserId";
    $unApproveComment=mysqli_query($connect,$query);
    header("Location: users.php");
    
}

if(isset($_GET['toSub'])){
    $theUserId=$_GET['toSub'];
    $query ="UPDATE users SET user_role = 'Subscriber' WHERE user_id = $theUserId";
    $ApproveComment=mysqli_query($connect,$query);
    header("Location: users.php");
    
}
?>
