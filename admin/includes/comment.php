<?php

if(isset($_GET['commentPostId'])){
    $commentId=escape($_GET['commentPostId']);
if(!$commentId){
    $commentId='';
}else{


    $query="SELECT * FROM comments WHERE comment_post_id = $commentId ORDER BY comment_id DESC";
    $allComments=mysqli_query($connect,$query);
    $count=mysqli_num_rows($allComments);
    echo $count;

    ?>
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
                                    
                                


    <?php
    while($row=mysqli_fetch_assoc($allComments)){
    $id=escape($row['comment_id']);
    $commentPostId= escape($row['comment_post_id']);
    $othor=escape($row['comment_othor']);
    $email=escape($row['comment_email']);
    $content=escape($row['comment_content']);
    $date=escape($row['comment_date']);
    $status=escape($row['comment_status']);





    echo "<tr>";
    echo "<td>$id</td>";
    echo "<td>$othor</td>";

    
    echo "<td>$email</td>";
    echo "<td>$content</td>";
    echo "<td>$status</td>";
    echo "<td>$date</td>";

    $query = "SELECT post_title FROM posts" ;//WHERE post_comment_count = $count";
    $postComments=mysqli_query($connect,$query);
    while($row=mysqli_fetch_array($postComments)){
        $postTitle=escape($row['post_title']);
    }
    echo "<td><a href='../post.php?postId=$commentPostId'>$postTitle</a></td>";


    echo "<td><a href='comments.php?source=comment&commentPostId=$commentPostId&approve=$id'>Approve</a></td>";
    echo "<td><a href='comments.php?source=comment&commentPostId=$commentPostId&unApprove=$id'>unApprove</a></td>";
    echo "<td><a href='comments.php?source=comment&commentPostId=$commentPostId&delete=$id'>Delete</a></td>";
                                 
    echo "</tr>";
   
        }
    }

}
if(isset($_GET['approve'])){
    $commentId=$_GET['approve'];
    $query="UPDATE comments SET comment_status = 'Approved' WHERE comment_id = $commentId";
    $approveComment= mysqli_query($connect,$query);
    header("Location: comments.php?source=comment&commentPostId=$commentPostId");
}

if(isset($_GET['unApprove'])){
    $commentId=$_GET['unApprove'];
    $query="UPDATE comments SET comment_status = 'unApproved' WHERE comment_id = $commentId";
    $approveComment= mysqli_query($connect,$query);
    header("Location: comments.php?source=comment&commentPostId=$commentPostId");
}

if(isset($_GET['delete'])){
    $commentId=$_GET['delete'];
    $query="DELETE FROM comments WHERE comment_id = $commentId";
    $approveComment= mysqli_query($connect,$query);
    header("Location: comments.php?source=comment&commentPostId=$commentPostId");
}

?>                                    
         
                     
                               </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

