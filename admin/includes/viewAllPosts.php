<?php 

if(isset($_POST['checkboxArray'])){
    foreach($_POST['checkboxArray'] as $checkboxValue){
        // echo $checkboxValue.'<br>';
        // echo $bulkOption=$_POST['bulkOptions'];
        $bulkOption=escape($_POST['bulkOptions']);
        switch($bulkOption){
            case "published":
                $query="UPDATE posts SET post_status = 'published' WHERE post_id = $checkboxValue";
                // UPDATE `posts` SET `post_status` = 'published' WHERE `posts`.`post_id` = 24;
                $publishPostQuery=mysqli_query($connect,$query);
                break;
            case "draft":
                $query="UPDATE posts SET post_status = 'draft' WHERE post_id = $checkboxValue";
                // UPDATE `posts` SET `post_status` = 'published' WHERE `posts`.`post_id` = 24;
                $draftPostQuery=mysqli_query($connect,$query);
                break;

            case 'delete':
                $query="DELETE FROM posts WHERE post_id = $checkboxValue";
                $deleteCheckedPost=mysqli_query($connect,$query);
                if(!$deleteCheckedPost){
                    die("Delete Failed!".mysqli_error($connect));
                }
                break;  
            
                
            case 'clone':
                $query="SELECT * FROM posts WHERE post_id = $checkboxValue";
                $allCheckedPost=mysqli_query($connect,$query);
                while($row=mysqli_fetch_assoc($allCheckedPost)){
                    $postOthor=$row['post_othor'];
                    $title=$row['post_title'];
                    $status=$row['post_status'];
                    $image=$row['post_image'];
                    $content=$row['post_content'];
                    $date=$row['post_date'];
                    $tag=$row['post_tag'];
                    $commentCount=$row['post_comment_count'];
                    $postCategoryId=$row['post_cat_id'];
                }
$query="INSERT INTO posts (post_cat_id, post_title, post_othor, post_date, post_image, post_content, post_tag, post_status)
VALUES ('$postCategoryId', '$title', '$postOthor', '$date', '$image', '$content', '$tag', '$status')";
$addPostQuery=mysqli_query($connect,$query);
if(!$addPostQuery){
die('Querry Failed'.mysqli_error($connect));
}
        }

    }
}

?>


<div class="table-responsive-md">
    <form action="" method="post">
<table class="table table-bordered table-hover table-sm">
    <div id="bulkOptionContainer" class="col-xs-4" style="padding: 0;">
        <select class="form-control" name="bulkOptions" id="">
        <option value="">Select Options</option>
        <option value="published">Publish</option>
        <option value="draft">Draft</option>
        <option value="delete">Delete</option>
        <option value="clone">Clone</option>
        </select>
    </div>
    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a class="btn btn-primary" href="posts.php?source=addPost">AddNewPost</a>
    </div>
    <br><br>
    
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="chechboxAll"></th>
                                    <th>Id</th>
                                    <th>Othor</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Date</th>                                    
                                    <th>Comments</th>
                                    <th>Post Views</th>
                                    <th>View Post</th>
                                    <th>Edit</th>
                                    <th>Publish</th>
                                    <th>Draft</th>
                                    <th>Delete</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                
                                
<?php

$query="SELECT * FROM posts ORDER BY post_id DESC";
$allPosts=mysqli_query($connect,$query);
while($row=mysqli_fetch_assoc($allPosts)){
    $id=$row['post_id'];
    $postOthor=$row['post_othor'];
    $title=$row['post_title'];
    $status=$row['post_status'];
    $image=$row['post_image'];
    $content=$row['post_content'];
    $date=$row['post_date'];
    $tag=$row['post_tag'];
    $commentCount=$row['post_comment_count'];
    $postCategoryId=$row['post_cat_id'];
    $postViewsCount=$row['post_views'];
?>
<tr>
    <td><input class="checkboxes" type='checkbox' name='checkboxArray[]' value="<?php echo $id;?>">
</td>

<?php
    
   
    echo "<td>$id</td>";
    echo "<td>$postOthor</td>";
    echo "<td>$title</td>";

    $query= "SELECT * FROM categories WHERE cat_id = $postCategoryId";// LIMIT 3: For limitting the categories to certain number
    $allCategories=mysqli_query($connect,$query);

    while($row=mysqli_fetch_assoc($allCategories)){
    $catTitle=$row['cat_title'];
    $catId=$row['cat_id'];

    echo "<td>$catTitle</td>";
     }

    echo "<td>$status</td>";
    echo "<td><img src='images/$image' class='img-responsive' width='100' alt='image'></td>";
    echo "<td>$tag</td>";
    echo "<td>$date</td>";

    $query="SELECT * FROM comments WHERE comment_post_id = $id";
    $commentsPerPostQuerry=mysqli_query($connect,$query);
    $commentCountPerPost=mysqli_num_rows($commentsPerPostQuerry);
    $row=mysqli_fetch_assoc($commentsPerPostQuerry);
    
    $commentPostId=$row['comment_post_id'];
 
    echo "<td><a href='comments.php?source=comment&commentPostId=$commentPostId'>$commentCountPerPost</a></td>";
    echo "<td><a onclick=\"javascript:return confirm('are you sure you want to reset Post Views') \" href='posts.php?reset=$id'>$postViewsCount</a></td>";
    echo "<td><a href='../post.php?postId=$id'>View Post</a></td>";
    echo "<td><a href='posts.php?source=editPost&postId=$id'>Edit</a></td>";
    echo "<td><a href='posts.php?publish=$id'>Publish</a></td>";
    echo "<td><a href='posts.php?draft=$id'>Draft</a></td>";
    echo "<td><a onClick=\" javascript:return confirm('are you sure you want to delete Post?')  \" href='posts.php?delete=$id'>Delete</a></td>";
                                 
    echo "</tr>";
   
if(isset($_GET['publish'])){
    $publish=$_GET['publish'];
    $query="UPDATE posts SET post_status = 'published' WHERE post_id = $publish";
    $publishPostQuery=mysqli_query($connect,$query);
    header("location:posts.php");
}
if(isset($_GET['draft'])){
    $draft=$_GET['draft'];
    $query="UPDATE posts SET post_status = 'draft' WHERE post_id = $draft";
    $draftPostQuery=mysqli_query($connect,$query);
    header("location:posts.php");
}

}

?>                                    
                                
                               
                            </tbody>
                        </table>
                
                    </div>
                </form>
<?php

deletePost();


?>
<?php

if(isset($_GET['reset'])){

$reset=$_GET['reset'];
$query="UPDATE posts SET post_views = 0 WHERE post_id=$reset";
$resetPostsViews=mysqli_query($connect,$query);
    header("location:posts.php");    
    
    }
?>