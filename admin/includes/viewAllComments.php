<div class="table-responsive-md">
<table class="table table-bordered table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Comment Othor</th>
                                    <th>Comment Email</th>
                                    <th>Comment Content</th>
                                    <th>Comment Status</th>
                                    <th>Comment Date</th>
                                    <th>InResponseTo</th>
                                    <th>Approve</th>
                                    <th>UnApprove</th>
                                    <th>Delete</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                
<?php

$query="SELECT * FROM comments ORDER BY comment_id DESC";
$allComments=mysqli_query($connect,$query);
while($row=mysqli_fetch_assoc($allComments)){
    $id=$row['comment_id'];
    $commentPostId= $row['comment_post_id'];
    $othor=$row['comment_othor'];
    $email=$row['comment_email'];
    $content=$row['comment_content'];
    $date=$row['comment_date'];
    $status=$row['comment_status'];

    echo "<tr>";
    echo "<td>$id</td>";
    echo "<td>$othor</td>";

    // $query= "SELECT * FROM categories WHERE cat_id = $postCategoryId";// LIMIT 3: For limitting the categories to certain number
    // $allCategories=mysqli_query($connect,$query);

    // while($row=mysqli_fetch_assoc($allCategories)){
    // $catTitle=$row['cat_title'];
    // $catId=$row['cat_id'];

    // echo "<td>$catTitle</td>";
    //  }
    
    echo "<td>$email</td>";
    echo "<td>$content</td>";
    echo "<td>$status</td>";
    echo "<td>$date</td>";
    

    

    $query="SELECT * FROM posts WHERE post_id = $commentPostId";
    $singlePost=mysqli_query($connect,$query);
    while($row=mysqli_fetch_assoc($singlePost)){
        $title=$row['post_title'];
        $postId=$row['post_id'];
    echo "<td><a href='../post.php?postId=$postId'>$title</a></td>";
}
    


    echo "<td><a href='comments.php?approve=$id'>Approve</a></td>";
    echo "<td><a href='comments.php?unapprove=$id'>UnApprove</a></td>";
    echo "<td><a href='comments.php?delete=$id'>Delete</a></td>";
                                 
    echo "</tr>";
   
}



?>                                    
                                
                               
                            </tbody>
                        </table>
                    </div>
<?php
if(isset($_GET['delete'])){
    $commentId=$_GET['delete'];
    $query ="DELETE FROM comments WHERE comment_id=$commentId";
    $deleteComment=mysqli_query($connect,$query);
    header("Location: comments.php");
    
}?>

<?php
if(isset($_GET['approve'])){
    $commentId=$_GET['approve'];
    $query ="UPDATE comments SET comment_status = 'Approved' WHERE comment_id = $commentId";
    $unApproveComment=mysqli_query($connect,$query);
    header("Location: comments.php");
    
}

if(isset($_GET['unapprove'])){
    $commentId=$_GET['unapprove'];
    $query ="UPDATE comments SET comment_status = 'UnApproved' WHERE comment_id = $commentId";
    $ApproveComment=mysqli_query($connect,$query);
    header("Location: comments.php");
    
}
?>
